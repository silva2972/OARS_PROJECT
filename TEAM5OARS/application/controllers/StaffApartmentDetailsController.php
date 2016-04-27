<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class StaffApartmentDetailsController extends Zend_Controller_Action
{
    protected $isSupervisor = false;
    protected $username;

    private $_DB = null;

    public function init()
    {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isManager = ($_SESSION['user_type'] == 'Supervisor');
            $this->username = $_SESSION['login_user'];
        } else {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }

        $this->_DB = new Application_Model_DbTable_Staff();
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isManager) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
        
        $this->view->apartmentDetailsList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getStaffApartments();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["fname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["lname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["position"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_no"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }


}
