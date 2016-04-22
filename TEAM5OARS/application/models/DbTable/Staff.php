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
}

