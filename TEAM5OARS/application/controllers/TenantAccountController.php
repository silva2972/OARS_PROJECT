<?php
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");

class TenantAccountController extends Zend_Controller_Action {

    private $_DB = null;

    public function init() {
        $this->_DB = new Application_Model_DbTable_Tenant();

        session_start();
        $this->_aM = new TenantAccountMapper();

        $loggedIn = $this->_aM->LoggedIn();
        if ($loggedIn) {
            $name = $this->_aM->Name();
            $this->view->LoggedInView = "Welcome " . $name . " | <a href=" . $this->view->baseURL() . "/tenantaccount/logout>Logout</a>";
        } else {
            $this->view->LoggedInView = "<a href=" . $this->view->baseURL() . "/tenantaccount>Login | Register</a>";
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
                    $aM = new TenantAccountMapper();
                    $isValidAccount = $aM->VerifyLoginInformation($user, $pass);
                    if (!$isValidAccount) {
                        header("location: ../tenantaccount");
                        exit();
                    }

                    $name = $this->_DB->GrabName($user);

                    session_start();
                    $_SESSION['login_user'] = $user;
                    $_SESSION['login_token'] = $aM->GetHashedToken($user,$name);
                    $_SESSION['user_type'] = 'tenant';
                }
            }
        }
        header("location: ../tenantintro"); /*redirect link  */
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

/*
    //UC Register

    public function registerAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["uname"]) && isset($_POST["pword"]) && isset($_POST["confirmpass"])) {
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $email = $_POST["email"];
                $uname = $_POST["uname"];
                $pword = $_POST["pword"];
                $confirmpass = $_POST["confirmpass"];
                $institution = $_POST["institution"];

                $recaptcha = $_POST['g-recaptcha-response'];
                $google_url = "https://www.google.com/recaptcha/api/siteverify";
                $secret = '6LcQ8gUTAAAAACC1xEZrhMdTA_1Jzq-3sF65Znzi';
                $ip = $_SERVER['REMOTE_ADDR'];

                if (strcmp($ip, "::1") == 0)
                      $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha;
                else
                    $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha. "&remoteip=" . $ip;


                $res = file_get_contents($url);
                $res = json_decode($res, true);

                $regError = false;
                $errorStr = "";

                //reCaptcha success check
                if (!$res['success']) {
                    $regError = true;
                    $errorStr .= "*Bad Captcha<br>";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $regError = true;
                    $errorStr .= "*Invalid Email<br>";
                }

                if (strcmp($pword, $confirmpass) != 0)
                {
                    $regError = true;
                    $errorStr .= "*Passwords Do Not Equal!";
                }

                if ($regError)
                {
                    echo "<b>Registration Error</b><br>";
                    echo $errorStr;
                    echo "<br><br>";
                    echo "<a href=\"" . $this->view->baseURL() . "/account\">Click Here to Try Again</a>";
                    exit();
                }

                if ($pword == $confirmpass && !empty($fname) && !empty($lname) && !empty($email) && !empty($uname) && !empty($pword)) {
                    $this->_DB->CreateAccount($fname, $lname, $email, $uname, $pword, $institution);
                }
            }
        }

        header("location: ../index");
    }
*/
    public function logoutAction() {
        session_destroy();

        header("location: ../");
        exit();
    }

}
