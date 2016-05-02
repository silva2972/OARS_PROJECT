<!--//Coded By: Kaisong Fan, Visak Varghese
//Date Created: 04/20/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class CreateRentalController extends Zend_Controller_Action
{
    // login stuff
    protected $username;
    protected $isAssistant = false;

    protected $apt;
    protected $rental;

    public function init() {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isAssistant = ($_SESSION['user_type'] == 'Assistant');
            $this->username = $_SESSION['login_user'];
        } else {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isAssistant) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }

        $apartments = new Application_Model_DbTable_Apartment();
        $vacantList = $apartments->fetchAll(
                    $apartments->select()
                        ->where("apt_status = 'V'")
                    );
        $this->view->vacantList = $vacantList;
    }

    public function inputAction()
    {
        // check for permissions...
        if (!$this->isAssistant) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }

        // get stuff
        if (isset($_POST["update"])) {
            $aptChoice = ($_POST["optionsRadios"]);
            $apartments = new Application_Model_DbTable_Apartment();
            $this->apt = $apartments->fetchRow(
                $apartments->select()
                ->where('apt_no = ?', $aptChoice)
            );

            // pass it in
            $this->view->apartment = $this->apt;
        }
    }

    public function recieptAction()
    {
        // check for permissions...
        if (!$this->isAssistant) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }

        // take form data in
        if (isset($_POST["update"])) {
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $tenant_ss = $_POST["ss"];
            $dob = $_POST["dob"];
            $home = $_POST["homePhone"];
            $work = $_POST["workPhone"];
            $employer = $_POST["employerName"];
            $marital = $_POST["marital"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $lease = $_POST["optionsRadios"];
            $apt_no = $_POST["apt_no"];

            // get all the tables we need
            $tenants = new Application_Model_DbTable_Tenant();
            $rentals = new Application_Model_DbTable_Rental();
            $apartments = new Application_Model_DbTable_Apartment();
            $staff = new Application_Model_DbTable_Staff();

            // fetch appropriate rows from tables
            $staff = $staff->fetchRow(
                    $staff->select()
                    ->where('username = ?', $this->username)
                );
            $this->apt = $apartments->fetchRow(
                    $apartments->select()
                    ->where('apt_no = ?', $apt_no)
                );

            // set apartment to no longer vacant
            $data = array (
                'apt_status' => 'R'
            );
            $apartments->update($data, 'apt_no = ' . (int)$apt_no);

            // get all the dates
            $date = date('Y-m-d', time());
            $cancel = date('Y-m-d', strtotime('last day of next month', time()));
            $lease_start = date('Y-m-d', strtotime('first day of next month', time()));
            if ($lease == "One") {
                $lease_end = strtotime($date . ' + 12 months');
            } else {
                $lease_end = strtotime($date . ' + 6 months');
            }
            $lease_end = date('Y-m-d', strtotime('last day of this month', $lease_end));
            $renewal = strtotime($lease_end . ' - 2 months');
            $renewal = date('Y-m-d', strtotime('first day of this month', $renewal));

            // add row to rental
            $rentals->addRental($date, 'O', $cancel, $lease, $lease_start, $lease_end, $renewal, $staff->staff_no, $this->apt->apt_no);
            $this->rental = $rentals->fetchRow(
                    $rentals->select()
                    ->where('apt_no = ?', $this->apt->apt_no)
                );

            // add row to tenant
            $tenants->addTenant($tenant_ss, $name, $dob, $marital, $work, $home, $employer, $gender, $username, $password, $this->rental->rental_no);
            $tenant = $tenants->fetchRow(
                    $tenants->select()
                    ->where('tenant_ss = ?', $tenant_ss)
                );

            // pass stuff in
            $this->view->tenant = $tenant;
            $this->view->rental = $this->rental;
            $this->view->apt = $this->apt;
        }

    }

}
