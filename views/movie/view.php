<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Movie $model */

$this->title = $model->title;
?>
<section class="movie-admin movie-admin--detail">
    <div class="movie-admin__heading">
        <div>
            <span class="eyebrow">КАТАЛОГ ФИЛЬМОВ</span>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?= Html::a('К списку фильмов', ['movie/index'], ['class' => 'btn outline']) ?>
    </div>
    <div class="movie-admin__panel">
        <div class="movie-admin__actions movie-admin__actions--top">
            <?= Html::a('Редактировать', ['movie/update', 'id' => $model->id], ['class' => 'btn gold']) ?>
            <?= Html::beginForm(['movie/delete', 'id' => $model->id], 'post', [
                'class' => 'movie-admin__delete-form',
                'onsubmit' => "return confirm('Удалить этот фильм?');",
            ]) ?>
                <?= Html::submitButton('Удалить фильм', ['class' => 'btn movie-admin__danger']) ?>
            <?= Html::endForm() ?>
        </div>
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'movie-admin__details'],
            'attributes' => [
                'id', 'title', 'genre', 'year', 'rating', 'duration', 'description:ntext',
                [
                    'attribute' => 'poster',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        if (!$model->poster) { return 'Не указан'; }
                        return Html::img('@web/assets/images/' . rawurlencode(basename((string) $model->poster)), [
                            'alt' => $model->title,
                            'class' => 'movie-admin__poster',
                            'loading' => 'lazy',
                        ]);
                    },
                ],
            ],
        ]) ?>
    </div>
</section>
