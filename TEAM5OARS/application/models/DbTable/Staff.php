<?php

class Application_Model_DbTable_Staff extends Zend_Db_Table_Abstract
{

    protected $_name = 'staff';

function UsernameAndPasswordValidate($user, $pass)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        if (!$row || $row["password"] != $pass)
            return false;
        else
            return true;
    }
    function GrabFirstName($user)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["fname"];
    }
    function GrabLastName($user)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["lname"];;
    }
    function GrabAccountID($user)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["staff_no"];
    }
    
    function GrabAccountPosition($user){
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["position"];
    }
    function CreateAccount($firstname, $lastname,$username, $password, $pos)
    {
      
    }
    
    public function getStaff_No() {}
    public function setStaff_No($new_staff_no) {}
    public function getFirst_Name() {}
    public function setFirst_Name($new_first_name) {}
    public function getLast_Name() {}
    public function setLast_Name($new_last_name) {}
    public function getPosition() {}
    public function setPosition($new_position) {}
    public function getGender() {}
    public function getDOB() {}
    public function setDOB($new_dob) {}
    public function setGender($new_gender) {}
    public function getSalary() {}
    public function setSalary($new_salary) {}
    public function getUsername() {}
    public function setUsername($new_username) {}
    public function getPassword() {}
    public function setPassword($new_password) {}    
    
    
}

