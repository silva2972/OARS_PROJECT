<?php

class Application_Model_DbTable_Staff extends Zend_Db_Table_Abstract
{

    protected $_name = 'staff';
    
    private $first_name;
    private $last_name;
    private $position;
    private $gender;
    private $dob;
    private $salary;
    private $username;
    private $password;
    private $staff_no;

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
    
    public function getStaff_No() { return $staff_no; }
    public function setStaff_No($new_staff_no) { $staff_no = $new_staff_no; }
    public function getFirst_Name() { return $first_name; }
    public function setFirst_Name($new_first_name) { $first_name = $new_first_name; }
    public function getLast_Name() { return $last_name;}
    public function setLast_Name($new_last_name) { $last_name = $new_last_name; }
    public function getPosition() { return $position; }
    public function setPosition($new_position) { $position = $new_position; }
    public function getGender()  { return $gender; }
    public function getDOB() { return $dob; }
    public function setDOB($new_dob) { $dob = $new_dob; }
    public function setGender($new_gender) { $gender = $new_gender; }
    public function getSalary() { return $salary;}
    public function setSalary($new_salary) {$salary = $new_salary;}
    public function getUsername() { return $username;}
    public function setUsername($new_username) { $username = $new_username;}
    public function getPassword() { return $password;}
    public function setPassword($new_password) {$password = $new_password;}    
    
    
}
