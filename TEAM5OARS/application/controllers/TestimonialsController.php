<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");

class TestimonialsController extends Zend_Controller_Action
{
    protected $isTenant = false;

    public function init()
    {
        session_start();
        $this->_aM = new TenantAccountMapper();
        $this->isTenant = $this->_aM->LoggedIn();

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

    public function addAction()
    {
        if (!$this->isTenant) {
            header("location: " . $this->view->baseURL() . "/tenantaccount");
            exit();
        }

        $tenants = new Application_Model_DbTable_Tenant();
        $testimonials = new Application_Model_DbTable_Testimonials();
        $date = date('Y-m-d', time());
        $tenant = $tenants->fetchRow(
            $tenants->select()
                ->where('username = ?', $_SESSION['login_user'])
            );

        if (isset($_POST["submit"])) {
            $content = $_POST["testimonial"];
            $testimonials->addTestimonial($content, $tenant['tenant_ss'], $date);
        }
    }


}
