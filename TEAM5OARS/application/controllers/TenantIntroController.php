<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
class TenantIntroController extends Zend_Controller_Action
{

    public function indexAction()
    {
        session_start();
        $this->_aM = new TenantAccountMapper();
        $tenants = new Application_Model_DbTable_Tenant();
        $tenants_autos = new Application_Model_DbTable_TenantAuto();
        $tenants_family = new Application_Model_DbTable_TenantFamily();
        $loggedIn = $this->_aM->LoggedIn();
        $username = $_SESSION['login_user'];
        //If not logged in we can't view this page
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/tenantaccount");
            exit();
        }

        if ($loggedIn)
        {
            $name = $this->_aM->Name();
            $this->view->LoggedInView = "Welcome " . $name . " | <a href=" . $this->view->baseURL() . "/tenantaccount/logout>Logout</a>";
            $username = $_SESSION['login_user'];
            $tenant_info = $tenants->fetchRow(
                $tenants->select()
                ->where('username = ?',$username)
                );
            $tenantss = $tenant_info['tenant_ss'];
            $tenant_autos = $tenants_autos->fetchAll(
                $tenants_autos->select()
                ->where('tenant_ss = ?',$tenantss)
                );
            $tenant_family = $tenants_family->fetchAll(
                $tenants_family->select()
                ->where('tenant_ss = ?', $tenantss)
                );

            $this->view->tenant_info = $tenant_info;
            $this->view->tenant_auto = $tenant_autos;
            $this->view->tenant_family = $tenant_family;

        }
        else
        {
            $this->view->LoggedInView = "<a href=" . $this->view->baseURL() . "/account>Login | Register</a>";
            $this->view->NavbarExtra = "";
        }
    }
}
