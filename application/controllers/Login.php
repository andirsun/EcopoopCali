<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $this->load->view('index');
        
	}

	public function makeLogin(){
		$user = $this->input->get('user');
		$pass = do_hash($this->input->get('pass'));
		$sql = $this->db->where('(nombre="'.$user.'") AND contraseña="'.$pass.'"')->get('usuarios'); // Solo inicia con el nombre
		if($sql->num_rows()==1){
			$user = $sql->result()[0];
			//$_SESSION['data_user'] = $user;
			//$_SESSION['sucursal'] = $user->idSucursal;
			$response = 2;
		}else{	
			$response = 1;
		}
		$r['response'] = $response;
		echo json_encode($r);
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
