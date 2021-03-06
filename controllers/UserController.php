<?php

class UserController extends Controller{

    public $header = 'Пользователь';
    public $top_menu = 'user';

    public function actionIndex() {
        $user = User::getUserCheckAccess();
        require_once(ROOT . '/views/user/edit.php');
        return true;
    }

    public function actionEdit() {
        $user = User::getUserCheckAccess();
        require_once(ROOT . '/views/user/edit.php');
        return true;
    }

    public function actionLogin() {
        // Получаем идентификатор пользователя из сессии
        if (isset($_SESSION['user'])) {
            echo "<meta http-equiv='refresh' content='0; url= /order'>";
        } else {
            // Переменные для формы
            $username = false;
            $password = false;
            // Обработка формы
            if (isset($_POST['login'])) {
                // Если форма отправлена 
                // Получаем данные из формы
                $param = json_encode($_POST);
                // Флаг ошибок
                $errors = false;
                // Проверяем существует ли пользователь
                $userId = User::getUserCheckData($param);
                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    User::getUserAuth($userId);
                    // Перенаправляем пользователя в закрытую часть - кабинет 
                    header("Location: /order");
                    return true;
                }
            }
            // Подключаем вид
            require_once(ROOT . '/views/user/login.php');
            return true;
        }
    }

    public function actionReg() {
        // Получаем идентификатор пользователя из сессии
        if (isset($_SESSION['user'])) {
            echo "<meta http-equiv='refresh' content='0; url= /order'>";
        } else {
            // Переменные для формы
            $username = false;
            $password = false;
            $password2 = false;
            // Обработка формы
            if (isset($_POST['reg'])) {
                // Если форма отправлена 
                // Получаем данные из формы
                debug($_POST);
//                die;
                $param = json_encode($_POST);
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];

                // Флаг ошибок
                $errors = false;

                // Проверяем существует ли пользователь
                $userId = User::getUserCheckName($username);

                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Логин уже занят';
                } elseif ($password != $password2) {
                    $errors[] = 'Пароль не совпадает';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    $userId = User::getUserRegister($param);
                    User::getUserAuth($userId);
                    // Перенаправляем пользователя в закрытую часть - кабинет 
                    header("Location: /user/edit/$userId");
                    return true;
                }
            }

            // Подключаем вид
            require_once(ROOT . '/views/user/login.php');
            return true;
        }
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout() {
        // Стартуем сессию
        session_start();

        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);

        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}
