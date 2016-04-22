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

        $tenant_info = $tenants->find($tenantss);
        $rental_no = $tenant_info[0]->rental_no;
        $rental_info = $rentals->find($rental_no);
        $apt_no = $rental_info[0]->apt_no;
        $apartment_info = $apartments->find($apt_no);

        $apt_type = $apartment_info[0]->apt_type;
        if($apt_type == 0) {
            $type = "Studio";
        } elseif ($apt_type == 1) {
            $type = "One Bedroom";
        } elseif ($apt_type == 2) {
            $type = "Two Bedroom";
        } else {
            $type = "Three Bedroom";
        }

        $this->view->tenant = $tenant_info;
        $this->view->rental = $rental_info;
        $this->view->apartment = $apartment_info;
        $this->view->type = $type;
    }


}
