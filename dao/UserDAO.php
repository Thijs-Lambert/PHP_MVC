<?php
require_once __DIR__ . '/DAO.php';
class UserDAO extends DAO {

  public function selectById($id) {
    $sql = "SELECT * FROM `users` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function selectByEmail($email) {
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data) {
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':email', $data['email']);
      $stmt->bindValue(':password', $data['password']);
      if($stmt->execute()) {
        $insertedId = $this->pdo->lastInsertId();
        return $this->selectById($insertedId);
      }
    }
    return false;
  }

  public function validate($data) {
    $errors = array();
    if (empty($data['email'])) {
      $errors['email'] = 'please enter the email';
    }
    if (empty($data['password'])) {
      $errors['password'] = 'please enter the password';
    }
    return $errors;
  }
}
