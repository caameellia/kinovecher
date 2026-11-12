<?php
$this->title = 'Каталог фильмов — Киновечер';
?>

      <div class="layout">
        <button aria-controls="filters" aria-expanded="false" class="btn mobile-filter-toggle" type="button"><svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 7h16M7 12h10m-7 5h4"/><circle cx="8" cy="7" r="2"/><circle cx="16" cy="12" r="2"/></svg> Показать фильтры</button>
        <aside class="sidebar" id="filters">
          <h3>Фильтры <a class="more" href="#filters" id="reset-filters" style="float:right">Сбросить</a></h3>
          <input aria-label="Поиск по каталогу" class="input" id="catalog-search" placeholder="Найти..." type="search">
          <div class="rule">
          </div>
          <h3>Жанры</h3>
          <label><input aria-label="Боевики" data-filter="genre" type="checkbox" value="Боевик"> Боевики</label>
          <label><input aria-label="Комедии" data-filter="genre" type="checkbox" value="Комедия"> Комедии</label>
          <label><input aria-label="Драмы" data-filter="genre" type="checkbox" value="Драма"> Драмы</label>
          <label><input aria-label="Фантастика" data-filter="genre" type="checkbox" value="Фантастика"> Фантастика</label>
          <label><input aria-label="Ужасы" data-filter="genre" type="checkbox" value="Ужасы"> Ужасы</label>
          <label><input aria-label="Мультфильмы" data-filter="genre" type="checkbox" value="Мультфильм"> Мультфильмы</label>
          <label><input aria-label="Триллеры" data-filter="genre" type="checkbox" value="Триллер"> Триллеры</label>
          <label><input aria-label="Мелодрамы" data-filter="genre" type="checkbox" value="Мелодрама"> Мелодрамы</label>
          <div class="rule">
          </div>
          <h3>Год выпуска</h3>
          <label>1980 — 2026</label>
          <input aria-label="Максимальный год выхода" class="filter-range" id="year-filter" max="2026" min="1980" style="width:100%;accent-color:#ffc548" type="range" value="2026">
          <div class="rule">
          </div>
          <h3>Рейтинг</h3>
          <label><input aria-label="Рейтинг 6 и выше" value="6" data-filter="rating" type="radio" name="rating"> <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 6 и выше</label>
          <label><input aria-label="Рейтинг 7 и выше" value="7" data-filter="rating" type="radio" name="rating"> <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 7 и выше</label>
          <label><input aria-label="Рейтинг 8 и выше" value="8" data-filter="rating" type="radio" name="rating"> <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 8 и выше</label>
          <label><input aria-label="Рейтинг 9 и выше" value="9" data-filter="rating" type="radio" name="rating"> <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/></svg> 9 и выше</label>
          <div class="rule">
          </div>
          <h3>Длительность</h3>
          <input aria-label="Максимальная длительность" class="filter-range" id="duration-filter" max="300" min="60" style="width:100%;accent-color:#ffc548" type="range" value="300">
          <p class="muted">0 мин — 300 мин</p>
        </aside>
        <div>
          <div class="catalog-head">
            <div>
              <h1>Каталог фильмов</h1>
              <span class="muted" id="film-count">Найдено <?= (int)$dataProvider->getTotalCount() ?> фильмов</span>
            </div>
            <select aria-label="Сортировка фильмов" class="select" id="sort-films">
              <option>По популярности</option>
              <option>По рейтингу</option>
              <option>По году</option><option>По названию</option>
            </select>
          </div>
          <div class="catalog-grid">
              <?php foreach ($dataProvider->getModels() as $movie): ?>
                <?= $this->render('_movieCard', ['movie' => $movie, 'quickActions' => true]) ?>
              <?php endforeach; ?>

          </div>
          <?= \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination,
                'options' => ['class' => 'kv-pagination'],
                'linkOptions' => ['class' => 'kv-page-link'],
            ]) ?>
            <p class="empty-state" <?= $dataProvider->getTotalCount() ? 'hidden' : '' ?> id="no-results">По заданным фильтрам ничего не найдено. Попробуйте сбросить фильтры.</p>
        </div>
      </div>