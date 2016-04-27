<?php

class Application_Model_DbTable_Complaints extends Zend_Db_Table_Abstract
{

    protected $_name = 'complaints';

    private $complaint_no;
    private $complaint_date;
    private $rental_complaint;
    private $apt_complaint;
    private $status;

    public function getComplaint_No() { return $complaint_no; }
    public function setComplaint_No($complaint_no) { $this->complaint_no = $complaint_no; }
    public function getComplaint_Date() { return $complaint_date; }
    public function setComplaint_Date($complaint_date) { $this->complaint_date = $complaint_date; }
    public function getRental_Complaint() { return $rental_complaint; }
    public function setRental_Complaint($rental_complaint) { $this->rental_complaint = $rental_complaint;}
    public function getApt_Complaint() { return $apt_complaint; }
    public function setApt_Complaint($apt_complaint) { $this->apt_complaint = $apt_complaint; }
    public function getStatus() { return $status; }
    public function setStatus($status) { $this->status = $status; }

    public function addComplaint($date, $apt_comp, $rental, $apt) {
        $data = array(
            'complaint_date' => $date,
            'apt_complaint' => $apt_comp,
            'rental_no' => $rental,
            'apt_no' => $apt
        );
        $this->insert($data);
    }
}
