<?php

class Application_Model_DbTable_Apartment extends Zend_Db_Table_Abstract
{

    protected $_name = 'apartment';
    protected $_primary = 'apt_no';
    
    private $apt_no;
    private $apt_type;
    private $apt_status;
    private $apt_utility;
    private $apt_deposit_amt;
    private $apt_rent_amt;
    
    public function getApartment($no) {
        $no = (int)$no;
        $row = $this->fetchRow('apt_no = ' . $no);
        if (!$row) {
          throw new Exception("Could not find row $no");
        }
        return $row->toArray();
    }
    public function getVacantApartments(){
        $row = $this->fetchAll($this->select()->where('apt_status = ?', 'V'));
        return $row;
        
    }
    public function getApt_No() { return $apt_no; }
    public function setApt_No($apt_no) { $this->apt_no = $apt_no; }
    public function getAptType() { return $apt_type; }
    public function setApt_Type($apt_type) { $this->apt_type = $apt_type; }
    public function getApt_Status() { return $apt_status; }
    public function setApt_Status($apt_status) { $this->apt_status = $apt_status; }
    public function getApt_Utility() { return $apt_utility; }
    public function setApt_Utility($apt_utility) { $this->apt_utility = $apt_utility; }
    public function getApt_Deposit_Amt() { return $apt_deposit_amt; }    
    public function setApt_Deposit_Amt($apt_deposit_amt) { $this->apt_deposit_amt = $apt_deposit_amt; }
    public function getApt_Rent_Amt() { return $apt_rent_amt; }
    public function setApt_Rent_Amt($apt_rent_amt) { $this->apt_rent_amt = $apt_rent_amt; }            
}
