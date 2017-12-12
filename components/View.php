<?php

// Путь до папки с шаблонами

define('VIEWS_BASEDIR', dirname(__FILE__) . '/../views/' . __CLASS__);

class View {

    // получить отрендеренный шаблон с параметрами $params
    function fetchPartial($template, $params = array()) {
        extract($params);
        ob_start();
        echo VIEWS_BASEDIR . __CLASS__ . $template . '.php';
        echo '</br>';
        echo VIEWS_BASEDIR;
        die;
        include VIEWS_BASEDIR . $template . '.php';
        return ob_get_clean();
    }

    // получить отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params
    function fetch($template, $params = array()) {
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('layout', array('content' => $content));
    }

    // вывести отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params    
    function render($template, $params = array()) {
        
        echo $this->fetch($template, $params);
    }

}
