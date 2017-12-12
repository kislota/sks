<?php

class HistoryController extends Controller{
    public $header = 'История';
    public $top_menu = 'history';
    
    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $historyList = History::getHistoryList($page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = Db::getSelectCount('history');
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/history/index.php');
        return true;
    }

}
