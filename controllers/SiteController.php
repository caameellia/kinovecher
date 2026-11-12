<?php
namespace app\controllers;

use Yii;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Movie;
use app\models\UserMovie;
use app\models\Vote;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'profile', 'set-movie-status', 'cast-vote'],
                'rules' => [[
                    'allow' => true,
                    'actions' => ['logout', 'profile', 'set-movie-status', 'cast-vote'],
                    'roles' => ['@'],
                ]],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['POST'],
                    'set-movie-status' => ['POST'],
                    'cast-vote' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return ['error' => ['class' => 'yii\web\ErrorAction']];
    }

    public function actionIndex()
    {
        $popular = Movie::find()->orderBy(['rating' => SORT_DESC])->limit(6)->all();
        return $this->render('index', ['popular' => $popular]);
    }

    public function actionCatalog()
    {
        $params = Yii::$app->request->get();
        $query = Movie::find();
        $search = trim((string)($params['q'] ?? ''));
        if ($search !== '') {
            $query->andWhere(['or', ['like', 'title', $search], ['like', 'genre', $search]]);
        }
        $genre = trim((string)($params['genre'] ?? ''));
        if ($genre !== '') $query->andWhere(['genre' => $genre]);
        $rating = (int)($params['rating'] ?? 0);
        if ($rating >= 1 && $rating <= 10) $query->andWhere(['>=', 'rating', $rating]);
        $year = (int)($params['year'] ?? 2026);
        if ($year >= 1888 && $year < 2026) $query->andWhere(['<=', 'year', $year]);
        $duration = (int)($params['duration'] ?? 300);
        if ($duration >= 60 && $duration < 300) $query->andWhere(['<=', 'duration', $duration]);
        $sort = (string)($params['sort'] ?? 'rating');
        $orders = [
            'rating' => ['rating' => SORT_DESC, 'id' => SORT_ASC],
            'year' => ['year' => SORT_DESC, 'id' => SORT_ASC],
            'title' => ['title' => SORT_ASC, 'id' => SORT_ASC],
        ];
        $query->orderBy($orders[$sort] ?? $orders['rating']);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12, 'pageParam' => 'page'],
        ]);
        return $this->render('catalog', ['dataProvider' => $provider, 'filters' => $params]);
    }

    public function actionMovie($id = null)
    {
        $movie = $id === null
            ? Movie::find()->where(['title' => 'Интерстеллар'])->one()
            : Movie::findOne((int) $id);
        if (!$movie) throw new NotFoundHttpException('Фильм не найден.');
        $related = Movie::find()->where(['!=', 'id', $movie->id])->limit(6)->all();
        return $this->render('movie', ['movie' => $movie, 'related' => $related]);
    }

    public function actionVoting()
    {
        $movies = Movie::find()->where(['title' => ['Оппенгеймер', 'Дюна', 'Интерстеллар', '1+1', 'Начало']])->all();
        $votes = Vote::find()->select(['movie_id', 'total' => 'COUNT(*)'])->groupBy('movie_id')->asArray()->all();
        $totals = array_column($votes, 'total', 'movie_id');
        $currentVote = Yii::$app->user->isGuest ? null : Vote::findOne(['user_id' => Yii::$app->user->id]);
        return $this->render('voting', compact('movies', 'totals', 'currentVote'));
    }

    public function actionProfile()
    {
        $records = UserMovie::find()->with('movie')
            ->where(['user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();
        $watched = [];
        $watchlist = [];
        foreach ($records as $record) {
            if (!$record->movie) continue;
            if ($record->status === 'watched') $watched[] = $record->movie;
            else $watchlist[] = $record->movie;
        }
        return $this->render('profile', compact('watched', 'watchlist'));
    }

    public function actionSetMovieStatus()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $id = (int)$request->post('movie_id', 0);
        $status = (string)$request->post('status', '');
        if (!in_array($status, ['watched', 'watchlist', 'remove'], true)) {
            throw new BadRequestHttpException('Некорректный статус.');
        }
        if (!Movie::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('Фильм не найден.');
        }
        $record = UserMovie::findOne(['user_id' => Yii::$app->user->id, 'movie_id' => $id]);
        if ($status === 'remove' || ($record && $record->status === $status)) {
            if ($record) $record->delete();
            return ['ok' => true, 'status' => null];
        }
        if (!$record) {
            $record = new UserMovie();
            $record->user_id = Yii::$app->user->id;
            $record->movie_id = $id;
        }
        $record->status = $status;
        $record->added_at = date('Y-m-d H:i:s');
        if (!$record->save()) {
            Yii::error($record->errors, __METHOD__);
            throw new BadRequestHttpException('Не удалось сохранить фильм.');
        }
        return ['ok' => true, 'status' => $status];
    }

    public function actionCastVote()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = (int)Yii::$app->request->post('movie_id', 0);
        if (!Movie::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('Фильм не найден.');
        }
        if (Vote::find()->where(['user_id' => Yii::$app->user->id])->exists()) {
            return ['ok' => false, 'message' => 'Вы уже проголосовали.'];
        }
        $vote = new Vote();
        $vote->user_id = Yii::$app->user->id;
        $vote->movie_id = $id;
        $vote->voted_at = date('Y-m-d H:i:s');
        if (!$vote->save()) {
            return ['ok' => false, 'message' => 'Не удалось сохранить голос.'];
        }
        return ['ok' => true];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) return $this->redirect(['site/profile']);
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/profile']);
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model, 'signupModel' => new SignupForm(), 'activeTab' => 'login',
        ]);
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) return $this->redirect(['site/profile']);
        $signupModel = new SignupForm();
        if ($signupModel->load(Yii::$app->request->post())) {
            $user = $signupModel->register();
            if ($user !== null) {
                Yii::$app->user->login($user);
                return $this->redirect(['site/profile']);
            }
        }
        $signupModel->password = '';
        return $this->render('login', [
            'model' => new LoginForm(), 'signupModel' => $signupModel, 'activeTab' => 'register',
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
