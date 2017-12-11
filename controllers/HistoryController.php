<?php

class HistoryController extends Controller{
    public $header = 'История';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/history/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }
    
    public function actionIndex() {
        $user = User::getUserCheckAccess();
        
        require_once(ROOT . '/views/history/index.php');
        return true;
    }

}
