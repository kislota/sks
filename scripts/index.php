<?php
$steps = [
    'main' => [
        'title' => 'Учебник.',
        'file' => 'main.md',
    ],
    'step-0' => [
        'title' => 'Знакомимся с приложением.',
        'file' => 'step-000.0.md',
    ],
    'step-0.1' => [
        'title' => 'Виды и шаблоны.',
        'file' => 'step-000.1.md',
    ],
    'step-0.2' => [
        'title' => 'Формы.',
        'file' => 'step-000.2.md',
    ],
    'step-0.3' => [
        'title' => 'Обработка формы.',
        'file' => 'step-000.3.md',
    ],
    'step-0.4' => [
        'title' => 'Административное приложение Backend.',
        'file' => 'step-000.4.md',
    ],
    'step-1' => [
        'title' => 'Знакомство с тестированием.',
        'file' => 'step-001.0.md',
    ],
    'step-1.1' => [
        'title' => 'Доступ к реляционным данным.',
        'file' => 'step-001.1.md',
    ],
    'step-1.2' => [
        'title' => 'Отображение реляционных данных.',
        'file' => 'step-001.2.md',
    ],
    'step-1.3' => [
        'title' => 'Сохранение реляционных данных.',
        'file' => 'step-001.3.md',
    ],
];

if (isset($_GET['c'], $steps[$_GET['c']])) {
    $step = $steps[$_GET['c']];
} else {
    $step = $steps['main'];
}

require_once __DIR__ . '/vendor/autoload.php';

$markdown = file_get_contents(__DIR__ . '/steps/' . $step['file']);
$parser = new \cebe\markdown\GithubMarkdown();
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Учебник по Yii2: <?= $step['title'] ?></title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/readable/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/styles/default.min.css">
</head>
<body class="container">



<div class="row">

    <div class="col-md-9 col-lg-8">
        <?= $parser->parse($markdown); ?>
    </div>
    <div class="col-md-3 col-lg-4">
        <ul class="nav">
            <?php foreach ($steps as $key => $_step) { ?>
                <li>
                    <a href="/scripts/index.php?c=<?= $key ?>"><?= $_step['title'] ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<hr>
<footer>

</footer>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>

</html>

