<!--//Coded By: Nixon Mathew, Anthony Cortes
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
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

    public function addTestimonial($testimonial_content, $tenant_ss, $testimonial_date) {
        $data = array(
            'testimonial_date' => $testimonial_date,
            'testimonial_content' => $testimonial_content,
            'tenant_ss' => $tenant_ss
        );
        $this->insert($data);
    }

    public function getTestimonial_Id() {}
    public function setTestimonial_Id() {}
    public function getTestimonial_Date() {}
    public function setTestimonial_Date() {}
    public function getTestimonial_Content() {}
    public function setTestimonial_Content() {}

}
