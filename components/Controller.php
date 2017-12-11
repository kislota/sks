<?php

class Controller extends Settings {

    /**
     * Колличество записей на страницу
     */
    public $count = 5;
    public $show_def = 5;
    public $header = 'Система учета';


    public function getPage($page) {
        $preg = '/[a-z]+.[-]/';
        $page = preg_replace($preg, '', $page);
        return $page;
    }

}
