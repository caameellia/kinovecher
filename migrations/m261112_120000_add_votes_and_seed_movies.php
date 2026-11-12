<?php
use yii\db\Migration;

class m261112_120000_add_votes_and_seed_movies extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%vote}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'movie_id' => $this->integer()->notNull(),
            'voted_at' => $this->dateTime()->notNull(),
        ]);
        $this->createIndex('idx-vote-user-unique', '{{%vote}}', 'user_id', true);
        $this->addForeignKey('fk-vote-user', '{{%vote}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-vote-movie', '{{%vote}}', 'movie_id', '{{%movie}}', 'id', 'CASCADE');
        $movies = [
            ['Интерстеллар', 'Фантастика', 2014, 9.2, 169, 'Путешествие сквозь пространство и время.', 'interstellar.jpg'],
            ['Оппенгеймер', 'Драма', 2023, 8.8, 180, 'История физика Роберта Оппенгеймера.', 'oppenheimer.jpg'],
            ['Начало', 'Триллер', 2010, 8.7, 148, 'Путешествие по мирам сновидений.', 'inception.jpg'],
            ['Дюна', 'Фантастика', 2021, 8.5, 155, 'Планета Арракис и история Пола Атрейдеса.', 'dune.jpg'],
            ['Джокер', 'Драма', 2019, 8.4, 122, 'История Артура Флека.', 'joker.jpg'],
            ['Вверх', 'Мультфильм', 2009, 8.2, 96, 'Приключения Карла и Рассела.', 'up.jpg'],
            ['1+1', 'Комедия', 2011, 8.2, 112, 'История необычной дружбы.', 'intouchables.jpg'],
            ['Тёмный рыцарь', 'Боевик', 2008, 9.0, 152, 'Бэтмен противостоит Джокеру.', 'dark-knight.jpg'],
            ['Гладиатор', 'Боевик', 2000, 8.5, 155, 'История римского полководца Максимуса.', 'gladiator.jpg'],
            ['Зелёная миля', 'Драма', 1999, 8.6, 189, 'Необычные события в тюремном блоке.', 'green-mile.jpg'],
            ['Властелин колец', 'Фэнтези', 2001, 8.8, 178, 'Путешествие Братства Кольца.', 'lord-of-the-rings.jpg'],
            ['Гарри Поттер', 'Фэнтези', 2001, 7.9, 152, 'Первый учебный год в Хогвартсе.', 'harry-potter.jpg'],
        ];
        foreach ($movies as $movie) {
            if (!(new \yii\db\Query())->from('{{%movie}}')->where(['title' => $movie[0]])->exists()) {
                $this->insert('{{%movie}}', array_combine(
                    ['title', 'genre', 'year', 'rating', 'duration', 'description', 'poster'], $movie
                ));
            }
        }
    }

    public function safeDown()
    {
        // Демо-фильмы не удаляем: пользователи могли добавить их в свои списки.
        $this->dropTable('{{%vote}}');
    }
}
