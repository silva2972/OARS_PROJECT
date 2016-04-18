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

}
