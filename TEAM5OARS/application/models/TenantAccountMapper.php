<!--//Coded By: Luis Silva, Nixon Mathew
//Date Created: 04/19/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

class TenantAccountMapper {

    private $_DB = null;

    function __construct() {
        $this->_DB = new Application_Model_DbTable_Tenant();
    }

    function VerifyLoginInformation($user, $pass) {
        $isValid = $this->_DB->UsernameAndPasswordValidate($user, $pass);
        return ($isValid);
    }

    function GetHashedToken($user, $name) {
        return md5($user . $name);
    }

    function LoggedIn() {
        if (session_id() == '' || !isset($_SESSION))
            return false;

        if (!isset($_SESSION['login_user']) || !isset($_SESSION['login_token']))
            return false;

        $user = $_SESSION['login_user'];
        $token = $_SESSION['login_token'];

        $name = $this->_DB->GrabName($user);


        $hashToken = $this->GetHashedToken($user, $name);

        if (strcmp($token, $hashToken) != 0)
            return false;

        return true;
    }

    function Username()
    {
        if (!$this->LoggedIn())
                return null;
         $user = $_SESSION['login_user'];
         return $user;
    }

    function Name()
    {
        if (!$this->LoggedIn())
                return null;

        $user = $_SESSION['login_user'];
        return $this->_DB->GrabName($user);
    }

    function AccountID()
    {
        if (!$this->LoggedIn())
                return null;

        $user = $_SESSION['login_user'];
        return $this->_DB->GrabAccountID($user);
    }
}

?>
