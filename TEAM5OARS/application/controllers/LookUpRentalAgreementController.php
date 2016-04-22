<?php

class LookUpRentalAgreementController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $tenants = new Application_Model_DbTable_Tenant();
        $rentals = new Application_Model_DbTable_Rental();
        $apartments = new Application_Model_DbTable_Apartment();
        $tenantss = 123456789;
        if (isset($_POST["submit"])) {
            $tenantss = $_POST["tenantss"];
        }
        $tenant_info = $tenants->fetchAll(
            $tenants->select()
                ->where("tenant_ss = $tenantss")
            );
        $rental_no = $tenant_info->rental_no;
        
    }


}
