<?php

use yii\db\Migration;

class m261112_061613_create_kinovecher_tables extends Migration
{
    public function safeUp()
    {
        // Пользователи
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull()->unique(),
            'email' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'role' => $this->string(20)->notNull()->defaultValue('user'),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        // Каталог фильмов
        $this->createTable('{{%movie}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'genre' => $this->string(100)->notNull(),
            'year' => $this->integer()->notNull(),
            'rating' => $this->decimal(3, 1),
            'duration' => $this->integer(),
            'description' => $this->text(),
            'poster' => $this->string(255),
        ]);

        // Личные списки фильмов
        $this->createTable('{{%user_movie}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'movie_id' => $this->integer()->notNull(),
            'status' => $this->string(20)->notNull(),
            'added_at' => $this->dateTime()->notNull(),
        ]);

        // Защита от повторного добавления фильма
        $this->createIndex(
            'idx-user-movie-unique',
            '{{%user_movie}}',
            ['user_id', 'movie_id'],
            true
        );

        // Связь с пользователем
        $this->addForeignKey(
            'fk-user-movie-user',
            '{{%user_movie}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // Связь с фильмом
        $this->addForeignKey(
            'fk-user-movie-movie',
            '{{%user_movie}}',
            'movie_id',
            '{{%movie}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_movie}}');
        $this->dropTable('{{%movie}}');
        $this->dropTable('{{%user}}');
    }
}
