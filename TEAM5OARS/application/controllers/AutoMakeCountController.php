<?php

class AutoMakeCountController extends Zend_Controller_Action
{
private $_DB = null;
    public function init()
    {
        $this->_DB = new Application_Model_DbTable_TenantAuto(); 
    }

    public function indexAction()
    {
        $this->view->makeList = $this->createList();
    }
    public function createList(){
        $result = $this->_DB->getMakeCount();
        $finalHTML = "";
        foreach($result as $row){
            $finalHTML .= "<tr><td>";
            $finalHTML .= $row["auto_make"];
            $finalHTML .= "</td><td>";
            $finalHTML .= $row["makeCount"]; 
            $finalHTML .= "</td></tr>";
        }
        return $finalHTML;
    }
    


}

