<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="movie-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'genre')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'year')->input('number', ['min' => 1888, 'max' => 2100]) ?>
    <?= $form->field($model, 'rating')->input('number', ['min' => 0, 'max' => 10, 'step' => '0.1']) ?>
    <?= $form->field($model, 'duration')->input('number', ['min' => 1]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'poster')->textInput(['placeholder' => 'interstellar.jpg']) ?>
    <?= Html::submitButton($model->isNewRecord ? 'Добавить фильм' : 'Сохранить', ['class' => 'btn gold']) ?>
    <?php ActiveForm::end(); ?>
</div>
