<?php

class ReportController extends Controller{

    public $header = 'Отчёты';
    public $top_menu = 'report';

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/report/index.php');
        return true;
    }

}
