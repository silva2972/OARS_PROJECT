<?php

class TenantController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $tenants = new Application_Model_DbTable_Tenant();
        $tenants_autos = new Application_Model_DbTable_TenantAuto();
        $tenants_family = new Application_Model_DbTable_TenantFamily();
        $tenantss = 123456789;
        if (isset($_POST["submit"])) {
            $tenantss = $_POST["tenantss"];
        }
        $tenant_info = $tenants->fetchAll(
            $tenants->select()
                ->where("tenant_ss = $tenantss")
            );
        $tenant_autos = $tenants_autos->fetchAll(
            $tenants_autos->select()
                ->where("tenant_ss = $tenantss")
            );
        $tenant_family = $tenants_family->fetchAll(
            $tenants_family->select()
                ->where("tenant_ss = $tenantss")
            );

        $this->view->tenant_info = $tenant_info;
        $this->view->tenant_auto = $tenant_autos;
        $this->view->tenant_family = $tenant_family;
    }


}
