<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class ComplaintsController extends Zend_Controller_Action
{

    protected $isSupervisor = false;
    protected $isTenant = false;
    protected $canEnter = false;

    protected $username = null;

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
            if ($this->canEnter) {
                $this->isTenant = true;
            }
        }
    }

    public function indexAction()
    {
        if (!$this->isSupervisor) {
            header("location: " . $this->view->baseURL() . "/staffaccount");
            exit();
        }

        $complaints = new Application_Model_DbTable_ComplaintsView();
        $this->view->complaints = $complaints->fetchAll();

        if (isset($_POST['update'])) {
            $complaints = new Application_Model_DbTable_Complaints;
            $id = ($_POST['id']);
            $data = array (
                'status' => 'F'
            );
            $complaints->update($data, 'complaint_no = ' . (int)$id);
            header("location: " . $this->view->baseURL() . "/complaints");
        }
    }

    public function updateAction()
    {

    }

    public function addAction()
    {
        if (!$this->isTenant) {
            header("location: " . $this->view->baseURL() . "/index");
            exit();
        }
        $complaints = new Application_Model_DbTable_Complaints();
        $tenants = new Application_Model_DbTable_Tenant();
        $rentals = new Application_Model_DbTable_Rental();
        $apartments = new Application_Model_DbTable_Apartment();
        $date = date('Y-m-d', time());

        $tenant = $tenants->fetchRow(
                $tenants->select()
                    ->where("username = ?", $this->username)
                );
        $rental = $rentals->fetchRow(
                $rentals->select()
                    ->where("rental_no = ?", $tenant->rental_no)
                );
        if (isset($_POST["submit"])) {
            $content = $_POST["testimonial"];
            $complaints->addComplaint($date, $content, $tenant['rental_no'], $rental['apt_no']);
        }

    }


}
