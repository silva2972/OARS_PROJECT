<?php

class StaffRentalSummaryController extends Zend_Controller_Action
{

private $_DB = null;
    public function init()
    {
        $this->_DB = new Application_Model_DbTable_Staff(); 
    }

    public function indexAction()
    {
        $this->view->rentalSummaryList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getRentalSummary();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["fname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["lname"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["position"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["rentalSum"];
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }


}

