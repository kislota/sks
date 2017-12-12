<?php

class KassaController extends Controller {

    public $header = 'Касса';
    public $top_menu = 'kassa';
    public $show_def = 15;

    /**
     * Вывод всех платежей
     */
    public function actionIndex($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $kassaList = Kassa::getKassaList($page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = Db::getSelectCount('kassa');
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Дабавить оплату в ручную
     */
    public function actionAdd($id, $type) {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        if (isset($_POST['submit']) == "save") {
            // Если форма отправлена
            // Получаем данные из формы
            $insertId = Kassa::getPayAdd($id, $type);

            header("Location: /kassa/edit/$insertId");
            return true;
        }
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/add.php');
        return true;
    }

    /**
     * Вывод платежей по заявкам
     */
    public function actionOrder($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "id_orders > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежи по складу
     */
    public function actionPart($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "id_parts > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по пользователям
     */
    public function actionUser($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "id_users > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по клиентам
     */
    public function actionClient($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "id_clients > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по продажам
     */
    public function actionSale($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "id_sales > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по доходам
     */
    public function actionComing($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "coming > 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Вывод платежей по расходам
     */
    public function actionCost($page = 1) {
        //Проверяем права пользователя
        $user = User::getUserCheckAccess();
        //Получаем номер страницы
        $page = $this->getPage($page);
        //Выбираем нужные записи из таблицы
        $where = "cost < 0";
        $kassaList = Kassa::getKassaListFilter($where, $page);
        // Общее количетсво заявок (необходимо для постраничной навигации)
        $count = count(Db::getSelect('kassa', $where));
        //Постраничная навигация
        $pagination = new Pagination($count, $page, $this->show_def, 'page-');
//-----------------------------Вывод шаблона------------------------------------
        require_once(ROOT . '/views/kassa/index.php');
        return true;
    }

    /**
     * Совершаем платёж
     * @var $type имя базы данных
     * @var $id номер записи в базе по которой произвдится оплата
     */
    public function actionPay($type, $id) {
        // Проверка доступа
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        //Добавляем оплату
        $insertPay = Kassa::getPayAdd($id, $type);
//------------------------------------------------------------------------------
        // Возвращаем пользователя на страницу с которой он пришел
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
//-----------------------------Конец--------------------------------------------
        return true;
    }

    /**
     * Удалить оплату
     * @var $id номер записи в базе кассы
     */
    public function actionDel($id) {
        $user = User::getUserCheckAccess();
//------------------------------------------------------------------------------
        if (intval($id)) {
            Kassa::getPayDel($id);
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
            return true;
        } else {
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
            return true;
        }
    }

}
