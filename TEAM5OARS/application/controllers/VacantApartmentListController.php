<?php

class VacantApartmentListController extends Zend_Controller_Action
{
    private $_DB = null;
    public function init()
    {
        $this->_DB = new Application_Model_DbTable_Apartment(); 
    }

    public function indexAction()
    {
        $this->view->vacantList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getVacantApartments();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["apt_no"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_type"]; 
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_deposit_amt"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["apt_rent_amt"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }

}

