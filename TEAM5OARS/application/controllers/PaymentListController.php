<?php
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");
class PaymentListController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_aM = new StaffAccountMapper();
    }

    public function indexAction()
    {
        session_start();
        
        $loggedIn = $this->_aM->LoggedIn();
        $this->username = $_SESSION['login_user'];
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/staffaccount");
            exit();
        }
        $rentals = new Application_Model_DbTable_Rental();
        $r_Invoice = new Application_Model_DbTAble_RentalInvoice();
        
        if (isset($_POST['submit'])){
            $a_no = $_POST["rentalNumber"];
            $rental = $rentals->fetchRow(
                $rentals->select()
                ->where('apt_no = ?',$a_no)
                );
            $r_no = $rental['rental_no'];
            $param = array('r_no' => $r_no);
            $this->_forward('output','PaymentList', null, $param);
        }
            
    }
    public function outputAction(){
        $loggedIn = $this->_aM->LoggedIn();
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/staffaccount");
            exit();
        }
        $r_Invoice = new Application_Model_DbTAble_RentalInvoice();
        
        $r_no = $this->getRequest()->getParam('r_no');
        
        $invoices = $r_Invoice->fetchAll(
            $r_Invoice->select()
            ->where('rental_no = ?',$r_no)
            );
        $this->view->payments = $this->createPaymentList($invoices);;
    }
    public function createPaymentList($invoices){
        $finalHTML = "";
        foreach($invoices as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["rental_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["invoice_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["invoice_date"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["cc_type"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
        }


}

