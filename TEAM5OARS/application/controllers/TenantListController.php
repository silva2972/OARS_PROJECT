<?php

class TenantListController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $tenants = new Application_Model_DbTable_TenantView();
        $this->view->tenants = $tenants->fetchAll();
    }


}
