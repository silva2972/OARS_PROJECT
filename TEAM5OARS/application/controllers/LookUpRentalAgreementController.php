<!--//Coded By: Luis Silva, Keith Russell
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php
require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
class LookUpRentalAgreementController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        session_start();
        $this->_aM = new TenantAccountMapper();
        $tenants = new Application_Model_DbTable_Tenant();
        $rentals = new Application_Model_DbTable_Rental();
        $apartments = new Application_Model_DbTable_Apartment();
        $loggedIn = $this->_aM->LoggedIn();

        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/tenantaccount");
            exit();
        }
        if ($loggedIn)
        {
            $username = $_SESSION['login_user'];
            $tenant_info = $tenants->fetchRow(
                $tenants->select()
                ->where('username = ?',$username)
            );
            $tenantss = $tenant_info['tenant_ss'];
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


}
