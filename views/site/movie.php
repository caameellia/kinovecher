<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = $movie->title . ' — Киновечер';
?>
<section class="detail-top">
    <?= Html::img('@web/assets/images/' . basename((string)$movie->poster), [
        'alt' => 'Постер: ' . $movie->title,
        'class' => 'detail-poster',
    ]) ?>
    <div>
        <span class="eyebrow">КАТАЛОГ / <?= Html::encode(mb_strtoupper($movie->genre)) ?></span>
        <h1><?= Html::encode($movie->title) ?></h1>
        <div class="muted"><?= (int)$movie->year ?> · <?= Html::encode($movie->genre) ?> · <?= (int)$movie->duration ?> мин</div>
        <div class="rating"><?= $this->render('_icon', ['name' => 'star']) ?> <?= Html::encode($movie->rating) ?></div>
        <p class="description"><?= nl2br(Html::encode($movie->description ?: 'Описание скоро появится.')) ?></p>
        <div class="actions">
            <button class="btn gold" type="button" id="trailer-button" data-trailer-title="<?= Html::encode($movie->title) ?>"><?= $this->render('_icon', ['name' => 'play']) ?> Смотреть трейлер</button>
            <button class="btn outline" type="button" id="watchlist-button" data-movie-id="<?= (int)$movie->id ?>" data-film-action="watchlist"><?= $this->render('_icon', ['name' => 'heart']) ?> Хочу посмотреть</button>
            <button class="btn green" type="button" id="watched-button" data-movie-id="<?= (int)$movie->id ?>" data-film-action="watched"><?= $this->render('_icon', ['name' => 'check']) ?> Просмотрено</button>
        </div>
        <div class="genres"><span class="pill"><?= Html::encode($movie->genre) ?></span></div>
    </div>
</section>
<section class="section">
    <div class="section-title"><h2>Похожие фильмы</h2><?= Html::a('Смотреть все →', ['site/catalog'], ['class' => 'more']) ?></div>
    <div class="grid-films">
        <?php foreach ($related as $item): ?>
            <?= $this->render('_movieCard', ['movie' => $item, 'quickActions' => false]) ?>
        <?php endforeach; ?>
    </div>
</section>
