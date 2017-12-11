<?php

class Work {
//Вывод устройства
    public static function getWorkById($id) {
        $table = 'work';
        $where = 'id = ' . $id;

        $result = Db::getSelect($table, $where);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

//Вывод всех устройств
    public static function getWorkList() {
        $table = 'work';

        $result = Db::getSelect($table);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }
//Добавить новое устройство
    public static function getWorkAdd($work_name, $price, $id_device) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO work (work_name, price, id_device) '
                . 'VALUES (?, ?, ?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $work_name);
        $result->bindParam(2, $price);
        $result->bindParam(3, $id_device);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }
//Редактировать
    public static function getWorkEdit() {
        
    }
//Удалить
    public static function getWorkDel() {
        
    }

}
