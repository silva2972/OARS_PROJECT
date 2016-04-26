<?php

class Application_Model_DbTable_Rental extends Zend_Db_Table_Abstract
{

    protected $_name = 'rental';

    private $rental_no;
    private $rental_date;
    private $rental_status;
    private $cancel_date;
    private $lease_type;
    private $lease_start;
    private $lease_end;
    private $renewal_date;
    public function getLeaseList(){
        $row = $this->fetchAll($this->select()->where('rental_status = ?', 'O'));
        return $row;
    }
    public function getRental_No() { return $rental_no; }
    public function setRental_No($rental_no) { $this->rental_no = $rental_no; }
    public function getRental_Date() { return $rental_date; }
    public function setRental_Date($rental_date) { $this->rental_date = $rental_date; }
    public function getRental_Status() { return $rental_status; }
    public function setRental_Status($rental_status) { $this->rental_status = $rental_status; }
    public function getCancel_Date() { return $cancel_date; }
    public function setCancel_Date($cancel_date) { $this->cancel_date = $cancel_date; }
    public function getLease_Type() { return $lease_type; }
    public function setLease_Type($lease_type) { $this->lease_type = $lease_type; }
    public function getLease_Start() { return $lease_start; }
    public function setLease_Start($lease_start) { $this->lease_start = $lease_start; }
    public function getLease_End() { return $lease_end; }
    public function setLease_End($lease_end) { $this->lease_end = $lease_end; }
    public function getRenewal_Date() { return $renewal_date; }
    public function setRenewal_Date($renewal_date) { $this->renewal_date = $renewal_date; }
}

