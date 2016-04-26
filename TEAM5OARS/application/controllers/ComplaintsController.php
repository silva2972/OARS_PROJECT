<?php

class ComplaintsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $complaints = new Application_Model_DbTable_ComplaintsView();
        $this->view->complaints = $complaints->fetchAll();
    }

    public function updateAction()
    {
        // action body
    }


}
