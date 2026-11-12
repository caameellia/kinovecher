<?php
/** SVG-иконки для PHP-представлений (без внешних библиотек). */
$icons = [
    'star' => '<path d="m12 2 3.2 6.6 7.3 1-5.3 5.2 1.3 7.2-6.5-3.4-6.5 3.4 1.3-7.2-5.3-5.2 7.3-1z"/>',
    'heart' => '<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8z"/>',
    'check' => '<path d="m4 12 5 5L20 6"/>',
    'user' => '<circle cx="12" cy="8" r="4"/><path d="M4.5 21v-2a7.5 7.5 0 0 1 15 0v2"/>',
    'play' => '<path d="m8 5 11 7-11 7z"/>',
    'close' => '<path d="M5 5l14 14M19 5 5 19"/>',
];
$name = $name ?? 'star';
$path = $icons[$name] ?? $icons['star'];
?>
<svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"
     aria-hidden="true"><?= $path ?></svg>
