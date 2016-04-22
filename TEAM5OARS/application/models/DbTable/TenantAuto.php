<?php

class Application_Model_DbTable_TenantAuto extends Zend_Db_Table_Abstract
{

    protected $_name = 'tenant_auto';

    public function getLicenseNo() {}
    public function setLicense_No($license_so) {}
    public function getAuto_Make() {}
    public function setAuto_Make($auto_make) {}
    public function getAuto_Model() {}
    public function setAuto_Model($auto_model) {}
    public function getAuto_Year() {}
    public function setAuto_Year($auto_year) {}
    public function getAuto_Color() {}
    public function setAuto_Color($auto_color) {}
    
}

