<?php
use yii\helpers\Html;
use yii\helpers\Url;
$user = Yii::$app->user->identity;
$this->title = 'Профиль — Киновечер';
?>
<section class="profile-page">
    <section class="profile-intro">
        <div class="profile-avatar" aria-hidden="true"><?= $this->render('_icon', ['name' => 'user']) ?></div>
        <div class="profile-info">
            <span class="eyebrow">ЛИЧНЫЙ КАБИНЕТ</span>
            <h1 id="profile-heading"><?= Html::encode($user->username) ?></h1>
            <p class="profile-date">На сайте с <time id="profile-joined" datetime="<?= Html::encode(substr($user->created_at, 0, 10)) ?>"><?= Html::encode(date('d.m.Y', strtotime($user->created_at))) ?></time></p>
        </div>
        <?= Html::beginForm(['site/logout'], 'post') ?>
            <?= Html::submitButton('Выйти', ['class' => 'btn outline']) ?>
        <?= Html::endForm() ?>
    </section>
    <div class="profile-stats">
        <div class="profile-stat"><span><b id="profile-watched-count"><?= count($watched) ?></b><small>Просмотрено</small></span></div>
        <div class="profile-stat"><span><b id="profile-watchlist-count"><?= count($watchlist) ?></b><small>Хочу посмотреть</small></span></div>
    </div>
    <?php foreach (['watched' => $watched, 'watchlist' => $watchlist] as $type => $movies): ?>
        <section class="profile-section">
            <div class="section-title">
                <h2><?= $type === 'watched' ? 'Просмотренные фильмы' : 'Хочу посмотреть' ?></h2>
                <?= Html::a('Каталог →', ['site/catalog'], ['class' => 'more']) ?>
            </div>
            <div class="profile-movies" id="profile-<?= $type ?>-list">
                <?php foreach ($movies as $movie): ?>
                    <article class="profile-film">
                        <a class="profile-film-image" href="<?= Url::to(['site/movie', 'id' => $movie->id]) ?>">
                            <?= Html::img('@web/assets/images/' . basename((string)$movie->poster), ['alt' => 'Постер: ' . $movie->title]) ?>
                        </a>
                        <div class="profile-film-bottom">
                            <div><div class="profile-film-title"><?= Html::encode($movie->title) ?></div>
                                <div class="profile-film-meta"><?= (int)$movie->year ?> · <?= Html::encode($movie->genre) ?></div></div>
                            <button type="button" class="profile-remove" data-remove-movie-id="<?= (int)$movie->id ?>" title="Убрать из списка" aria-label="Убрать <?= Html::encode($movie->title) ?>"><?= $this->render('_icon', ['name' => 'close']) ?></button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if (!$movies): ?>
                <p class="profile-empty">Пока здесь пусто. Добавь фильмы из каталога.</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
</section>
