<?php

/**
 * Класс Router
 * Компонент для работы с маршрутами
 */
class Router {

    /**
     * Возвращает строку запроса
     */
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Метод для обработки запроса
     */
    public function run() {
        // Получаем строку запроса
        $uri = $this->getURI();
        // Определить контроллер, action, параметры
        $segments = explode('/', $uri);
        //Сохраняем массив для проверки на методы если контроллер будет не указан
        $tmpUri = $segments;
        //Получаем имя контроллера
        $controllerName = array_shift($segments) . 'Controller';
        //Делаем его с заглавной буквы
        $controllerName = ucfirst($controllerName);
        // Подключить файл класса-контроллера
        $controllerFile = ROOT . '/controllers/' .
                $controllerName . '.php';
        //Проверяем есть ли такой контроллер если нет то вызываем контроллер по умолчанию
        if (file_exists($controllerFile)) {
            include_once($controllerFile);
        } else {
            //Указываем контроллер по умолчанию
            $controllerName = 'SiteController';
            //Записываем назад массив для проверки на методы
            $segments = $tmpUri;
        }
        // Создать объект, вызвать метод (т.е. action)
        $controllerObject = new $controllerName;
        //Запишем параметры если окажеться что такого метода нет
        $tmpUri = $segments;
        //Получаем имя метода
        $actionName = 'action' . ucfirst(array_shift($segments));
        //Если такого метода нет вызываем метод по умолчанию и принимаем то что 
        //было указано в качестве метода это были параметры
        if (method_exists($controllerObject, $actionName)) {
            //Получаем новые параметры так как такой метод есть
            $parameters = $segments;
            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        } else {
            $actionName = 'actionIndex';
            //Обнуляем параметры для метода индекс если был введён неверный метод
            //Возвращаем старые параметры так как такого метода нет
            $parameters = $tmpUri;
            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        }
    }

}
