<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class VacantApartmentListController extends Zend_Controller_Action
{
    protected $isManager = false;
    protected $username;

    private $_DB = null;

    public function init()
    {
        $this->_DB = new Application_Model_DbTable_Apartment();

        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isManager = ($_SESSION['user_type'] == 'Manager');
            $this->username = $_SESSION['login_user'];
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

        $this->view->vacantList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getVacantApartments();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["apt_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_type"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_deposit_amt"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_rent_amt"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }

}
