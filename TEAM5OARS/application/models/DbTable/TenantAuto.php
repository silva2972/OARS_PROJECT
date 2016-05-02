<!--//Coded By: Luis Silva, Keith Russell
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

class Application_Model_DbTable_TenantAuto extends Zend_Db_Table_Abstract
{

    protected $_name = 'tenant_auto';
    
    private $license_no;
    private $auto_make;
    private $auto_model;
    private $auto_year;
    private $auto_color;
    function getMakeCount(){
        $select = $this->select();
        $select->from($this, array('auto_make','makeCount' =>'COUNT(*)'));
        $select->group('auto_make');
        $row = $this->fetchAll($select);
        return $row;
    }
    /*->group('auto_make', 'system_role')*/
    public function getLicenseNo() { return $license_no; }
    public function setLicense_No($license_no) { $this->license_no = $license_no; }
    public function getAuto_Make() { return $auto_make; }
    public function setAuto_Make($auto_make) { $this->auto_make = $auto_make; }
    public function getAuto_Model() { return $auto_model; }
    public function setAuto_Model($auto_model) { $this->auto_model = $auto_model; }
    public function getAuto_Year() { return $auto_year; }
    public function setAuto_Year($auto_year) { $this->auto_year = $auto_year; }
    public function getAuto_Color() { return $auto_color; }
    public function setAuto_Color($auto_color) { $this->auto_color = $auto_color; }
    
}

