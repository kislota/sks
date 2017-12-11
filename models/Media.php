<?php

class Media {

    // Вывод откуда о нас узнали
    public static function getMediaById($id) {
        $table = 'media';
        $where = 'id = ' . $id;

        $result = Db::getSelect($table, $where);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }
    
//Вывод всего списка рекламы
    public static function getMediaList() {
        $table = 'media';

        $result = Db::getSelect($table);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }
//Добавить новое место информации
    public static function getMediaAdd($media_name) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO media (media_name) '
                . 'VALUES (?)';

        $result = $db->prepare($sql);
        $result->bindParam(1, $media_name);
        $result->execute();

        //id последней добавленной записи
        $insertId = $db->lastInsertId();
        return $insertId;
    }
//Редактировать
    public static function getMediaEdit() {
        
    }
//Удалить
    public static function getMediaDel() {
        
    }



}
