<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property string $title
 * @property string $genre
 * @property int $year
 * @property float|null $rating
 * @property int|null $duration
 * @property string|null $description
 * @property string|null $poster
 *
 * @property UserMovie[] $userMovies
 * @property User[] $users
 */
class Movie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'genre', 'year'], 'required'],
            [['year', 'duration'], 'integer'],
            ['year', 'integer', 'min' => 1888, 'max' => 2100],
            ['rating', 'number', 'min' => 0, 'max' => 10],
            [['title', 'poster'], 'string', 'max' => 255],
            [['genre'], 'string', 'max' => 100],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название фильма',
            'genre' => 'Жанр',
            'year' => 'Год выпуска',
            'rating' => 'Рейтинг',
            'duration' => 'Длительность',
            'description' => 'Описание',
            'poster' => 'Постер',
        ];
    }

    /**
     * Gets query for [[UserMovies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserMovies()
    {
        return $this->hasMany(UserMovie::className(), ['movie_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_movie', ['movie_id' => 'id']);
    }
}
