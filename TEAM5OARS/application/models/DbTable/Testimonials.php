<?php

class Application_Model_DbTable_Testimonials extends Zend_Db_Table_Abstract
{

    protected $_name = 'testimonials';
    protected $_primary = 'testimonial_id';

    public function getTestimonial($id) {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
          throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addTestimonial($testimonial_content, $tenant_ss) {
        $data = array(
            'testimonial_date' => $testimonial_date,
            'testimonial_content' => $testimonial_content,
            'tenant_ss' => $tenant_ss
        );
        $this->insert($data);
    }

}
