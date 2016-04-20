<?php

class TestimonialsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $testimonials = new Application_Model_DbTable_TestimonialsView();
        $this->view->testimonials = $testimonials->fetchAll();

        if (isset($_POST["submit"])) {
            $keyword = $_POST["keyword"];
            $this->view->testimonials = $testimonials->fetchAll(
                $testimonials->select()
                    ->where("testimonial_content LIKE '%" . $keyword . "%'")
                );
        }
    }


}
