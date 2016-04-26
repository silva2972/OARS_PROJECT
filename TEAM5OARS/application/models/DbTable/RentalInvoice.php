<?php

class Application_Model_DbTable_RentalInvoice extends Zend_Db_Table_Abstract
{

    protected $_name = 'rental_invoice';

    function getRentCollected(){
        $select = $this->select();
        $select->from($this, array('year' => 'Year(invoice_date)', 'month' => 'Month(invoice_date)','rentCollected' =>'SUM(CC_AMT)'));
        $select->where('invoice_date BETWEEN DATE(NOW()) - INTERVAL (DAY(NOW()) - 1) DAY - INTERVAL 999 MONTH AND NOW()');
        $select->group(array('Year(invoice_date)', 'Month(invoice_date)'));
        $select->order(array('Year(invoice_date)', 'Month(invoice_date)'));
        $row = $this->fetchAll($select);
        return $row;
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

