<!--//Coded By: Luis Silva, Keith Russell
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
class PayRrentController extends Zend_Controller_Action
{
    private $username = null;
    private $creditNo = null;
    private $creditAmt = null;
    private $date = null;
    private $due = null;
    private $cType = null;
    private $cdate = null;
    private $r_no = null;
    private $a_no = null;
    private $i_no = null;
    private $name = null;
    private $tenantss = null;
    public function init()
    {
        $this->_aM = new TenantAccountMapper();
    }

    public function indexAction()
    {
        session_start();

        $loggedIn = $this->_aM->LoggedIn();
        $this->username = $_SESSION['login_user'];
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/tenantaccount");
            exit();
        }
        $tenants = new Application_Model_DbTable_Tenant();
        $rentals = new Application_Model_DbTable_Rental();
        $apartments = new Application_Model_DbTable_Apartment();
        $r_Invoice = new Application_Model_DbTAble_RentalInvoice();
        $tenant_info = $tenants->fetchRow(
                $tenants->select()
                ->where('username = ?',$this->username)
                );
        $this->r_no = $tenant_info['rental_no'];
        $tenant_rental = $rentals->fetchRow(
                $rentals->select()
                ->where('rental_no = ?', $this->r_no)
            );
        $this->a_no = $tenant_rental['apt_no'];
        $tenant_apartment = $apartments->fetchRow(
                $apartments->select()
                ->where('apt_no = ?', $this->a_no));
        $type = $tenant_apartment['apt_type'];
        if($type == 0)
            $this->due = 300;
        else if($type == 1)
            $this->due = 400;
        else if($type == 2)
            $this->due = 500;
        else if($type == 3)
            $this->due = 600;

        $this->view->rental_number = $this->r_no;
        $this->view->due = $this->due;

        if (isset($_POST['submit'])){
            $this->view->test = 'yesssssss';
            $this->creditNo = $_POST["ccnumber"];
            $this->creditAmt = $_POST["payment"];
            $this->date = date('Y-m-d');
            if (isset($_POST["optionsRadios"])){
                $this->cType = $_POST["optionsRadios"];
            }
            else if (isset($_POST["optionsRadios2"])){
                $this->cType = $_POST["optionsRadios2"];
            }
            else if (isset($_POST["optionsRadios3"])){
                $this->cType = $_POST["optionsRadios3"];
            }
            $this->cdate = $_POST["edate"];
            $this-> i_no = $r_Invoice->submitPayment($this->date, $this->due, $this->creditNo,$this->cType,$this->cdate,$this->creditAmt, $this->r_no);
            $param = array('invoice_date' => $this->date, 'invoice_no' => $this->i_no, 'amt' => $this->creditAmt, 'rental_no' => $this->r_no, 'apt_no' => $this->a_no);
            $this->_forward('output','PayRrent', null, $param);
            return;
        }
    }

    public function outputAction()
    {
        $loggedIn = $this->_aM->LoggedIn();
        $this->username = $_SESSION['login_user'];
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/index");
            exit();
        }
        $this->name = $this->_aM->Name();
        $this->tenantss = $this->_aM->AccountId();
        $this->view->tenantName = $this->name;
        $this->view->tenantSS = $this->tenantss;
        $this->view->RentalNumber = $this->getRequest()->getParam('rental_no');
        $this->view->ApartmentNumber = $this->getRequest()->getParam('apt_no');
        $this->view->InvoiceNumber = $this->getRequest()->getParam('invoice_no');
        $this->view->InvoiceDate = $this->getRequest()->getParam('invoice_date');
        $this->view->Paid = $this->getRequest()->getParam('amt');
    }

}
