<!--//Coded By: Luis Silva, Sai Vadlamani
//Date Created: 04/21/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class StaffRentalSummaryController extends Zend_Controller_Action
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
        
        $this->view->rentalSummaryList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getRentalSummary();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["fname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["lname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["position"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["rentalSum"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }


}
