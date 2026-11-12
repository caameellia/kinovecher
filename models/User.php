<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key'], 'required'],
            [['username', 'email'], 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            ['username', 'match', 'pattern' => '/^[\p{L}\p{N}_-]+$/u'],
            ['username', 'unique'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],
            ['password_hash', 'string', 'max' => 255],
            ['auth_key', 'string', 'max' => 255],
            ['role', 'in', 'range' => ['user', 'admin']],
            ['created_at', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return ['id' => 'ID', 'username' => 'Имя пользователя', 'email' => 'Email',
            'role' => 'Роль', 'created_at' => 'Дата регистрации'];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
    }

    public static function emailExists($email)
    {
        return static::find()->where(['email' => mb_strtolower($email)])->exists();
    }

    public static function createUser($username, $email, $password)
    {
        $user = new static();
        $user->username = trim($username);
        $user->email = mb_strtolower(trim($email));
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        $user->auth_key = Yii::$app->security->generateRandomString(32);
        $user->role = 'user';
        $user->created_at = date('Y-m-d H:i:s');
        if (!$user->save()) {
            $errors = $user->getFirstErrors();
            throw new \DomainException(reset($errors) ?: 'Не удалось создать аккаунт.');
        }
        return $user;
    }

    public function getId() { return $this->getPrimaryKey(); }
    public function getAuthKey() { return $this->auth_key; }
    public function validateAuthKey($authKey) { return hash_equals((string) $this->auth_key, (string) $authKey); }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public function getUserMovies()
    {
        return $this->hasMany(UserMovie::class, ['user_id' => 'id']);
    }
    public function getMovies()
    {
        return $this->hasMany(Movie::class, ['id' => 'movie_id'])->via('userMovies');
    }
    public function getVotes()
    {
        return $this->hasMany(Vote::class, ['user_id' => 'id']);
    }
}
