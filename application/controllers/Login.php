<?php

class Login extends CI_Controller{
    function index(){
        $this->load->view('index');
        

    }
    public function verDatos(){
		echo '<pre>';
			var_dump($_GET);
		echo '</pre>';
	}
	public function logout(){
		session_destroy();
		redirect('login/index','refresh');
	}
}
