<?php
/**
 * Handles all the calls to the films section of the site.
 */
Class Login extends Controller {

    /**
     * Constructs the parent, and then instatiates the Film Model
     */
    public function __construct() {

        parent::__construct();

        $this->login_model = new Login_Model();

    }

    /**
     * default method called
     * @return string the rendered html.
     */
    public function index() {
        $this->view->render('login/index');
    }

    public function run() {

        $this->login_model->login();

        URL::redirect('films');

    }

    public function logout() {

        $this->login_model->logout();

        URL::redirect('films');

    }

}