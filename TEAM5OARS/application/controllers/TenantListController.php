<!--//Coded By: Kaisong Fan, Visak Varghese
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class TenantListController extends Zend_Controller_Action
{
    protected $isStaff = false;

    public function init()
    {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        $this->isStaff =  $this->_aM->LoggedIn();
    }

    public function indexAction()
    {
        if (!$this->isStaff) {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }
        $tenants = new Application_Model_DbTable_TenantView();
        $this->view->tenants = $tenants->fetchAll();
    }


}
