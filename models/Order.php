<?php

class Order {

    /**
     * Колличество записей на страницу
     */
    const SHOW_BY_DEFAULT = 5;

    /**
     * Подготовка к выводу в шаблон и добавление всего в асоциативный массив
     * @param array() $result <p>Результат выборки из базы по запросам</p>
     * @return array() $orderList <p>Асоциативный массив заявок</p>
     */
    public static function getOrderForeach($result) {
        $i = 0;
        $orderList = array();
        foreach ($result as $key) {
            $orderList[$i] = $key;
            $clientId = Client::getClientById($orderList[$i]['id_client']);
            if ($clientId) {
                $orderList[$i]['firstname'] = $clientId[0]['firstname'];
                $orderList[$i]['lastname'] = $clientId[0]['lastname'];
                $orderList[$i]['phone'] = $clientId[0]['phone'];
                if ($clientId[0]['id_address'] != 0) {
                    $orderList[$i]['address'] = $clientId[0]['address'];
                } else {
                    $orderList[$i]['address'] = '';
                }
            } else {
                $orderList[$i]['firstname'] = '';
                $orderList[$i]['lastname'] = '';
                $orderList[$i]['phone'] = '';
            }
            $managerId = User::getUserById($orderList[$i]['id_manager']);
            if ($managerId) {
                $orderList[$i]['manager_firstname'] = $managerId['first_name'];
                $orderList[$i]['manager_lastname'] = $managerId['last_name'];
            } else {
                $orderList[$i]['manager_firstname'] = '';
                $orderList[$i]['manager_lastname'] = '';
            }
            $masterId = User::getUserById($orderList[$i]['id_master']);
            if ($masterId) {
                $orderList[$i]['master_firstname'] = $masterId['first_name'];
                $orderList[$i]['master_lastname'] = $masterId['last_name'];
            } else {
                $orderList[$i]['master_firstname'] = '';
                $orderList[$i]['master_lastname'] = '';
            }
            $deviceId = Device::getDeviceById($orderList[$i]['id_device']);
            if ($deviceId) {
                $orderList[$i]['device_name'] = $deviceId[0]['device_name'];
            } else {
                $orderList[$i]['device_name'] = '';
            }
            $brandId = Brand::getBrandById($orderList[$i]['id_brand']);
            if ($brandId) {
                $orderList[$i]['brand_name'] = $brandId[0]['brand_name'];
            } else {
                $orderList[$i]['brand_name'] = '';
            }
            $i++;
        }

        return $orderList;
    }

    /**
     * Вывод отдельной записи
     * @param int $id <p>Идентификатор записи</p>
     * @return array() $orderList <p>Возвращаем массив с данными для вывода заявки</p>
     */
    public static function getOrderById($id) {
        $table = 'orders';
        $where = 'id_orders = ' . $id;

        $result = Db::getSelect($table, $where);
        $orderList = array();
        foreach ($result as $key) {
            $orderList = $key;

            $clientId = Client::getClientById($orderList['id_client']);
            if ($clientId) {
                $orderList['firstname'] = $clientId[0]['firstname'];
                $orderList['lastname'] = $clientId[0]['lastname'];
                $orderList['phone'] = $clientId[0]['phone'];
                if ($clientId[0]['id_address'] != 0) {
                    $orderList['address'] = $clientId[0]['address'];
                } else {
                    $orderList['address'] = '';
                }
            } else {
                $orderList['firstname'] = '';
                $orderList['lastname'] = '';
                $orderList['phone'] = '';
            }
            $deviceId = Device::getDeviceById($orderList['id_device']);
            if ($deviceId) {
                $orderList['device_name'] = $deviceId[0]['device_name'];
            } else {
                $orderList['device_name'] = '';
            }
            $brandId = Brand::getBrandById($orderList['id_brand']);
            if ($brandId) {
                $orderList['brand_name'] = $brandId[0]['brand_name'];
            } else {
                $orderList['brand_name'] = '';
            }
        }
        //Возвращаем массив с данными для вывода заявки
        return $orderList;
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
        $result = Db::getSelect($table, $where);
        $orderList = self::getOrderForeach($result);

        //Возвращаем массив с данными для вывода заявки
        return $orderList;
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

        $result = Db::getSelect($table, $where);
        $orderList = self::getOrderForeach($result);

        //Возвращаем массив с данными для вывода заявки
        return $orderList;
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
        $id_manager = $user['id'];
        $id_status = 1;
        $table = 'orders';
        $colums = "id_client, id_device, id_brand, "
                . "defect, complit, id_status, id_manager, id_master, model, sn, "
                . "id_media, id_help, ticket";
        $value = "'" . $param->id_client . "', '" . $param->id_device . "', '" . $param->id_brand . "', '"
                . $param->defect . "', '" . $param->complit . "', '" . $id_status . "', '" . $id_manager . "', '" . $param->id_master . "', '"
                . $param->model . "', '" . $param->sn . "', '"
                . $param->id_media . "', '" . $param->id_help . "', '" . $ticket . "'";

        $insertId = Db::getInsert($table, $colums, $value);
        return $insertId;
    }

//------------------------------------------------------------------------------
//-----------------------------Редактировать заявку-----------------------------
//------------------------------------------------------------------------------
    public static function getOrderEditId($param) {
        $param = json_decode($param);
        $table = 'orders';
        $colums = "id_client, id_device, id_brand, "
                . "defect, complit, id_status, id_master, model, sn, "
                . "id_media, id_help";
        $value = "id_client = '$param->id_client', id_device = '$param->id_device', "
                . "id_brand = '$param->id_brand', defect = '$param->defect', "
                . "complit = '$param->complit', id_status = '$param->id_status', "
                . "id_master = '$param->id_master', "
                . "model = '$param->model', sn = '$param->sn', id_media = '$param->id_media', "
                . "id_help = '$param->id_help' WHERE id = '$param->id'";

        $updateOrder = Db::getUpdate($table, $value);

        return $param->id;
    }

//------------------------------------------------------------------------------
//-----------------------------Поиск по клиенту---------------------------------
//------------------------------------------------------------------------------
    public static function getOrderSearch($search) {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM clients '
                . 'WHERE firstname LIKE ? '
                . 'ORDER BY id DESC';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        //Выполняем запрос
        $result->execute(array("%$search%"));
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Массив для клиентов
        $clientList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $clientList[$i]['id'] = $row['id'];
            $clientList[$i]['firstname'] = $row['firstname'];
            $clientList[$i]['lastname'] = $row['lastname'];
            $clientList[$i]['phone'] = $row['phone'];
            echo "<li>" . $clientList[$i]['firstname'] . " " . $clientList[$i]['lastname'] . " " . $clientList[$i]['phone'] . "</li>";
            $i++;
        }
        //Возврящаем массив с клиентами
        return $clientList;
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
            $sql = "UPDATE orders SET id_pay = ? WHERE id = " . $insertPay;
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
