<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class ComplaintsController extends Zend_Controller_Action
{

    protected $isSupervisor = false;
    protected $canEnter = false;
    protected $username;

    public function init()
    {
        session_start();
        $this->_aM = new StaffAccountMapper();
        $this->canEnter = $this->_aM->LoggedIn();
        if($this->canEnter) {
            $this->username = $_SESSION['login_user'];
            if ($_SESSION['user_type'] == 'Supervisor') {
                $this->isSupervisor = true;
            }
        } else {
            $this->_aM = new TenantAccountMapper();
            $this->username = $_SESSION['login_user'];
            $this->canEnter = $this->_aM->LoggedIn();
        }
    }

    public function indexAction()
    {
        if (!$this->isSupervisor) {
            header("location: " . $this->view->baseURL() . "/index");
            exit();
        }
        $complaints = new Application_Model_DbTable_ComplaintsView();
        $this->view->complaints = $complaints->fetchAll();
    }

    public function updateAction()
    {
        if (!$this->canEnter) {
            header("location: " . $this->view->baseURL() . "/index");
            exit();
        }
    }


}
