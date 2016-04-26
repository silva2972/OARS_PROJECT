<?php

class RentCollectedController extends Zend_Controller_Action
{

private $_DB = null;
    public function init()
    {
        $this->_DB = new Application_Model_DbTable_RentalInvoice();
    }

    public function indexAction()
    {
        $this->view->rentList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getRentCollected();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["year"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["month"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["rentCollected"]; 
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }
    

}

