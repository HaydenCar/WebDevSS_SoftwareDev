<?php
require_once 'connection.php';

class User {
    private $db;
    private $id;
    private $username;
    private $password;
    private $mobileNumber;

    public function __construct($db, $username = '', $password = '', $mobileNumber = '', $id = null) {
        $this->db = $db instanceof PDO ? $db : (new Database())->connect();
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->mobileNumber = $mobileNumber;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getMobileNumber() {
        return $this->mobileNumber;
    }

    public function setMobileNumber($mobileNumber) {
        $this->mobileNumber = $mobileNumber;
    }

    public function checkLogin($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = :userId LIMIT 1");
        $stmt->execute(['userId' => $userId]);
        return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    }

    public function createUser() {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (user_name, password, mobile_number) VALUES (:userName, :password, :mobileNumber)");
        return $stmt->execute([
            'userName' => $this->username,
            'password' => $passwordHash,
            'mobileNumber' => $this->mobileNumber
        ]);
    }

    public function loginUser() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = :userName LIMIT 1");
        $stmt->execute(['userName' => $this->username]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $user['password'])) {
                return $user['user_id'];
            }
        }
        return false;
    }

    public function save() {
        if ($this->id) {
            $stmt = $this->db->prepare("UPDATE users SET user_name = :userName, password = :password, mobile_number = :mobileNumber WHERE user_id = :userId");
            return $stmt->execute([
                'userName' => $this->username,
                'password' => password_hash($this->password, PASSWORD_DEFAULT),
                'mobileNumber' => $this->mobileNumber,
                'userId' => $this->id
            ]);
        } else {
            return $this->createUser();
        }
    }
}
?>
