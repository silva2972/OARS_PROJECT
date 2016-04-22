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

}

