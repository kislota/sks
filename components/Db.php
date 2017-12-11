<?php

/**
 * Класс Db
 * Компонент для работы с базой данных
 */
class Db {

    /**
     * Устанавливает соединение с базой данных
     * @return \PDO <p>Объект класса PDO для работы с БД</p>
     */
    public static function getConnection() {
        // Получаем параметры подключения из файла
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        // Задаем кодировку
        $db->exec("set names utf8");
        return $db;
    }

    /**
     * Шаблон SQL SELECT COUNT
     * @param string $table указываем имя таблицы
     * @param string $where параметры для обновления "colum = value"
     * @return $result <p>Возвращает колличество записей из БД</p>
     */
    public static function getSelectCount($table, $where = "") {
        // Соединение с БД
        $db = Db::getConnection();
        if (strlen($where) > 1)
            $sql = "SELECT * FROM $table WHERE $where";
        else
            $sql = "SELECT * FROM $table";
        $result = $db->prepare($sql);
        $result->execute();
        $result = $result->rowCount();
        return $result;
    }

    /**
     * Шаблон SQL SELECT
     * @param string $table указываем имя таблицы
     * @param string $where параметры для обновления "colum = value"
     * @return $list <p>Возвращает ассоциативный массив выбранных данных</p>
     */
    public static function getSelect($table, $where = "") {
        if ($where)
            $sql = "SELECT * FROM $table WHERE $where";
        else
            $sql = "SELECT * FROM $table";
        $result = self::getConnection()->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC); 
        $result->execute();
        
        $list = [];
        foreach ($result as $key => $value) {
            $list[$key] = $value;
        }
        return $list;
    }

    /**
     * Шаблон SQL DELETE
     * @param string $table указываем имя таблицы
     * @param string $where параметры для обновления "id = value"
     * @return true false <p>Возвращает удачное или нет удаление</p>
     */
    public static function getDelete($table, $where) {
        // Соединение с БД
        $db = Db::getConnection();

        if (strlen($where) > 1)
            $sql = "DELETE FROM $table WHERE $where";
        else
            return false;
        $result = $db->prepare($sql);
        $result->execute();
        return true;
    }

    /**
     * Шаблон SQL UPDATE
     * @param string $table указываем имя таблицы
     * @param string $where параметры для обновления "colum = value"
     * @return true false <p>Возвращает удачное или нет обновление</p>
     */
    public static function getUpdate($table, $where = "") {
        // Соединение с БД
        $db = Db::getConnection();

        $sql = "UPDATE $table SET ";


        if ($where) {
            $sql .= "$where";
            $result = $db->prepare($sql);
            $result->execute();
            return true;
        } else
            return false;
    }

    /*
     * Шаблон SQL INSERT
     * @param string $table указываем имя таблицы
     * @param string $colums в какие колонки необходимо вставка
     * @param string $value данные для вставки
     * @return $insertId <p>Возвращаем массив ID вставленной записи</p>
     */

    public static function getInsert($table, $colums, $value) {
        // Соединение с БД
        $db = Db::getConnection();
        $sql = "INSERT INTO $table ($colums) VALUES ($value)";
        $result = $db->prepare($sql);
        $result->execute();
        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        //Возвращаем id добавленной записи
        return $insertId;
    }

}
