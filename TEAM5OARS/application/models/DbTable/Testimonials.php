<?php

class Application_Model_DbTable_Testimonials extends Zend_Db_Table_Abstract
{

    protected $_name = 'testimonials';

    public function getTestimonial($id) {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
          throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

}
