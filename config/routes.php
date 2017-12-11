<?php

return array(
    //Заявки
    'order/add' => 'order/add', //Добавить новую завку
    'order/edit/([0-9]+)' => 'order/edit/$1', //Редактироавть заявку
    'order/del/([0-9]+)' => 'order/del/$1', //Удалить заявку
    'order/payment/page-([0-9]+)' => 'order/payment/$1', //Выборка по оплатам
    'order/payment' => 'order/payment', //Выборка по оплатам
    'order/status/([0-9]+)/page-([0-9]+)' => 'order/status/$1/$2', //Выборка по статусу заявки
    'order/status/([0-9]+)' => 'order/status/$1', //Выборка по статусу заявки
    'order/master/([0-9]+)/page-([0-9]+)' => 'order/master/$1/2$', //Выборка по мастеру
    'order/master/([0-9]+)' => 'order/master/$1', //Выборка по мастеру
    'order/media/([0-9]+)/page-([0-9]+)' => 'order/media/$1/$2', //Выборка по тому откуда о нас узнали
    'order/media/([0-9]+)' => 'order/media/$1', //Выборка по тому откуда о нас узнали
    'order/help/page-([0-9]+)' => 'order/help/$1', //Выборка по вызову специалиста
    'order/help' => 'order/help', //Выборка по вызову специалиста
    'order/cell/page-([0-9]+)' => 'order/cell/$1', //Выборка по ячейкам
    'order/cell' => 'order/cell', //Выборка по ячейкам
    'order/pay/([0-9]+)' => 'order/pay/$1', //Оплатить заявку
    'order/search' => 'order/search', //Живой поиск по клиентам
    'order/page-([0-9]+)' => 'order/index/$1', //Главная страница с заявками
    'order' => 'order/index', //Главная страница с заявками
    //Печать
    'print/([a-z]+)/([0-9]+)' => 'print/$1/$2', //Печать документа
    //Касса
    'kassa/add' => 'kassa/add', //Добавить
    'kassa/order' => 'kassa/order', //Заявки
    'kassa/part' => 'kassa/part', //Склад
    'kassa/user' => 'kassa/user', //Мастера
    'kassa/client' => 'kassa/client', //Клиенты
    'kassa/sale' => 'kassa/sale', //Продажи
    'kassa/coming' => 'kassa/coming', //Приход
    'kassa/cost' => 'kassa/cost', //Расход
    'kassa/pay/([a-z]+)/([0-9]+)' => 'kassa/pay/$1/$2', //Добавить
    'kassa/edit/([a-z]+[0-9]+)' => 'kassa/edit/$1', //Редактировать
    'kassa/del/([a-z]+[0-9]+)' => 'kassa/del/$1', //Удалить
    'kassa' => 'kassa/index', //Главная страница кассы
    //Магазин
    'shop/add' => 'shop/add', //Добавить
    'shop/edit/([a-z]+[0-9]+)' => 'shop/edit/$1', //Редактировать
    'shop/del/([a-z]+[0-9]+)' => 'shop/del/$1', //Удалить
    'shop' => 'shop/index', //Главная страница
    //Скдад
    'part/add' => 'part/add', //Добавить новую позицию на склад
    'part/edit/([0-9]+)' => 'part/edit/$1', //Редактировать позицию на складе
    'part/del/([0-9]+)' => 'part/del/$1', //Удалить позицию на складе
    'part/pay/([0-9]+)' => 'part/pay/$1', //Оплатить
    'part/all' => 'part/all', //Вывести всё ended
    'part/ended' => 'part/ended', //Вывести чего нет в наличии
    'part/category/([0-9]+)' => 'part/category/$1', //Вывести по категориям
    'part/counter/([0-9]+)' => 'part/counter/$1', //Вывести по поналичию
    'part' => 'part/index', //Главная страница склада
    //Клиенты
    'client/edit' => 'client/edit', //Редактировать
    'client/login' => 'client/login', //Страница авторизации
    'client/logout' => 'client/logout', //Страница выхода
    'client/([0-9]+)' => 'client/index/$1', //Главная страница клиента
    'client' => 'client/index', //Список клиентов
    //Отчёты
    'report/edit' => 'report/edit', //Редактировать
    'report' => 'report/index', //Главная страница отчётов
    //История
    'history/add' => 'history/add', //Добавить
    'history/edit/([a-z]+[0-9]+)' => 'history/edit/$1', //Редактировать
    'history/del/([a-z]+[0-9]+)' => 'history/del/$1', //Удалить
    'history' => 'history/index', //Главная страница истории
    //Отчёты
    'trash/undel/([0-9]+)' => 'trash/undel/$1/$2', //Восстановить заявку
    'trash/page-([0-9]+)' => 'trash/index/$1', //Главная страница корзины
    'trash' => 'trash/index', //Главная страница отчётов
//--------------Настройки-------------------------------------------------------
    //Настройки справочники
    'setting/catalog/([a-z]+[0-9]+)/add' => 'setting/catalog/add', //Добавить
    'setting/catalog/edit/([a-z]+[0-9]+)' => 'setting/catalog/edit/$1', //Редактировать
    'setting/catalog/del/([a-z]+[0-9]+)' => 'setting/catalog/del/$1', //Удалить
    'setting/catalog/category/([a-z]+[0-9]+)' => 'setting/catalog/category/$1', //Вывести по категория
    'setting/catalog' => 'setting/catalog/index', //Главная страница справчника
    //Настройки сотрудники
    'setting/master/([a-z]+[0-9]+)/add' => 'setting/master/add', //Добавить
    'setting/master/edit/([a-z]+[0-9]+)' => 'setting/master/edit/$1', //Редактировать
    'setting/master/del/([a-z]+[0-9]+)' => 'setting/master/del/$1', //Удалить
    'setting/master/category/([a-z]+[0-9]+)' => 'setting/master/category/$1', //Вывести по категория
    'setting/master' => 'setting/master/index', //Главная страница справчника
    //Настройки
    'setting/edit' => 'setting/edit', //Редактировать
    'setting' => 'setting/index', //Главная страница настроек
    //Обратный звонок
    'callback/add' => 'callback/add', //Добавить новый звонок
    'callback/edit/([0-9]+)' => 'callback/edit/$1', //Редактировать звонок
    'callback/del/([0-9]+)' => 'callback/del/$1', //Удалить звонок
    'callback/category/([0-9]+)' => 'callback/category/$1', //Вывести по категориям
    'callback/status/([0-9]+)' => 'callback/status/$1', //Вывести по статусу
    'callback' => 'callback/index', //Главная страница звонков
    //Заказы
    'purchase/add' => 'purchase/add', //Добавить
    'purchase/edit/([a-z]+[0-9]+)' => 'purchase/edit/$1', //Редактировать
    'purchase/del/([a-z]+[0-9]+)' => 'purchase/del/$1', //Удалить
    'purchase' => 'purchase/index', //Главная страница истории
    //Пользователь
    'user/edit/([0-9]+)' => 'user/edit/$1', //Редактировать
    'user/login' => 'user/login', //Страница авторизации
    'user/reg' => 'user/reg', //Страница регистрации
    'user/logout' => 'user/logout', //Страница выхода
    'user/([0-9]+)' => 'user/index/$1', //Главная страница пользователи
    //Главна страница сайта
    '[a-z]+[0-9]+' => 'site/index/$1', //Страница с ошибкой будет тут 404
    '' => 'site/index/$1', //Главная страница Лединг
);
