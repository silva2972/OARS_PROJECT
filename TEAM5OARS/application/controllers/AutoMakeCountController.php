<!--//Coded By: Nixon Mathew, Anthony Cortes
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

// login stuff
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class AutoMakeCountController extends Zend_Controller_Action
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

        $this->_DB = new Application_Model_DbTable_TenantAuto();
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isManager) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
        
        $this->view->makeList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getMakeCount();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["auto_make"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["makeCount"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }



}
