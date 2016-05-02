<!--//Coded By: Nixon Mathew, Anthony Cortes
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class ManagerIntroController extends Zend_Controller_Action
{
    protected $isManager = false;
    protected $username;

    public function init()
    {
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isManager = ($_SESSION['user_type'] == 'Manager');
            $this->username = $_SESSION['login_user'];
            $fname = $this->_aM->FirstName();
            $lname = $this->_aM->LastName();
            $this->view->LoggedInView = "Welcome Manager: " . $fname . " " . $lname;
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
