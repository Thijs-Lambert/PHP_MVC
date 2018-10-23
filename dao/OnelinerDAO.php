<?php
require_once( __DIR__ . '/DAO.php');

require_once( __DIR__ . '/ComebackDAO.php');

class OnelinerDAO extends DAO {

  public function selectAll() {
    $sql = "SELECT * FROM `oneliners`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectById($id) {
    $sql = "SELECT * FROM `oneliners` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($data) {
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "INSERT INTO `oneliners` (`created`, `author`, `text`) VALUES (:created, :user_id, :text)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':created', $data['created']);
      $stmt->bindValue(':user_id', $data['user_id']);
      $stmt->bindValue(':text', $data['text']);
      if ($stmt->execute()) {
        $insertedId = $this->pdo->lastInsertId();
        return $this->selectById($insertedId);
      }
    }
    return false;
  }

  public function update($id, $data) {
    $errors = $this->validate($data);
    if (empty($errors)) {
      $sql = "UPDATE `oneliners` SET `created` = :created, `user_id` = :user_id, `text` = :text WHERE `id` = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':created', $data['created']);
      $stmt->bindValue(':user_id', $data['user_id']);
      $stmt->bindValue(':text', $data['text']);
      $stmt->bindValue(':id', $id);
      if ($stmt->execute()) {
        return $this->selectById($id);
      }
    }
    return false;
  }

  public function delete($id) {
    // delete the comebacks on this oneliner first
    $comebackDAO = new ComebackDAO();
    $comebackDAO->deleteFromOnelinerId($id);
    // delete the onliner itself afterwards
    $sql = "DELETE FROM `oneliners` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    return $stmt->execute();
  }

  public function validate($data) {
    $errors = array();
    if (empty($data['created'])) {
      $errors['created'] = 'Please enter a created date';
    }
    if (empty($data['user_id'])) {
      $errors['user_id'] = 'Please enter a user_id';
    }
    if (empty($data['text'])) {
      $errors['text'] = 'Please enter a text';
    }
    return $errors;
  }
}
