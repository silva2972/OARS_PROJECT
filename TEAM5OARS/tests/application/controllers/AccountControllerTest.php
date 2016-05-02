<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function constructTest()
    {
        $this->_DB = new Application_Model_DbTable_Staff();
        if($this->_DB != null)
            return 'construct works';
        else 
            return 'failed construction';
    }
    
    public function VerifyLoginInformationTest($user, $pass)
    {
        $this->_DB->UsernameAndPasswordValidate($user, $pass);
        if (!$this->LoggedIn())
            return 'valid login';
    }
    
    public function getLoginInfoTest()
    {
    
        $user = $_SESSION['login_user'];
        $token = $_SESSION['login_toke'];
    
        $fname = $this->_DB->GrabFirstName($user);
        $lname = $this->_DB->GrabLastName($user);
        
        if (fname != null && lname != null)
            return 'got first and last name';
        else
             return 'did not get first and last name';
    
             
    }
    
    


}
?>

