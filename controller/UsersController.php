<?php

require_once __DIR__ . '/Controller.php';

require_once __DIR__ . '/../dao/UserDAO.php';

class UsersController extends Controller {

  private $userDAO;

  function __construct() {
    $this->userDAO = new UserDAO();
  }

  public function index() {
  }

  public function register() {
    if (!empty($_POST)) {
      $errors = array();
      if (empty($_POST['email'])) {
        $errors['email'] = 'Please enter your email';
      } else {
        $existing = $this->userDAO->selectByEmail($_POST['email']);
        if (!empty($existing)) {
          $errors['email'] = 'Email address is already in use';
        }
      }
      if (empty($_POST['password'])) {
        $errors['password'] = 'Please enter a password';
      }
      if ($_POST['confirm_password'] != $_POST['password']) {
        $errors['confirm_password'] = 'Passwords do not match';
      }
      if (empty($errors)) {
        $inserteduser = $this->userDAO->insert(array(
          'email' => $_POST['email'],
          'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ));
        if (!empty($inserteduser)) {
          $_SESSION['info'] = 'Registration Successful!';
          header('Location: index.php');
          exit();
        }
      }
      $_SESSION['error'] = 'Registration Failed!';
      $this->set('errors', $errors);
    }
  }

  public function login() {
    if (!empty($_POST)) {
      if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $existing = $this->userDAO->selectByEmail($_POST['email']);
        if (!empty($existing)) {
          if (password_verify($_POST['password'], $existing['password'])) {
            $_SESSION['user'] = $existing;
            $_SESSION['info'] = 'Logged In';
          } else {
            $_SESSION['error'] = 'Unknown username / password';
          }
        } else {
          $_SESSION['error'] = 'Unknown username / password';
        }
      } else {
        $_SESSION['error'] = 'Unknown username / password';
      }
    }
    header('Location: index.php');
    exit();
  }

  public function logout() {
    if (!empty($_SESSION['user'])) {
      unset($_SESSION['user']);
    }
    $_SESSION['info'] = 'Logged Out';
    header('Location: index.php');
    exit();
  }

}
