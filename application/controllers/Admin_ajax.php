<?php defined('BASEPATH') OR exit('No direct script access allowed');
//Generado desde el servidorr

class Admin_ajax extends CI_Controller {
	private $data;
	public function __construct(){
		parent::__construct();
		//$this->sucursal = $_SESSION['sucursal'];
		$this->data = array('view'=>'addUser');
	}
	public function index()	{
		$this->load->view('admin/index',$this->data);
	}
	public function addRequisito(){
		$array = array(
			'idRequisito' =>$this->input->get('idReq'),
			'version' =>$this->input->get('versionReq'),
			'tipo' =>$this->input->get('tipoReq'),
			'descripcion' =>$this->input->get('descripcionReq'),
			'dependencia' =>$this->input->get('dependenciaReq'),
			'interfaz' =>$this->input->get('interfazReq'),
			'importancia' =>$this->input->get('importanciaReq'),
			'prioridad' =>$this->input->get('prioridadReq'),
			'estado' =>"Activo",
		);
		$this->db->insert('requerimientos',$array);
		$id = $this->db->insert_id();
		if ($id!=0){
			
			//$a = array(
			//	'idRequisito' =>$this->input->get('idReq'),
			//	'idProyecto' =>$this->input->get('idProyecto'),
			//	'agregado' => date('Y-m-d H:i:s'), 
			//);
			$b['content'] = $id;
			$b['response'] = 2;
			echo json_encode($b);
		}
		else{
			$b['content'] = "Error al insertar el Requerimiento";
			$b['response'] = 1;
			echo json_encode($b);
		}

	}
	public function addRequisitoXproyecto(){
		$a = array(
				'idRequisito' =>$this->input->get('idRequisito'),
				'idProyecto' =>$this->input->get('idProyecto'),
				'agregado' => date('y-m-d H:i:s'),
				);
		$this->db->insert('requisitosxProyecto',$a);
		$b['content'] = "Vinculado correctamente";
		$b['response'] = 2;
		echo json_encode($b);

	}
	public function addUsuario(){
		$array = array(
			'nombre' =>$this->input->get('name'),
			'contraseña' =>do_hash($this->input->get('pass')),
			'nivel' =>2,
			'correo' =>$this->input->get('email'),
		);
		$this->db->insert('usuarios',$array);
		$id = $this->db->insert_id();
		if ($id!=0){
			/*
			$a = array(
				'idUsuario'=>$id,
				'idProyecto' =>$this->input->get('idProyecto'),
				'date' => date('Y-m-d H:i:s') 
			);
			$this->db->insert('usuariosxProyecto',$a);
			*/
			$b['content'] = "Usuario añadido con exito a usuarios y a usuariosProyecto";
			$b['response'] = 2;
			echo json_encode($b);
		}
		else{
			$b['content'] = "Error al insertar el usuario";
			$b['response'] = 1;
			echo json_encode($b);
		}

	}
	public function addProyecto(){
		$array = array(
			'nombre' =>$this->input->get('nombre'),
			'idProyecto' =>$this->input->get('idProyecto'),
			'creador' =>'Prueba',
			'descripcion' =>$this->input->get('descripcion'),
			'fechaCreacion' => date('Y-m-d H:i:s'), 
		);
		$this->db->insert('proyectos',$array);
		$id = $this->db->insert_id();
		if ($id!=0){
			$b['content'] = "Usuario añadido con exito";
			$b['response'] = 2;
			echo json_encode($b);
		}
		else{
			$b['content'] = "Error al insertar el usuario";
			$b['response'] = 1;
			echo json_encode($b);
		}

	}
	public function nombreProyecto(){
		$id=$this->input->get('id');
		$sql = $this->db->select('nombre')->where('id',$id)->get('proyectos');
		if($sql->num_rows()!=0 ){
			$b['content'] = $sql->result()[0];
			$b['response'] = 2;
		}else{
			$b['content'] = "No se encontro el proyecto";
			$b['response'] = 2;
		}
		
		echo json_encode($b);
		
	}
	public function getProyects(){ //Para llenar la tabla de los usuarios
		//$sql = $this->db/*->where('creador',$_SESSION['nombre'])*/->order_by('nombre asc')->get('proyectos'); //ordena pro orden alfabetico
		$sql = $this->db->get('proyectos');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getRequisitos(){ //Para llenar la tabla de los usuarios
		$idProyecto=$this->input->get('idProyect');
		$sql = $this->db->where('idProyecto',$idProyecto)->get('requisitosxProyecto');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getSucursales(){
		$sql = $this->db->get('sucursales');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getSucursalActive(){
		$sql = $this->db->where('id',$this->sucursal)->get('sucursales');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function changeSucursal(){
		$idSucursal = $this->input->get('idSucursal');
		//if($_SESSION['data_user']['level']==0)		{
			$_SESSION['sucursal'] = $idSucursal;
			$r['response'] = 2;
			$r['content'] = 'setted';
			echo json_encode($r);
		//}
	}
	public function getLevelCurrentUser(){
		$r['response'] = 2;
		$r['content'] = $_SESSION['data_user']->level;
		echo json_encode($r);
	}
}
