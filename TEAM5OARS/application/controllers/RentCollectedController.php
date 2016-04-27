<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class RentCollectedController extends Zend_Controller_Action
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

        $this->_DB = new Application_Model_DbTable_RentalInvoice();
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isManager) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
        
        $this->view->rentList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getRentCollected();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["year"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["month"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["rentCollected"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }


}
