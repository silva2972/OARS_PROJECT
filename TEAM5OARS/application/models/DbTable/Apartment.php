<?php

class Application_Model_DbTable_Apartment extends Zend_Db_Table_Abstract
{

    protected $_name = 'apartment';
    protected $_primary = 'apt_no';

    public function getApartment($no) {
        $no = (int)$no;
        $row = $this->fetchRow('apt_no = ' . $no);
        if (!$row) {
          throw new Exception("Could not find row $no");
        }
        return $row->toArray();
    }

    public function getApt_No() {}
    public function setApt_No($apt_no) {}
    public function getAptType() {}
    public function setApt_Type($apt_type) {}
    public function getApt_Status() {}
    public function setApt_Status($apt_status) {}
    public function getApt_Utility() {}
    public function setApt_Utility($apt_utility) {}
    public function getApt_Deposit_Amt() {}    
    public function setApt_Deposit_Amt($apt_deposit_amt) {}
    public function getApt_Rent_Amt() {}
    public function setApt_Rent_Amt($apt_rent_amt) {}            
}
