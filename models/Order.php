<?php

class Order {

    /**
     * Колличество записей на страницу
     */
    const SHOW_BY_DEFAULT = 5;

    /**
     * Вывод отдельной записи
     * @param int $id <p>Идентификатор записи</p>
     * @return array() $orderList <p>Возвращаем массив с данными для вывода заявки</p>
     */
    public static function getOrderById($id) {
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM orders '
                . 'WHERE id_orders = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Выполнение коменды
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        //Возвращаем массив с данными для вывода заявки
        return $result->fetch();
    }

    /**
     * Постраничный вывод заявок
     * @param int $page = 1 <p>Номер страницы</p>
     * @param int $trash = 0 <p>Удалена ли заявка 0 не удалена, 1 удалена</p>
     * @return array() $orderList <p>Асоциативный массив заявок готовый к выводу</p>
     */
    public static function getOrderList($page = 1, $trash = 0) {
        $count = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $table = 'orders';
        $where = 'trash = ' . $trash . ' ORDER BY data DESC LIMIT ' . $count . ' OFFSET ' . $offset;
        //Возвращаем массив с данными для вывода заявки
        return Db::getSelect($table, $where);
    }

    /**
     * Запрос для вывода по фильтрам
     * @param int $page = 1 <p>Номер страницы</p>
     * @param string $where <p>Условие для отбора WHERE " ... "</p>
     * @return int $count <p>Колличество найденых эллементов</p>
     */
    public static function getOrderListFilter($page = 1, $where) {
        $count = self::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $table = 'orders';
        $where = $where . ' ORDER BY data DESC LIMIT ' . $count . ' OFFSET ' . $offset;
        //Возвращаем массив с данными для вывода заявки
        return Db::getSelect($table, $where);
    }

    /**
     * Добавление новой заявки
     * @param int $param <p>Параметры</p>
     * @return int $insertId <p>Идентификатор новой заявки</p>
     */
    public static function getOrderAdd($param) {
        $param = json_decode($param);
        $ticket = time();
        $user = User::getUserCheckAccess();
        $id_manager = $user['id_user'];
        $id_status = 1;
        $id_help = 0;
        $table = 'orders';
        $colums = "id_client, id_device, id_brand, "
                . "defect, complit, id_status, id_manager, id_master, model, sn, "
                . "id_media, id_help, ticket";
        $value = "'" . $param->id_client . "', '" . $param->id_device . "', '" . $param->id_brand . "', '"
                . $param->defect . "', '" . $param->complit . "', '" . $id_status . "', '" . $id_manager . "', '" . $param->id_master . "', '"
                . $param->model . "', '" . $param->sn . "', '"
                . $param->id_media . "', '" . $id_help . "', '" . $ticket . "'";

        $insertId = Db::getInsert($table, $colums, $value);
        return $insertId;
    }

//------------------------------------------------------------------------------
//-----------------------------Редактировать заявку-----------------------------
//------------------------------------------------------------------------------
    public static function getOrderEditId($param) {
        $param = json_decode($param);
        $id_help = 0;
        $table = 'orders';
        $colums = "id_client, id_device, id_brand, "
                . "defect, complit, id_status, id_master, model, sn, "
                . "id_media, id_help";
        $value = "id_client = '$param->id_client', id_device = '$param->id_device', "
                . "id_brand = '$param->id_brand', defect = '$param->defect', "
                . "complit = '$param->complit', id_status = '$param->id_status', "
                . "id_master = '$param->id_master', "
                . "model = '$param->model', sn = '$param->sn', id_media = '$param->id_media', "
                . "id_help = '$id_help' WHERE id_orders = '$param->id_orders'";

        $updateOrder = Db::getUpdate($table, $value);

        return $param->id_orders;
    }

//------------------------------------------------------------------------------
//-----------------------------Оплатить заявку----------------------------------
//------------------------------------------------------------------------------
    public static function getOrderPayID($id) {
// Соединение с БД
        $db = Db::getConnection();
//Проверяем пришло ли ID и содержит ли оно цифры
        $id = intval($id);
//Меняем NULL на 1 что бы дать знать что оплатили, но надо будет потом 
//записывать ID значения в кассе при оплате что бы подтягивалось всё

        if ($id) {
//id записи в кассе
            $insertPay = Kassa::getPayAdd($id, 'orders');
//Запрос в БД
            $sql = "UPDATE orders SET id_pay = ? WHERE id_orders = " . $id;
//Подготовленный запрос
            $orderPay = $db->prepare($sql);
//Задаём значение псевдопеременной
            $orderPay->bindParam(1, $insertPay);
//Выполняем запрос
            $orderPay->execute();
            return true;
        }
    }

}
