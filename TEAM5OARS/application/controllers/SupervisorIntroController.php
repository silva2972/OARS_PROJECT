<!--//Coded By: Luis Silva, Sai Vadlamani
//Date Created: 04/21/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class SupervisorIntroController extends Zend_Controller_Action
{
    protected $isSupervisor = false;
    protected $username;

    public function init()
    {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isManager = ($_SESSION['user_type'] == 'Supervisor');
            $this->username = $_SESSION['login_user'];
            $fname = $this->_aM->FirstName();
            $lname = $this->_aM->LastName();
            $this->view->LoggedInView = "Welcome Supervisor: " . $fname . " " . $lname;
        } else {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }

    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isManager) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
    }


}
