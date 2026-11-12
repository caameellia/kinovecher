<?php

use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MovieSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление фильмами';
?>
<section class="movie-admin">
    <div class="movie-admin__heading">
        <div>
            <span class="eyebrow">АДМИНИСТРИРОВАНИЕ</span>
            <h1><?= Html::encode($this->title) ?></h1>
            <p class="muted">Добавляй фильмы, редактируй данные и управляй каталогом.</p>
        </div>
        <?= Html::a('Добавить фильм', ['create'], ['class' => 'btn gold']) ?>
    </div>

    <div class="movie-admin__filters">
        <?= Html::beginForm(['movie/index'], 'get', ['class' => 'movie-admin__filter-form']) ?>
            <label>
                <span>Название</span>
                <?= Html::textInput('MovieSearch[title]', $searchModel->title, ['placeholder' => 'Найти фильм', 'class' => 'movie-admin__input']) ?>
            </label>
            <label>
                <span>Жанр</span>
                <?= Html::textInput('MovieSearch[genre]', $searchModel->genre, ['placeholder' => 'Любой жанр', 'class' => 'movie-admin__input']) ?>
            </label>
            <label>
                <span>Год</span>
                <?= Html::input('number', 'MovieSearch[year]', $searchModel->year, ['placeholder' => 'Год', 'class' => 'movie-admin__input', 'min' => 1888, 'max' => 2100]) ?>
            </label>
            <div class="movie-admin__filter-actions">
                <?= Html::submitButton('Найти', ['class' => 'btn gold']) ?>
                <?= Html::a('Сбросить', ['movie/index'], ['class' => 'btn outline']) ?>
            </div>
        <?= Html::endForm() ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'options' => ['class' => 'movie-admin__grid'],
        'tableOptions' => ['class' => 'movie-admin__table'],
        'summaryOptions' => ['class' => 'movie-admin__summary'],
        'summary' => 'Показаны записи {begin}–{end} из {totalCount}',
        'emptyText' => 'Фильмов пока нет. Добавь первый фильм.',
        'emptyTextOptions' => ['class' => 'movie-admin__empty'],
        'pager' => [
            'options' => ['class' => 'movie-admin__pagination'],
            'linkOptions' => ['class' => 'movie-admin__page-link'],
            'disabledListItemSubTagOptions' => ['class' => 'movie-admin__page-link'],
        ],
        'columns' => [
            [
                'attribute' => 'title',
                'label' => 'Фильм',
                'contentOptions' => ['data-label' => 'Фильм'],
                'value' => static function ($model) { return $model->title; },
            ],
            ['attribute' => 'genre', 'label' => 'Жанр', 'contentOptions' => ['data-label' => 'Жанр']],
            ['attribute' => 'year', 'label' => 'Год', 'contentOptions' => ['data-label' => 'Год']],
            ['attribute' => 'rating', 'label' => 'Рейтинг', 'contentOptions' => ['data-label' => 'Рейтинг']],
            [
                'header' => 'Действия',
                'format' => 'raw',
                'contentOptions' => ['class' => 'movie-admin__row-actions', 'data-label' => 'Действия'],
                'value' => static function ($model) {
                    $view = Html::a('Просмотр', ['movie/view', 'id' => $model->id], ['class' => 'movie-admin__action']);
                    $edit = Html::a('Изменить', ['movie/update', 'id' => $model->id], ['class' => 'movie-admin__action']);
                    // This is an actual POST form with a Yii2 CSRF token, not a GET deletion link.
                    $delete = Html::beginForm(['movie/delete', 'id' => $model->id], 'post', ['class' => 'movie-admin__delete-form', 'onsubmit' => "return confirm('Удалить этот фильм?');"])
                        . Html::submitButton('Удалить', ['class' => 'movie-admin__action movie-admin__action--danger'])
                        . Html::endForm();
                    return '<div class="movie-admin__actions">' . $view . $edit . $delete . '</div>';
                },
            ],
        ],
    ]) ?>
</section>
