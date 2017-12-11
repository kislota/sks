<?php

class CallbackController extends Controller{

    public $header = 'Звонки';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/callback/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex() {

        $user = User::getUserCheckAccess();
        require_once(ROOT . '/views/callback/index.php');

        return true;
    }

}
