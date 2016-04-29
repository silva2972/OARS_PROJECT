<?php

require_once 'Zend/Controller/Action.php';
require(dirname(__DIR__) . "/models/StaffAccountMapper.php");

class AssistantIntroController extends Zend_Controller_Action
{
    // login stuff
    protected $username;
    protected $isAssistant = false;

    public function init()
    {
        // Login stuff
        session_start();
        $this->_aM = new StaffAccountMapper();
        if ($this->_aM->LoggedIn()) {
            $this->isAssistant = ($_SESSION['user_type'] == 'Assistant');
            $this->username = $_SESSION['login_user'];
        } else {
            header("location: " . $this->view->baseURL() . "/staffaccount");
        }
    }

    public function indexAction()
    {
        // check for permissions...
        if (!$this->isAssistant) {
            header("location: " . $this->view->baseURL(). "/staffaccount");
        }
    }


}
