<!--//Coded By: Luis Silva, Nixon Mathew
//Date Created: 04/19/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class StaffAccountController extends Zend_Controller_Action {

    private $_DB = null;

    public function init() {
        $this->_DB = new Application_Model_DbTable_Staff();

        session_start();
        $this->_aM = new StaffAccountMapper();

        $loggedIn = $this->_aM->LoggedIn();
        if ($loggedIn) {
            $fname = $this->_aM->FirstName();
            $lname = $this->_aM->LastName();

            $this->view->LoggedInView = "Welcome " . $fname . " " . $lname . " | <a href=" . $this->view->baseURL() . "/staffaccount/logout>Logout</a>";
        } else {
            $this->view->LoggedInView = "<a href=" . $this->view->baseURL() . "/staffaccount>Login | Register</a>";
            $this->view->NavbarExtra = "";
        }
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function loginAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST) && isset($_POST["username"]) && isset($_POST["password"])) {
                $user = $_POST["username"];
                $pass = $_POST["password"];

                if (!empty($user) && !empty($pass)) {
                    $aM = new StaffAccountMapper();
                    $isValidAccount = $aM->VerifyLoginInformation($user, $pass);
                    if (!$isValidAccount) {
                        header("location: ../staffaccount");
                        exit();
                    }

                    $fname = $this->_DB->GrabFirstName($user);
                    $lname = $this->_DB->GrabLastName($user);
                    $role = $this->_DB->GrabAccountPosition($user);
                    session_start();
                    $_SESSION['login_user'] = $user;
                    $_SESSION['login_token'] = $aM->GetHashedToken($user, $fname, $lname);
                    $_SESSION['user_type'] = $role;
                    if($role == 'Manager')
                        header("location: ../managerIntro");
                    elseif($role == 'Supervisor')
                        header("location: ../supervisorIntro");
                    elseif($role == 'Assistant')
                        header("location: ../assistantIntro");
                    else
                        header("location: ../customerServiceIntro");
                }
            }
        }
    }

        function getCurlData($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }

    public function logoutAction() {
        session_destroy();

        // $ref = $_SERVER["HTTP_REFERRER"];
        header('location: ../');

        exit();
    }

}
