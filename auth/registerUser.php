<?php
session_start();
include '../config/db_config.php';

class UserRegistration {
    private $link;
    private $login;
    private $email;
    private $pass;
    private $sucpass;

    public function __construct($link) {
        $this->link = $link;
    }

    public function setData($login, $email, $pass, $sucpass) {
        $this->login = $login;
        $this->email = $email;
        $this->pass = $pass;
        $this->sucpass = $sucpass;
    }

    private function validate() {
        if (empty($this->login) || empty($this->email) || empty($this->pass) || empty($this->sucpass)) {
            throw new Exception("Необходимо заполнить все поля!");
        }

        if ($this->pass !== $this->sucpass) {
            throw new Exception("Введенные вами пароли не совпадают!");
        }
    }

    private function checkUserExists() {
        $stmt = $this->link->prepare("SELECT COUNT(*) AS user_count FROM users WHERE login = ? OR email = ?");
        $stmt->bind_param('ss', $this->login, $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['user_count'] > 0;
    }

    public function register() {
        try {
            $this->validate();

            if ($this->checkUserExists()) {
                throw new Exception("Пользователь с таким логином или почтой уже существует!");
            }

            $stmt = $this->link->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $this->login, $this->email, $this->pass);

            if ($stmt->execute()) {
                $_SESSION['auth'] = true;
                $_SESSION['login'] = $this->login;
                $stmt->close();
                $this->link->close();
                header('Location: ../public/profile.php');
                exit;
            } else {
                throw new Exception("Произошла ошибка при регистрации");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $sucpass = $_POST['sucpass'] ?? '';

    $userRegistration = new UserRegistration($link);
    $userRegistration->setData($login, $email, $pass, $sucpass);
    $userRegistration->register();
}
?>
