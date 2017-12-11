<?php

class PartController extends Controller{

    public $header = 'Склад';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/part/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывести то что есть на складе--------------------
//------------------------------------------------------------------------------
    public function actionIndex() {
        $user = User::getUserCheckAccess();

        $partList = Part::getPartList();
        require_once(ROOT . '/views/part/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывести всё то что есть на складе----------------
//------------------------------------------------------------------------------
    public function actionAll() {
        $user = User::getUserCheckAccess();

        $partList = Part::getPartList(1);
        require_once(ROOT . '/views/part/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывести что закончилось на складе----------------
//------------------------------------------------------------------------------
    public function actionEnded() {
        $user = User::getUserCheckAccess();

        $partList = Part::getPartList(2);
        require_once(ROOT . '/views/part/index.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывести что закончилось на складе----------------
//------------------------------------------------------------------------------
    public function actionEdit($id) {
        $user = User::getUserCheckAccess();
        if ($id) {
            $partId = Part::getPartEdit($id);
        }
        require_once(ROOT . '/views/part/edit.php');
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Вывести что закончилось на складе----------------
//------------------------------------------------------------------------------
    public function actionDel($id) {
        $user = User::getUserCheckAccess();
        if ($id) {
            $partId = Part::getPartDel($id);
            // Возвращаем пользователя на страницу с которой он пришел
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }
        return true;
    }

//------------------------------------------------------------------------------
//-----------------------------Оплатить заявку----------------------------------
//------------------------------------------------------------------------------
    public function actionPay($id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        if ($id) {
            $PartPay = Part::getPartPayID($id);
            // Возвращаем пользователя на страницу с которой он пришел
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

//-----------------------------Конец--------------------------------------------
        return true;
    }

}
