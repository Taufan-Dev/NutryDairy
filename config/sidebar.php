<?php

return [
    'menu' => [[
        'icon' => 'fa fa-home',
        'title' => 'Dashboard',
        'url' => '/dashboard',
        'permission' => 'admin',
        'route_name' => 'dashboard',
    ], [
        'icon' => 'fa fa-home',
        'title' => 'Halaman Utama',
        'url' => '/',
    ], [
        'icon' => 'fa fa-newspaper',
        'title' => 'Artikel',
        'url' => '/education_contents',
        'permission' => 'admin',
        'route_name' => 'education_contents.index',
    ], [
        'icon' => 'fa fa-question-circle',
        'title' => 'Bank Soal',
        'url' => '/quizzes',
        'permission' => 'admin',
        'route_name' => 'quizzes.index',
    ]],
];
