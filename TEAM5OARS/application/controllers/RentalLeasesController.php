<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class RentalLeasesController extends Zend_Controller_Action
{
    protected $isManager = false;
    protected $username;

    private $_DB = null;

    public function init()
    {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isManager = ($_SESSION['user_type'] == 'Manager');
            $this->username = $_SESSION['login_user'];
        } else {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }

        $this->_DB = new Application_Model_DbTable_Rental();
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isManager) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
        
        $this->view->leaseList = $this->createLeaseList();
    }
    public function createLeaseList(){
        $result = $this->_DB->getLeaseList();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["rental_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["lease_type"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }

}
