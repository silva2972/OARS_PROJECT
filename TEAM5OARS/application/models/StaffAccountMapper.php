<!--//Coded By: Luis Silva, Nixon Mathew
//Date Created: 04/19/2015
//Date Approved: 04/25/2015
//Approved By: Luis Silva-->
<?php

class StaffAccountMapper {

    private $_DB = null;

    function __construct() {
        $this->_DB = new Application_Model_DbTable_Staff();
    }

    function VerifyLoginInformation($user, $pass) {
        $isValid = $this->_DB->UsernameAndPasswordValidate($user, $pass);
        return ($isValid);
    }

    function GetHashedToken($user, $fname, $lname) {
        return md5($user . $fname . $lname);
    }

    function LoggedIn() {
        if (session_id() == '' || !isset($_SESSION))
            return false;

        if (!isset($_SESSION['login_user']) || !isset($_SESSION['login_token']))
            return false;

        $user = $_SESSION['login_user'];
        $token = $_SESSION['login_token'];

        $fname = $this->_DB->GrabFirstName($user);
        $lname = $this->_DB->GrabLastName($user);
        
        $hashToken = $this->GetHashedToken($user, $fname, $lname);

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

    function FirstName()
    {
        if (!$this->LoggedIn())
                return null;
        
        $user = $_SESSION['login_user'];
        return $this->_DB->GrabFirstName($user);
    }

    function LastName()
    {
        if (!$this->LoggedIn())
                return null;

        $user = $_SESSION['login_user'];
        return $this->_DB->GrabLastName($user);
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
