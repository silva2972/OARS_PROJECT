<!--//Coded By: Kaisong Fan, Visak Varghese
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

class Application_Model_DbTable_RentalInvoice extends Zend_Db_Table_Abstract
{

    protected $_name = 'rental_invoice';

    function getRentCollected(){
        $select = $this->select();
        $select->from($this, array('year' => 'Year(invoice_date)', 'month' => 'Month(invoice_date)','rentCollected' =>'SUM(CC_AMT)'));
        $select->where('invoice_date BETWEEN DATE(NOW()) - INTERVAL (DAY(NOW()) - 1) DAY - INTERVAL 9999 MONTH AND NOW()');
        $select->group(array('Year(invoice_date)', 'Month(invoice_date)'));
        $select->order(array('Year(invoice_date)', 'Month(invoice_date)'));
        $row = $this->fetchAll($select);
        return $row;
    }
    function submitPayment($date, $due, $creditNo, $cType, $cdate, $creditAmt, $r_no){
        $select = $this->select();
        $select->from($this, array('nextNo' => 'max(invoice_no)'));
        $result = $this->fetchRow($select);
        $nextIncrement = $result['nextNo'] + 1;
        $newRow = $this->createRow();
        $newRow->invoice_no = $nextIncrement;
        $newRow->invoice_date = $date;
        $newRow->invoice_due = $due;
        $newRow->cc_no = $creditNo;
        $newRow->cc_type = $cType;
        $newRow->cc_exp_date = $cdate;
        $newRow->cc_amt = $creditAmt;
        $newRow->rental_no = $r_no;
        
        $newRow->save();

        return $nextIncrement;
    }
    public function Rental_Invoice()
    {

    }
    public function getInvoice_No()
    {

    }
    public function setInvoice_No()
    {

    }
    public function getInvoice_Date()
    {

    }
    public function setInvoice_Date()
    {

    }
    public function getInvoice_Due()
    {

    }
    public function getInvoice_Duee()
    {

    }
    public function getCC_No()
    {

    }
    public function setCC_No()
    {

    }
    public function getCC_Type()
    {

    }
    public function setCC_Type()
    {

    }
    public function getCC_Exp_Date()
    {

    }
    public function setCC_Exp_Date()
    {

    }

    public function getCC_Amt()
    {

    }

    public function setCC_Amt()
    {

    }


}

