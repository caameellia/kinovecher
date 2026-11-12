<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_movie".
 *
 * @property int $id
 * @property int $user_id
 * @property int $movie_id
 * @property string $status
 * @property string $added_at
 *
 * @property Movie $movie
 * @property User $user
 */
class UserMovie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'movie_id', 'status'], 'required'],
            [['user_id', 'movie_id'], 'integer'],
            [['added_at'], 'safe'],
            ['status', 'in', 'range' => ['watched', 'watchlist']],
            [['user_id', 'movie_id'], 'unique', 'targetAttribute' => ['user_id', 'movie_id']],
            [['movie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movie::className(), 'targetAttribute' => ['movie_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'movie_id' => 'Movie ID',
            'status' => 'Status',
            'added_at' => 'Added At',
        ];
    }

    /**
     * Gets query for [[Movie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function beforeValidate()
    {
        if (!$this->added_at) {
            $this->added_at = date('Y-m-d H:i:s');
        }
        return parent::beforeValidate();
    }

    public function getMovie()
    {
        return $this->hasOne(Movie::className(), ['id' => 'movie_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
