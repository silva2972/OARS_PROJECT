<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/TenantAccountMapper.php");
class TenantIntroController extends Zend_Controller_Action
{

    
    public function indexAction()
    {
        session_start();
        $this->_aM = new TenantAccountMapper();

        $loggedIn = $this->_aM->LoggedIn();

        //If not logged in we can't view this page
        if (!$loggedIn)
        {
            header("location: " . $this->view->baseURL() . "/index");
            exit();
        }

        if ($loggedIn)
        {
            $name = $this->_aM->Name();
            $this->view->LoggedInView = "Welcome " . $name . " | <a href=" . $this->view->baseURL() . "/tenantaccount/logout>Logout</a>";
            $this->view->role = $_SESSION['user_type'];
            
        }
        else
        {
            $this->view->LoggedInView = "<a href=" . $this->view->baseURL() . "/account>Login | Register</a>";
            $this->view->NavbarExtra = "";
        }
    }
}
