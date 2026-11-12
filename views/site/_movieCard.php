<?php
/** @var \app\models\Movie $movie */
use yii\helpers\Html;
use yii\helpers\Url;
$quickActions = $quickActions ?? false;
?>
<article class="film" data-title="<?= Html::encode($movie->title) ?>"
    data-year="<?= (int)$movie->year ?>" data-genre="<?= Html::encode($movie->genre) ?>"
    data-rating="<?= Html::encode($movie->rating ?? 0) ?>"
    data-duration="<?= (int)$movie->duration ?>">
    <a href="<?= Url::to(['site/movie', 'id' => $movie->id]) ?>">
        <div class="poster">
            <?= Html::img('@web/assets/images/' . basename((string)$movie->poster), [
                'alt' => 'Постер: ' . $movie->title,
                'loading' => 'lazy', 'decoding' => 'async',
            ]) ?>
            <span class="score"><?= $this->render('_icon', ['name' => 'star']) ?> <?= Html::encode($movie->rating) ?></span>
        </div>
        <div class="film-title"><?= Html::encode($movie->title) ?></div>
        <div class="film-meta"><?= (int)$movie->year ?> · <?= Html::encode($movie->genre) ?></div>
    </a>
    <?php if ($quickActions): ?>
        <div class="film-quick-actions">
            <button type="button" class="film-action" data-movie-id="<?= (int)$movie->id ?>"
                data-film-action="watchlist" aria-label="Хочу посмотреть: <?= Html::encode($movie->title) ?>" title="Хочу посмотреть">
                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z"/></svg>
            </button>
            <button type="button" class="film-action" data-movie-id="<?= (int)$movie->id ?>"
                data-film-action="watched" aria-label="Просмотрено: <?= Html::encode($movie->title) ?>" title="Просмотрено">
                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" aria-hidden="true"><path d="m4 12 5 5L20 6"/></svg>
            </button>
        </div>
    <?php endif; ?>
</article>
