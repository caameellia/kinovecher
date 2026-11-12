<?php
// Скопируйте в db.php и укажите локальные настройки MySQL.
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=kinovecher',
    'username' => 'root',
    'password' => '', // Пароль задайте локально, в Git не публикуйте.
    'charset' => 'utf8mb4',
];
