<?php

class Part {

//Вывод устройства
    public static function getPartById($id) {
        $table = 'parts';
        $where = 'id = ' . $id;

        $result = Db::getSelect($table, $where);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

//Вывод всех устройств
    public static function getPartList($param = 0) {
        $table = 'parts';
        switch ($param) {
            case 1:
                $where = '';
                break;
            case 2:
                $where = 'count = 0';
                break;
            default:
                $where = 'count > 0';
                break;
        }
        $result = Db::getSelect($table, $where);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

    /**
     * Изменение цвета ячейки
     * @param int $count <p>Колличество товара на складе</p>
     * @return int $class <p>Стиль оформления</p>
     */
    public static function getPartStatusStyle($count) {
        if ($count > 0) {
            $class = Settings::getStatusClassTable(6);
        } else {
            $class = Settings::getStatusClassTable(5);
        }
//Расцветка таблицы
        return $class;
    }

//Добавить новое устройство
    public static function getPartAdd($code, $parts_name, $purchase, $price, $count, $id_category, $id_brand, $service, $id_users, $id_users_changed) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO parts (code, parts_name, purchase, price, count, id_category, id_brand, service, id_users, id_users_changed) '
                . 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $code);
        $result->bindParam(2, $parts_name);
        $result->bindParam(3, $purchase);
        $result->bindParam(4, $price);
        $result->bindParam(5, $count);
        $result->bindParam(6, $id_category);
        $result->bindParam(7, $id_brand);
        $result->bindParam(8, $service);
        $result->bindParam(9, $id_users);
        $result->bindParam(10, $id_users_changed);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }

//Редактировать
    public static function getPartEdit() {
        
    }

//Удалить
    public static function getPartDel() {
        
    }

    //------------------------------------------------------------------------------
//-----------------------------Оплатить заявку----------------------------------
//------------------------------------------------------------------------------
    public static function getPartPayID($id) {
        // Соединение с БД
        $db = Db::getConnection();
        //Проверяем пришло ли ID и содержит ли оно цифры
        $id = intval($id);
        //Меняем NULL на 1 что бы дать знать что оплатили, но надо будет потом 
        //записывать ID значения в кассе при оплате что бы подтягивалось всё

        if ($id) {
            //id записи в кассе
            $insertPay = Kassa::getPayAdd($id, 'parts');
            //Запрос в БД
            $sql = "UPDATE parts SET id_pay = ? WHERE id = " . $insertPay;
            //Подготовленный запрос
            $partPay = $db->prepare($sql);
            //Задаём значение псевдопеременной
            $partPay->bindParam(1, $insertPay);
            //Выполняем запрос
            $partPay->execute();
            return true;
        }
    }

}
