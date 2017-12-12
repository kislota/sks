<?php

/**
 * Класс User - модель для работы с пользователями
 */
class User {

    public $hesh = 'kompservis';

    /**
     * Регистрация пользователя 
     * @param string $user_name <p>Login</p>
     * @param string $password <p>Пароль</p>
     * @param string $first_name <p>Имя</p>
     * @param string $last_name <p>Фамилия</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserRegister($param) {
        $paramUser = json_decode($param);
        $firstname = '';
        $lastname = '';
        // Соединение с БД
        $db = Db::getConnection();

//        $password = md5($password);
        // Текст запроса к БД
        $sql = 'INSERT INTO users (username, password, firstname, lastname) '
                . 'VALUES (:username, :password, :firstname, :lastname)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':username', $paramUser->username, PDO::PARAM_STR);
        $result->bindParam(':password', md5($paramUser->password), PDO::PARAM_STR);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->execute();
        //id последней добавленной записи
        $insertRegId = $db->lastInsertId();
        //Возвращаем id добавленной записи
        return $insertRegId;
    }

    /**
     * Редактирование данных пользователя
     * @param integer $id <p>id пользователя</p>
     * @param string $user_name <p>Login</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserEdit($param) {
        $paramUser = json_decode($param);
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE users 
            SET username = :username, password = :password, firstname = :firstname, lastname = :lastname 
            WHERE id_user = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $paramUser->id, PDO::PARAM_INT);
        $result->bindParam(':username', $paramUser->username, PDO::PARAM_STR);
        $result->bindParam(':password', md5($paramUser->password), PDO::PARAM_STR);
        $result->bindParam(':firstname', $paramUser->firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $paramUser->lastname, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $user_name <p>Login</p>
     * @param string $password <p>Пароль</p>
     * @return mixed : integer user id or false
     */
    public static function getUserCheckData($param) {
        // Соединение с БД
        $db = Db::getConnection();
        $paramUser = json_decode($param);
        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':username', $paramUser->username, PDO::PARAM_INT);
        $result->bindParam(':password', md5($paramUser->password), PDO::PARAM_INT);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id_user'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     * @param integer $userId <p>id пользователя</p>
     */
    public static function getUserAuth($userId) {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $user_name <p>Login</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserCheckName($username) {

        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE username = :username;';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_INT);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone <p>Телефон</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserCheckPhone($phone) {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserCheckPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserCheckEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param type $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function getUserCheckEmailExists($email) {
        // Соединение с БД        
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserById($id) {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE id_user = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserList() {
        $table = 'users';

        $result = Db::getSelect($table);
        //Возвращаем массив с данными для вывода заявки
        return $result;
    }

    /**
     * Метод, который проверяет пользователя на то, является ли он администратором
     * @return boolean
     */
    public static function getUserCheckAccess() {
        if (isset($_SESSION['user'])) {
            // Получаем информацию о текущем пользователе
            $user = self::getUserById($_SESSION['user']);
            return $user;
        }

        header("Location: /user/login");


        // Если роль текущего пользователя "admin", пускаем его в админпанель
        /* if ($user['is_super_admin'] == '1') {
          return $user;
          } */

        // Иначе завершаем работу с сообщением об закрытом доступе
        //die('Access denied');
    }

}
