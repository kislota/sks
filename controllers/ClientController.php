<?php

class ClientController extends Controller {

    public $header = 'Клиенты';

    public function header_menu_top() {
        $header_menu = ROOT . '/views/client/menu_top.php';
        echo file_get_contents($header_menu);
        return true;
    }

    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $clientList = Client::getClientList($page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = Db::getSelectCount('clients');
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
        require_once(ROOT . '/views/client/index.php');
        return true;
    }

    public function actionAdd() {
        
    }

    public function actionEdit() {
        
    }

    public function actionDel() {
        
    }

}
