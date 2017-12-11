<?php

class SettingController extends Controller{

    public $header = 'Настройки';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/setting/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/setting/index.php');
        return true;
    }

}
