<?php
use yii\helpers\Html;
$this->title = 'Голосование — Киновечер';
$totalVotes = array_sum($totals);
?>
<section>
    <span class="eyebrow">КИНОВЕЧЕР ЭТОЙ НЕДЕЛИ</span>
    <h1>Голосование за фильм вечера</h1>
    <!-- <p class="muted">Один аккаунт — один голос. Результаты сохраняются в MySQL.</p> -->
    <p class="small-note" id="vote-message" role="status"><?= $currentVote ? 'Ваш голос сохранён.' : (Yii::$app->user->isGuest ? 'Для голосования войдите в аккаунт.' : 'Выберите фильм.') ?></p>
    <div class="vote-list">
        <?php foreach ($movies as $movie): ?>
            <?php $count = (int)($totals[$movie->id] ?? 0); $percent = $totalVotes ? round(100 * $count / $totalVotes) : 0; ?>
            <div class="vote-item" data-movie="<?= Html::encode($movie->title) ?>">
                <?= Html::img('@web/assets/images/' . basename((string)$movie->poster), ['alt' => 'Постер: ' . $movie->title, 'loading' => 'lazy']) ?>
                <div class="vote-info">
                    <strong><?= Html::encode($movie->title) ?></strong>
                    <p class="muted"><?= (int)$movie->year ?> · <?= Html::encode($movie->genre) ?> · <?= $this->render('_icon', ['name' => 'star']) ?> <?= Html::encode($movie->rating) ?></p>
                    <div class="bar"><div style="width:<?= $percent ?>%"></div></div>
                    <p class="muted"><?= $count ?> голосов · <?= $percent ?>%</p>
                </div>
                <button type="button" class="btn gold" data-vote-id="<?= (int)$movie->id ?>"
                    <?= $currentVote ? 'disabled' : '' ?>><?= $currentVote && (int)$currentVote->movie_id === (int)$movie->id ? 'Ваш голос' : 'Голосовать' ?></button>
            </div>
        <?php endforeach; ?>
    </div>
</section>
