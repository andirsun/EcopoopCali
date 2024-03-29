<?php
/*
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Backend del manejador de vistas de codeigniter, junto con las variables de sesion
*/
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Admin extends CI_Controller {
	private $data;
	public function __construct(){
		parent::__construct();
		$this->data = array('view'=>'clientes');
		if(!isset($_SESSION['data_user'])){ //Proteccion de acceso por la url
			redirect('login','refresh');//envia a al controlador login , que por defecto va al metodo index y refrezca la pagina 
		}
		
		$this->data['level'] = $_SESSION['data_user']->nivel;
		/*echo '<pre>';
			var_dump($data);
		echo '</pre>';*/
		
	}
	public function index()	{ 
		$this->load->view('principal',$this->data);
	}
	
	public function nav(){ // para redirigir los apartados de proyectos etc
		$uri = $this->uri->segment(3);
		if($uri!=null){
			$this->data['view'] = $uri;
		}
		$method = '_'.$uri; // esto seria para que en la tercera particion de la url queda asi baseurl/1/2/_requisitosProyect/id y debe existir ese metodo digamos para usar el 4 segmento
		if(method_exists($this, $method)){
			$this->$method();
		}
		$this->load->view('principal',$this->data);
	}

	public function verDatos(){
		echo '<pre>';
			var_dump($_GET);
		echo '</pre>';
	}
	public function registro()	{ // siempre debe ir aqui 
		$this->load->view('registro');//el segundo paramento $this->data es que le paso paramentro a esa vista $this->data = array('view'=>'home');
	}
	public function _requisitosProyect(){
		$idProyect = $this->uri->segment(4);
		$this->data['idProyect'] = $idProyect;
		//$this->data['level'] = $_SESSION['data_user']->nivel;
	}
	public function _contribuidoresProyect(){
		$idProyect = $this->uri->segment(4);
		$this->data['idProyect'] = $idProyect;
	}
	public function _editarReq(){
		$idReq = $this->uri->segment(4);
		$this->data['idRequisito'] = $idReq;
	}
	public function _editarProyect(){
		$idProyect = $this->uri->segment(4);
		$this->data['idProyect'] = $idProyect;
	}

	
	
}
