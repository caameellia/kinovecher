<?php
$this->title = 'Главная — Киновечер';
?>
<section class="hero" data-slide="0" aria-label="Рекомендуемые фильмы">
        <div>
          <span class="eyebrow">РЕКОМЕНДУЕМ К ПРОСМОТРУ</span>
          <h1>Джон Уик 4</h1>
          <div class="hero-small">
            2023
            <span>•</span>
            Боевик
            <span>•</span>
            2 ч 49 мин
            <span style="color:#ffc548"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 8.1</span>
          </div>
          <p>Легендарный наёмный убийца снова вынужден сражаться за свободу в мире, где у всего есть цена.</p>
          <div class="hero-row">
            <a class="btn gold" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m8 5 11 7-11 7z"/></svg> Смотреть подборку</a>
            <a class="btn outline" href="<?= \yii\helpers\Url::to(['site/voting']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z"/></svg> Голосовать</a>
          </div>
        </div>
        <div class="hero-pagination" aria-label="Слайды"><button type="button" data-hero-dot="0" class="is-active" aria-label="Слайд 1" aria-current="true"></button><button type="button" data-hero-dot="1" aria-label="Слайд 2"></button><button type="button" data-hero-dot="2" aria-label="Слайд 3"></button></div>
        <div aria-label="Слайды рекомендуемых фильмов" class="hero-controls">
          <button aria-label="Предыдущий фильм" data-hero="prev" type="button"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg></button>
          <button aria-label="Следующий фильм" data-hero="next" type="button"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg></button>
        </div>
      </section>
      <section class="section">
        <div class="section-title">
          <h2>Популярное</h2>
          <a class="more" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>">Смотреть все <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
        <div class="grid-films">
          <?php foreach ($popular as $movie): ?>
            <?= $this->render('_movieCard', ['movie' => $movie, 'quickActions' => false]) ?>
          <?php endforeach; ?>

        </div>
      </section>
      <section class="section" id="collections">
        <div class="section-title">
          <h2>Подборки для киновечера</h2>
          <a class="more" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>">Все подборки <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
        <div class="collections">
          <a class="collection" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><strong>Фильмы для уютного вечера</strong> <small>12 фильмов <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></small></a>
          <a class="collection" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><strong>Захватывающие триллеры</strong> <small>18 фильмов <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></small></a>
          <a class="collection" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><strong>Культовая классика</strong> <small>24 фильма <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></small></a>
        </div>
      </section>
      <section class="section">
        <div class="section-title">
          <h2>Фильмы по жанрам</h2>
        </div>
        <div class="genres">
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 2 5 13h6l-1 9 9-12h-6z"/></svg> Боевики</a>
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M8 14q4 5 8 0M8.5 9h.1M15.5 9h.1"/></svg> Комедии</a>
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 4h18v9c0 5-4 8-9 9-5-1-9-4-9-9zM8 10h.1M16 10h.1M8 15q4-3 8 0"/></svg> Драмы</a>
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 2.2 7.8L22 12l-7.8 2.2L12 22l-2.2-7.8L2 12l7.8-2.2z"/></svg> Фантастика</a>
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 15A8 8 0 0 1 9 4a8.5 8.5 0 1 0 11 11z"/></svg> Ужасы</a>
          <a class="pill" href="<?= \yii\helpers\Url::to(['site/catalog']) ?>"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 10h16v11H4zM3 9l2-6 16 4-2 5zM9 4l3 6M16 6l-3 5"/></svg> Мультфильмы</a>
        </div>
      </section>
      <section class="section">
        <div class="section-title">
          <h2>Сегодня голосуют</h2>
          <a class="more" href="<?= \yii\helpers\Url::to(['site/voting']) ?>">К голосованию <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
        <div class="vote-row">
          <div class="vote-tile">
            <?= \yii\helpers\Html::img('@web/assets/images/oppenheimer.jpg', ['alt' => 'Постер фильма', 'decoding' => 'async', 'loading' => 'lazy']) ?>
            <div>
              <b>Оппенгеймер</b>
              <div class="film-meta">
                2023 · Драма
              </div>
              <div class="film-meta">
                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 8.8 · 1248 голосов
              </div>
              <a class="btn" href="<?= \yii\helpers\Url::to(['site/voting']) ?>">Голосовать</a>
            </div>
          </div>
          <div class="vote-tile">
            <?= \yii\helpers\Html::img('@web/assets/images/dune.jpg', ['alt' => 'Постер фильма', 'decoding' => 'async', 'loading' => 'lazy']) ?>
            <div>
              <b>Дюна</b>
              <div class="film-meta">
                2021 · Фантастика
              </div>
              <div class="film-meta">
                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 8.5 · 980 голосов
              </div>
              <a class="btn" href="<?= \yii\helpers\Url::to(['site/voting']) ?>">Голосовать</a>
            </div>
          </div>
          <div class="vote-tile">
            <?= \yii\helpers\Html::img('@web/assets/images/interstellar.jpg', ['alt' => 'Постер фильма', 'decoding' => 'async', 'loading' => 'lazy']) ?>
            <div>
              <b>Интерстеллар</b>
              <div class="film-meta">
                2014 · Фантастика
              </div>
              <div class="film-meta">
                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 9.2 · 642 голосов
              </div>
              <a class="btn" href="<?= \yii\helpers\Url::to(['site/voting']) ?>">Голосовать</a>
            </div>
          </div>
        </div>
      </section>