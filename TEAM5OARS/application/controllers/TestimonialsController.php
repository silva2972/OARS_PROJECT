<?php

class TestimonialsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $testimonials = new Application_Model_DbTable_Testimonials();
        $this->view->testimonials = $testimonials->fetchAll();
    }


}
