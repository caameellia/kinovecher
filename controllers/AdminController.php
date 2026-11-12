<?php
namespace app\controllers;
use Yii;
use app\models\Movie;
use app\models\User;
use app\models\UserMovie;
use app\models\Vote;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return ['access' => [
            'class' => AccessControl::class,
            'rules' => [[
                'allow' => true, 'roles' => ['@'],
                'matchCallback' => function () {
                    return Yii::$app->user->identity->role === 'admin';
                },
            ]],
        ]];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'movieCount' => Movie::find()->count(),
            'userCount' => User::find()->count(),
            'listCount' => UserMovie::find()->count(),
            'voteCount' => Vote::find()->count(),
            'newUsers' => User::find()->orderBy(['id' => SORT_DESC])->limit(8)->all(),
        ]);
    }
}
