<?php

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */
/** @var app\models\SignupForm $signupModel */
/** @var string $activeTab */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Вход и регистрация — Киновечер';
$activeTab = ($activeTab ?? 'login') === 'register' ? 'register' : 'login';
?>
<section class="auth-grid" aria-label="Вход и регистрация">
  <div class="auth-intro">
    <span class="eyebrow">КИНОВЕЧЕР</span>
    <h1>Твой следующий киновечер начинается здесь</h1>
    <p>Войди, чтобы сохранять просмотренные фильмы и свой список «Хочу посмотреть».</p>
  </div>

  <div class="auth-card">
    <div class="auth-tabs" role="tablist" aria-label="Выбор формы">
      <button type="button" role="tab" data-yii-auth-tab="login"
              aria-selected="<?= $activeTab === 'login' ? 'true' : 'false' ?>"
              aria-controls="panel-login">Вход</button>
      <button type="button" role="tab" data-yii-auth-tab="register"
              aria-selected="<?= $activeTab === 'register' ? 'true' : 'false' ?>"
              aria-controls="panel-register">Регистрация</button>
    </div>

    <div id="panel-login" role="tabpanel" <?= $activeTab !== 'login' ? 'hidden' : '' ?>>
      <h2>Добро пожаловать!</h2>
      <p class="muted">Введи имя пользователя и пароль.</p>
      <?= Html::beginForm(Url::to(['site/login']), 'post', ['class' => 'login-form']) ?>
        <label class="field" for="login-username">Имя пользователя</label>
        <?= Html::activeTextInput($model, 'username', [
            'id' => 'login-username', 'class' => 'input',
            'placeholder' => 'Имя пользователя', 'autocomplete' => 'username',
            'required' => true,
        ]) ?>
        <div class="field-error"><?= Html::encode($model->getFirstError('username')) ?></div>

        <label class="field" for="login-password">Пароль</label>
        <?= Html::activePasswordInput($model, 'password', [
            'id' => 'login-password', 'class' => 'input',
            'placeholder' => 'Пароль', 'autocomplete' => 'current-password',
            'required' => true,
        ]) ?>
        <div class="field-error"><?= Html::encode($model->getFirstError('password')) ?></div>

        <label class="auth-remember">
          <?= Html::activeCheckbox($model, 'rememberMe', ['label' => null]) ?>
          Запомнить меня
        </label>
        <?= Html::submitButton('Войти', ['class' => 'btn gold wide']) ?>
      <?= Html::endForm() ?>
      <p class="auth-switch-note">Нет аккаунта?
        <button type="button" data-yii-auth-tab="register">Зарегистрироваться</button>
      </p>
    </div>

    <div id="panel-register" role="tabpanel" <?= $activeTab !== 'register' ? 'hidden' : '' ?>>
      <h2>Создать аккаунт</h2>
      <p class="muted">Создай свой профиль в «Киновечере».</p>
      <?= Html::beginForm(Url::to(['site/signup']), 'post', ['class' => 'login-form']) ?>
        <label class="field" for="signup-username">Имя пользователя</label>
        <?= Html::activeTextInput($signupModel, 'username', [
            'id' => 'signup-username', 'class' => 'input',
            'placeholder' => 'Имя пользователя', 'autocomplete' => 'username',
            'required' => true,
        ]) ?>
        <div class="field-error"><?= Html::encode($signupModel->getFirstError('username')) ?></div>

        <label class="field" for="signup-email">Email</label>
        <?= Html::activeInput('email', $signupModel, 'email', [
            'id' => 'signup-email', 'class' => 'input',
            'placeholder' => 'example@mail.ru', 'autocomplete' => 'email',
            'required' => true,
        ]) ?>
        <div class="field-error"><?= Html::encode($signupModel->getFirstError('email')) ?></div>

        <label class="field" for="signup-password">Пароль</label>
        <?= Html::activePasswordInput($signupModel, 'password', [
            'id' => 'signup-password', 'class' => 'input',
            'placeholder' => 'Не менее 8 символов', 'autocomplete' => 'new-password',
            'minlength' => 8, 'required' => true,
        ]) ?>
        <div class="field-error"><?= Html::encode($signupModel->getFirstError('password')) ?></div>

        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn gold wide']) ?>
      <?= Html::endForm() ?>
      <p class="auth-switch-note">Уже есть аккаунт?
        <button type="button" data-yii-auth-tab="login">Войти</button>
      </p>
    </div>
  </div>
</section>
