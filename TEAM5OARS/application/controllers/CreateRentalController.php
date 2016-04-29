<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class CreateRentalController extends Zend_Controller_Action
{
    // login stuff
    protected $username;
    protected $isAssistant = false;

    protected $apt_no;
    protected $rental_no;

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
        // if ($this->isAssistant)
        // {
        //     $fname = $this->_aM->FirstName();
        //     $lname = $this->_aM->LastName();
        //     $this->view->LoggedInView = "Welcome " . $fname . " " . $lname . " | <a href=" . $this->view->baseURL() . "/tenantaccount/logout>Logout</a>";
        //     $this->view->role = $_SESSION['user_type'];
        //
        // }
        // else
        // {
        //     $this->view->LoggedInView = "<a href=" . $this->view->baseURL() . "/account>Login | Register</a>";
        //     $this->view->NavbarExtra = "";
        // }

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
        if (isset($_POST["update"])) {
            $apt = ($_POST["optionsRadios"]);
            $apartments = new Application_Model_DbTable_Apartment();
            $apt = $apartments->fetchRow(
                $apartments->select()
                ->where('apt_no = ?', $apt)
            );
            $this->view->apartment = $apt;
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

            var_dump(array($name, $gender, $tenant_ss, $dob, $home, $work, $employer, $marital, $username, $password));
        }

        // send out reciept info

    }


}
