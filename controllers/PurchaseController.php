<?php

class PurchaseController extends Controller{

    public $header = 'Закупка';
    public $top_menu = 'purchase';

    public function actionIndex() {
        $user = User::getUserCheckAccess();

        require_once(ROOT . '/views/purchase/index.php');
        return true;
    }

}
