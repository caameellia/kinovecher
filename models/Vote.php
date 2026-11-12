<?php
namespace app\models;
use yii\db\ActiveRecord;

class Vote extends ActiveRecord
{
    public static function tableName() { return '{{%vote}}'; }
    public function rules()
    {
        return [
            [['user_id', 'movie_id'], 'required'],
            [['user_id', 'movie_id'], 'integer'],
            ['voted_at', 'safe'],
            [['user_id'], 'unique'],
        ];
    }
    public function getUser() { return $this->hasOne(User::class, ['id' => 'user_id']); }
    public function getMovie() { return $this->hasOne(Movie::class, ['id' => 'movie_id']); }
}
