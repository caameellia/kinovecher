<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Админ-панель — Киновечер';
?>
<section class="admin-page">
    <span class="eyebrow">УПРАВЛЕНИЕ САЙТОМ</span>
    <h1>Админ-панель</h1>
    <p class="muted">Фильмы, пользователи и активность сайта.</p>
    <div class="admin-stats">
        <div class="admin-stat"><strong><?= (int) $movieCount ?></strong><span>Фильмов</span></div>
        <div class="admin-stat"><strong><?= (int) $userCount ?></strong><span>Пользователей</span></div>
        <div class="admin-stat"><strong><?= (int) $listCount ?></strong><span>Записей в коллекциях</span></div>
        <div class="admin-stat"><strong><?= (int) $voteCount ?></strong><span>Голосов</span></div>
    </div>
    <div class="admin-section">
        <h2>Каталог фильмов</h2>
        <p class="muted">Добавляй, редактируй и удаляй фильмы в административном CRUD, созданном через Gii.</p>
        <?= Html::a('Управление фильмами', ['movie/index'], ['class' => 'btn gold']) ?>
        <?= Html::a('Добавить фильм', ['movie/create'], ['class' => 'btn outline']) ?>
    </div>
    <div class="admin-section">
        <h2>Недавние пользователи</h2>
        <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th><th>Дата регистрации</th></tr></thead><tbody>
        <?php foreach ($newUsers as $user): ?>
            <tr><td><?= (int)$user->id ?></td><td><?= Html::encode($user->username) ?></td><td><?= Html::encode($user->email) ?></td><td><?= Html::encode($user->role) ?></td><td><?= Html::encode($user->created_at) ?></td></tr>
        <?php endforeach; ?>
        </tbody></table></div>
        <p class="small-note">Права администратора изменяются только доверенным лицом через базу данных. Публичная регистрация всегда присваивает роль user.</p>
    </div>
</section>
