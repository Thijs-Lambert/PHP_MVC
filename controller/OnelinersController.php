<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/OnelinerDAO.php';
require_once __DIR__ . '/../dao/ComebackDAO.php';

class OnelinersController extends Controller {

  public function index() {
    $onelinerDAO = new OnelinerDAO();

    if (!empty($_POST)) {
      if (!empty($_SESSION['user'])) {
        $this->_handleOnlinerPost();
      } else {
        $_SESSION['error'] = 'Je moet ingelogd zijn om dit te kunnen doen!';
      }
    }

    if (!empty($_GET['action'])) {
      if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        if (!empty($_SESSION['user'])) {
          $this->handleDeleteOneliner();
        } else {
          $_SESSION['error'] = 'Je moet ingelogd zijn om dit te kunnen doen!';
        }
      }
    }

    $oneliners = $onelinerDAO->selectAll();
    $this->set('oneliners', $oneliners);
  }

  private function _handleOnlinerPost() {
    $onelinerDAO = new OnelinerDAO();
    $data = array_merge($_POST, array('user_id' => $_SESSION['user']['id'], 'created' => date('Y-m-d H:i:s')));
    if($insertedOneliner = $onelinerDAO->insert($data)) {
      $_SESSION['info'] = 'Thank you for the oneliner';
      header('Location: index.php?page=detail&id=' . $insertedOneliner['id']);
      exit();
    } else {
      $_SESSION['error'] = 'Could not post the oneliner';
      $this->set('errors', $onelinerDAO->validate($data));
    }
  }

  private function handleDeleteOneliner() {
    $onelinerDAO = new OnelinerDAO();
    $onelinerDAO->delete($_GET['id']);
    $_SESSION['info'] = 'De oneliner werd verwijderd!';
    header('Location: index.php');
    exit();
  }

}
