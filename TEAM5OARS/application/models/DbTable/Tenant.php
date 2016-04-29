<?php

class Application_Model_DbTable_Tenant extends Zend_Db_Table_Abstract
{

    protected $_name = 'tenant';
    function UsernameAndPasswordValidate($user, $pass)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        if (!$row || $row["password"] != $pass)
            return false;
            else
                return true;
    }
    function GrabName($user)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["tenant_name"];
    }

    function GrabAccountID($user)
    {
        $row = $this->fetchrow($this->select()->where("username = ?", $user));
        return $row["tenant_ss"];
    }

    public function addTenant($ss, $name, $dob, $marital, $work, $home, $employer, $gender, $username, $passowrd, $rental) {
        $data = array(
            'tenant_ss' => $ss,
            'tenant_name' => $name,
            'tenant_dob' => $dob,
            'marital' => $marital,
            'work_phone' => $work,
            'home_phone' => $home,
            'employer_name' => $employer,
            'gender' => $gender,
            'username' => $username,
            'password' => $password,
            'rental_no' => $rental
        );
        $this->insert($data);
    }

    public function getTenant_SS()
    {

    }
   public function setTenant_SS()
    {

    }
   public function getTenant_Name()
    {

    }
    public function setTenant_Name()
    {

    }
    public function getTenant_DOB()
    {

    }
    public function setTenant_DOB()
    {

    }public function getMarital()
    {

    }
    public function setMarital()
    {

    }
    public function getWork_Phone()
    {

    }public function setWork_Phone()
    {

    }
    public function getHome_Phone()
    {

    }
    public function setHome_Phone()
    {}

    public function getEmployer()
    {

    }
    public function setEmployer()
    {

    }
    public function getGender()
    {

    }
    public function setGender()
    {

    }

    public function getUsername()
    {

    }
    public function setUsername()
    {

    }
    public function getPassword()
    {

    }
    public function setPassword()
    {

    }


}
