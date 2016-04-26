<?php

class RentalLeasesController extends Zend_Controller_Action
{
    private $_DB = null;
    public function init()
    {
        $this->_DB = new Application_Model_DbTable_Rental(); 
    }

    public function indexAction()
    {
        $this->view->leaseList = $this->createLeaseList();
    }
    public function createLeaseList(){
        $result = $this->_DB->getLeaseList();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["rental_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["lease_type"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }

}

