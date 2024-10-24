<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $db;
    private $user;

    protected function setUp(): void
    {
        $dbHost = 'localhost';
        $dbName = 'store';
        $dbUser = 'root';
        $dbPass = '';

        $this->db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($this->db->connect_error) {
            die("Ошибка подключения к базе данных: " . $this->db->connect_error);
        }

        $this->user = new User($this->db);
    }

    public function testUserRegistr()
    {
        $testUserLogin = 'test_user_' . uniqid(); 
        $testUserPassword = 'test_password';
        $testUserEmail = 'test@example.com';

        $result = $this->user->UserRegistr($testUserLogin, $testUserPassword, $testUserEmail);

        $this->assertTrue($result);

        // Проверка, что пользователь добавлен в базу данных
        $userFromDb = $this->user->getUserByLogin($testUserLogin);
        $this->assertIsArray($userFromDb);
        $this->assertEquals($testUserLogin, $userFromDb['login']);
        $this->assertEquals($testUserEmail, $userFromDb['email']);
    }

    public function testUserLogin()
    {
        $testUserLogin = 'test_user_login';
        $testUserPassword = 'test_password';
        $testUserEmail = 'test@example.com';

        // Предварительная регистрация пользователя для теста логина
        $this->user->UserRegistr($testUserLogin, $testUserPassword, $testUserEmail); 

        $result = $this->user->UserLogin($testUserLogin, $testUserEmail, $testUserPassword);
        $this->assertTrue($result);

        // Проверка неверного пароля
        $result = $this->user->UserLogin($testUserLogin, $testUserEmail, 'wrong_password');
        $this->assertFalse($result);
    }

    public function testGetUserByLogin()
    {
        $testUserLogin = 'existing_user'; // Предполагаем, что такой пользователь есть в БД
        $user = $this->user->getUserByLogin($testUserLogin);

        if ($user) { // Проверяем, что пользователь найден
            $this->assertIsArray($user);
            $this->assertEquals($testUserLogin, $user['login']); 
        } else {
            $this->assertNull($user, "Пользователь '$testUserLogin' не найден в БД. Проверьте тестовые данные.");
        }
    }

}
