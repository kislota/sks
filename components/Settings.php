<?php

/**
 * Класс Settings
 * Компонент настроек
 */
class Settings{

    public static function getSettings() {
        // Получаем параметры подключения из файла
        $configPath = ROOT . '/config/config.php';
        $config = include($configPath);
        date_default_timezone_set('Europe/Kiev'); //Временная зона

        return $config;
    }

    public static function getStatusClassTable($status = 0) {

        switch ($status) {
            case 1:
                $class = 'warning';
                break;
            case 2:
                $class = 'repit';
                break;
            case 3:
                $class = 'info';
                break;
            case 4:
                $class = 'suc';
                break;
            case 5:
                $class = 'danger';
                break;
            case 6:
                $class = 'success';
                break;
            default:
                $class = 'warning';
                break;
        }

        return $class;
    }


}
