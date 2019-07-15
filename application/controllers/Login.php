<?php
/*
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Backend del manejador de vistas de codeigniter, junto con las variables de sesion
*/
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Login extends CI_Controller{
	private $data;
	public function __construct(){
		parent::__construct();
		$this->data = array('view'=>'clientes');
	}
    public function index(){
        $this->load->view('index');
	}
	public function makeLogin(){
		$user = $this->input->get('user');
		$pass = do_hash($this->input->get('pass'));//agarra la contrase encriptada
		$sql = $this->db->where('(nombre="'.$user.'") AND contraseña="'.$pass.'"')->get('usuarios'); 
		$nivel = $this->db->select('nivel')->where('nombre',$user)->get('usuarios');
		if($sql->num_rows()==1){
			$user = $sql->result()[0]; //con esto accedo a toda la info de la consulta del usuarios 
			$_SESSION['data_user'] = $user;
			$_SESSION['nombre'] = $user->nombre;
			$_SESSION['idUsuario'] = $user->idUser;
			$response = 2;
		}else{	
			$response = 1;
		}
		/*echo '<pre>';
			var_dump($_SESSION);
			var_dump($this->data);
		echo '</pre>';*/
		$r['response'] = $response;
		echo json_encode($r);
	}
	
	public function registrar(){
		$this->load->view('principal',$this->data);

	}
	
	/*public function registro()	{ // siempre debe ir aqui 
		$this->load->view('registro');//el segundo paramento $this->data es que le paso paramentro a esa vista $this->data = array('view'=>'home');
	}*/
	
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