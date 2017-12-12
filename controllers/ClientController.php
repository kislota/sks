<?php

class ClientController extends Controller {

    public $header = 'Клиенты';
    public $top_menu = 'client';

    /**
     * Список клиентов
     * @param int $page <p>Текущаяя страница</p>
     */
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

    /**
     * Поиск клиентов AJAX
     */
    public function actionSearch() {
        // Проверка доступа
        $user = User::getUserCheckAccess();

//------------------------------------------------------------------------------
        $search = $_REQUEST['client'];
        $clientList = Client::getClientSearch($search);

//-----------------------------Конец--------------------------------------------
        die();
    }

}
