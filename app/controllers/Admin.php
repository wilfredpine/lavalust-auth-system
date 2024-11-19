<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Admin extends Controller {

	public function __construct()
    {
        parent::__construct();
        if (!is_logged_in())
            redirect('login');
        if(!is_admin())
            redirect();
    }

    public function index()
    {
        $this->call->view('admin_view');
    }

}