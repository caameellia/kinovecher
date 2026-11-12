<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Movie $model */

$this->title = 'Редактировать фильм';
?>
<section class="movie-admin movie-admin--form">
    <div class="movie-admin__heading">
        <div>
            <span class="eyebrow">АДМИНИСТРИРОВАНИЕ</span>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?= Html::a('К списку фильмов', ['movie/index'], ['class' => 'btn outline']) ?>
    </div>
    <div class="movie-admin__panel">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</section>
