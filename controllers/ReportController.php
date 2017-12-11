<?php

class ReportController extends Controller{

    public $header = 'Отчёты';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/report/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/report/index.php');
        return true;
    }

}
