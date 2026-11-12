
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);

$route = Yii::$app->controller->route;
$web = Yii::getAlias('@web');

$isAdmin = $route === 'admin/index' || strpos($route, 'movie/') === 0;
$isHome = $route === 'site/index';
$isCatalog = $route === 'site/catalog';
$isVoting = $route === 'site/voting';
$isProfile = in_array($route, [
    'site/profile',
    'site/login',
], true);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru" data-image-base="<?= Html::encode($web . '/assets/images/') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b1017">

    <title><?= Html::encode($this->title ?: 'Киновечер') ?></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<header>
    <a class="logo" href="<?= Url::to(['site/index']) ?>">
        <span class="logo-icon">
            <svg class="icon" width="18" height="18"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.9"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <circle cx="7" cy="7" r="1"/>
                <circle cx="17" cy="7" r="1"/>
                <circle cx="7" cy="17" r="1"/>
                <circle cx="17" cy="17" r="1"/>
                <circle cx="12" cy="12" r="9"/>
                <circle cx="12" cy="12" r="2"/>
            </svg>
        </span>
        <span class="logo-name"><b>Кино</b>вечер</span>
    </a>

    <button
        class="icon-button menu-toggle"
        type="button"
        aria-controls="primary-navigation"
        aria-expanded="false"
        aria-label="Открыть меню"
    >
        <svg class="icon" width="18" height="18"
             viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="1.9"
             stroke-linecap="round" stroke-linejoin="round"
             aria-hidden="true">
            <path d="M4 7h16M4 12h16M4 17h16"/>
        </svg>
    </button>

    <nav class="nav" id="primary-navigation" aria-label="Основная навигация">
        <?= Html::a('Главная', ['site/index'], [
            'class' => $isHome ? 'active' : '',
            'aria-current' => $isHome ? 'page' : null,
        ]) ?>
        <?= Html::a('Каталог', ['site/catalog'], [
            'class' => $isCatalog ? 'active' : '',
            'aria-current' => $isCatalog ? 'page' : null,
        ]) ?>
        <?= Html::a('Подборки', ['site/index', '#' => 'collections']) ?>
        <?= Html::a('Голосование', ['site/voting'], [
            'class' => $isVoting ? 'active' : '',
            'aria-current' => $isVoting ? 'page' : null,
        ]) ?>
        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
            <?= Html::a('Админ-панель', ['admin/index'], ['class' => $isAdmin ? 'active' : '']) ?>
        <?php endif; ?>
        <?= Html::a('Профиль', ['site/profile'], [
            'class' => $isProfile ? 'active' : '',
            'aria-current' => $isProfile ? 'page' : null,
        ]) ?>
    </nav>

    <div class="right">
        <form
            action="<?= Html::encode(Yii::$app->request->scriptUrl) ?>"
            class="search-form"
            id="global-search"
            method="get"
        >
            <input type="hidden" name="r" value="site/catalog">
            <input
                class="search"
                id="header-search"
                name="q"
                type="search"
                placeholder="Поиск фильмов..."
                aria-label="Поиск фильма"
            >

            <button type="submit" aria-label="Искать">
                <svg class="icon" width="18" height="18"
                     viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.9"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="10.7" cy="10.7" r="6.5"/>
                    <path d="m16 16 4.8 4.8"/>
                </svg>
            </button>
        </form>

        <a
            class="btn gold"
            data-auth-link
            href="<?= Url::to(['site/login']) ?>"
        >Войти</a>
    </div>
</header>

<main class="wrap">
    <?= $content ?>
</main>

<footer>
    <div class="footer-inner">
        <div>
            <span class="logo">
                <svg class="icon" width="18" height="18"
                     viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.9"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="7" cy="7" r="1"/>
                    <circle cx="17" cy="7" r="1"/>
                    <circle cx="7" cy="17" r="1"/>
                    <circle cx="17" cy="17" r="1"/>
                    <circle cx="12" cy="12" r="9"/>
                    <circle cx="12" cy="12" r="2"/>
                </svg>
                <span class="logo-name"><b>Кино</b>вечер</span>
            </span>

            <p>Фильмы объединяют людей. Здесь каждый найдёт, что посмотреть.</p>
        </div>

        <div>
            Главная Каталог Подборки Голосование
            <br>
            <br>
            Учебный проект на Yii2 · 2026
        </div>
    </div>
</footer>

<div class="mobile-bottom">
    <a
        href="<?= Url::to(['site/index']) ?>"
        class="<?= $isHome ? 'active' : '' ?>"
        <?= $isHome ? 'aria-current="page"' : '' ?>
    >
        <span>
            <svg class="icon" width="18" height="18"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.9"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="m3 11 9-8 9 8v9H3zM9 20v-7h6v7"/>
            </svg>
        </span>
        Главная
    </a>

    <a
        href="<?= Url::to(['site/catalog']) ?>"
        class="<?= $isCatalog ? 'active' : '' ?>"
        <?= $isCatalog ? 'aria-current="page"' : '' ?>
    >
        <span>
            <svg class="icon" width="18" height="18"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.9"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
        </span>
        Каталог
    </a>

    <a
        href="<?= Url::to(['site/voting']) ?>"
        class="<?= $isVoting ? 'active' : '' ?>"
        <?= $isVoting ? 'aria-current="page"' : '' ?>
    >
        <span>
            <svg class="icon" width="18" height="18"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.9"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/>
            </svg>
        </span>
        Голосование
    </a>

    <a
        href="<?= Url::to(['site/profile']) ?>"
        class="<?= $isProfile ? 'active' : '' ?>"
        <?= $isProfile ? 'aria-current="page"' : '' ?>
    >
        <span>
            <svg class="icon" width="18" height="18"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.9"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4.5 21v-2a7.5 7.5 0 0 1 15 0v2"/>
            </svg>
        </span>
        Профиль
    </a>
</div>

<script>
    window.KV_ROUTES = <?= json_encode([
        'index' => Url::to(['site/index']),
        'catalog' => Url::to(['site/catalog']),
        'movie' => Url::to(['site/movie']),
        'voting' => Url::to(['site/voting']),
        'profile' => Url::to(['site/profile']),
        'login' => Url::to(['site/login']),
        'logout' => Url::to(['site/logout']),
        'setStatus' => Url::to(['site/set-movie-status']),
        'vote' => Url::to(['site/cast-vote']),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
</script>

<script>
    window.KV_SERVER_USER = <?= json_encode(
        Yii::$app->user->isGuest ? null : [
            'id' => Yii::$app->user->id,
            'username' => Yii::$app->user->identity->username,
            'registeredAt' => date('c', strtotime(Yii::$app->user->identity->created_at)),
        ],
        JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
    ) ?>;

    window.KV_CSRF = {
        param: <?= json_encode(Yii::$app->request->csrfParam) ?>,
        token: <?= json_encode(Yii::$app->request->getCsrfToken()) ?>
    };
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
