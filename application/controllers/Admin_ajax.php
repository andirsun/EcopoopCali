<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Generado desde el servidorr
/*
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Backend De la aplicacion
*/
class Admin_ajax extends CI_Controller {
	private $data;
	public function __construct(){
		parent::__construct();
		//$this->sucursal = $_SESSION['sucursal'];
		
	}
	public function index()	{
		$this->load->view('admin/index',$this->data);
		
	}
	public function nombreSesion(){
		$b['content'] = $_SESSION['data_user']->nombre;
		$b['nivel'] = $_SESSION['data_user']->nivel;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function addEgresoEfectivo(){
		$r = array(
			'date'=> date('Y-m-d'),
			'value'=>$this->input->get('valorEgresoEfectivo'),
			'tipo'=>0,
			'description'=>$this->input->get('descripcionEgresoEfectivo'),
			//'idSucursal'=> $_SESSION['sucursal'],
			'category'=>$this->input->get('categoriaEgresoEfectivo'),
			'person'=>$this->input->get("responsableEgresoEfectivo")
		);
		$this->db->insert('egresos',$r);
		$ultimoid = $this->db->insert_id();
		//$this->mainModel->addLog('Egreso Efectivo Añadido','',$ultimoid);
		$sql = $this->db->where('id',$ultimoid)->get('egresos')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function getEgresosEfectivo(){
		
		$sql = $this->db->select('id,date,tipo,category,person,value,description')->where('tipo',0)/*->where('idSucursal',$_SESSION['sucursal'])*/->get('egresos'); //0 para medio pago efectivo 1 para medio pago banco 
		$r['response'] = 2;	
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function enviarDiagrama1(){
		$id = $this->input->post('idEgreso');
		$file = file_get_contents($_FILES['file']['tmp_name']);
		$this->db->set('bill',$file)->set('date',date('Y-m-d'))->update('egresos');
		$r['response'] = 2;
		$r['content'] = 'saved';
		$r['id'] = $id;
		echo json_encode($r);
	}
	public function getDiagrama1(){
		$id = $this->input->get('idRequisito');
		//$sql = $this->db->where('idRequisito',$id)->get('requerimientos');
		$sql = $this->db->where('id',$id)->get('egresos');
		$r['response'] = 2;
		if($sql->num_rows()==0){
			$r['file'] = null;
			$r['id'] = $id;
		}else{
			$r['file'] = base64_encode($sql->result()[0]->bill);
			$r['id'] = $id;
		}
		echo json_encode($r);
	}
	public function flujoDeCajaEfectivo(){
		$egresos=$this->db->select('sum(value) as egresos')->get('egresos')->result()[0]->egresos;
		$r['response'] = 2;
		$r['content'] = $egresos;
		echo json_encode($r);
	}
	public function deleteEgreso(){
		$id = $this->input->get('id');
		$this->db->where('id',$id)->delete('egresos');
		//$this->mainModel->addLog('Egreso Borrado','',$id);
		$r['response'] = 2;
		$r['content'] = 'Egreso Borrado ';
		echo json_encode($r);
	}
	public function calcularDineroEgresos(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select_sum('value');
		$this->db->from('egresos');
		$this->db->where('egresos.date >=',$fechaInicio);
		$this->db->where('egresos.date <=',$fechaFin);
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function filtrarEgresosEfectivo(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$sql = $this->db->where('date >=',$fechaInicio.' 00:00:00')->where('date <=',$fechaFin.' 23:59:59')->get('egresos')->result(); 
		/*echo '<pre>';
			var_dump($sql);
		echo '</pre>';*/
		$r['response'] = 2;	
		$r['content'] = $sql;
		echo json_encode($r);
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
	public function borrarRequisitoFuncional(){
		$id=$this->input->get('id');
		$this->db->where('id',$id)->delete('requerimientos');
		$b['content'] = "Borrado";
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function editarRequisitosFuncionales(){
		$id=$this->input->get('id');
		$sql = $this->db->select("requerimientos.id,requerimientos.idRequisito,requerimientos.descripcion,requerimientos.dependencia,requerimientos.version,requerimientos.estado")->where('requerimientos.id',$id)->get('requerimientos');
		$b['content'] = $sql->result()[0];
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function updateRequisito(){
		$id=$this->input->get('editIdRequisito');
		$a = array(
			'descripcion' => $this->input->get('editDescripcionRequisito'),
			'dependencia' => $this->input->get('editDependenciaRequisito'), // int 
			'version' => $this->input->get('editVersionRequisito'), // string: yyyy-mm-dd
			'estado' => $this->input->get('editEstadoRequisito') // string: yyyy-mm-dd
		);
		$this->db->where('id',$id)->update('requerimientos',$a);
		$b['content'] = "Actualizado con exito";
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function contribuidoresPorProyecto(){
		$id=$this->input->get('id');
		$sql = $this->db->select('usuarios.*,usuariosxProyecto.*')->where('usuariosxProyecto.idProyecto',$id)->where('usuarios.nivel',2)->join('usuarios','usuarios.idUser = usuariosxProyecto.idUsuario')->get('usuariosxProyecto');
		if($sql->num_rows()!=0 ){
			$b['content'] = $sql->result();
			$b['response'] = 2;
		}else{
			$b['content'] = "No Hay Usuarios Vinculados Con este Proyecto";
			$b['response'] = 1;
		}
		
		echo json_encode($b);
	}
	public function asociarContribuidor(){
		$nombreUsuario=$this->input->get('nombre');
		$sql = $this->db->select('idUser')->where('nombre',$nombreUsuario)->get('usuarios');//Conpruebo si existe el usuario para agregarlo
		if($sql->num_rows()!=0 ){
			$r = array(
				'idProyecto'=>$this->input->get('id'),
				'idUsuario'=>$sql->result()[0]->idUser,
				'date' =>date('y-m-d')
			);
			$this->db->insert('usuariosxProyecto',$r);
			$b['content'] = "Usuario Encontrado y vinculado con exito";
			$b['response'] = 2;
			$b['array'] = $r;
		}else{
			$b['content'] = "No se Encontro El usuario";
			$b['response'] = 1;
		}
		echo json_encode($b);
	}	
	public function borrarContribuidor(){
		$idContribuidor = $this->input->get('id');
		$idProyecto = $this->input->get('idProyecto');
		$this->db->where('idUsuario',$idContribuidor)->where('idProyecto',$idProyecto)->delete('usuariosxProyecto');
		$b['content'] = "Usuario Desvinculado Del Proyecto";
		$b['response'] = 2;
		echo json_encode($b);
	
	}
	public function borrarProyecto(){

		$id = $this->input->get('id');
		if($_SESSION['data_user']->nivel ==1){
			$this->db->where('id',$id)->delete('proyectos');
			$b['content'] = "Proyecto Eliminado";
			$b['response'] = 2;
		}
		else{
			$b['content'] = "No Tienes Persmisos Para Borrar Proyectos";
			$b['response'] = 1;
		}
		
		echo json_encode($b);

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
	public function getProyectsssss(){ 
		//$sql = $this->db/*->where('creador',$_SESSION['nombre'])*/->order_by('nombre asc')->get('proyectos'); //ordena pro orden alfabetico
		if ( ($_SESSION['data_user']->nivel) ==1){
			$sql = $this->db->get('proyectos');
		}
		else{
			$sql = $this->db->select('proyectos.*,usuariosxProyecto.idProyecto idddd,usuariosxProyecto.idUsuario')->where("usuariosxProyecto.idUsuario",$_SESSION['data_user']->idUser)->join('usuariosxProyecto','usuariosxProyecto.idProyecto = proyectos.id')->get('proyectos');
		}
		$r['response'] = 2;
		$r['content'] = $sql->result();
		$r['idUsuario'] = $_SESSION['data_user']->idUser;
		echo json_encode($r);
	}
	public function getRequisitosFuncionales(){ //Para llenar la tabla de losRequisitos 
		$idProyecto=$this->input->get('id');
		$sql = $this->db->select('requisitosxProyecto.idRequisito,requerimientos.idRequisito reqId,agregado,descripcion,version,interfaz,dependencia,estado,requisitosxProyecto.*')->where('idProyecto',$idProyecto)->where('tipo',"funcional")->join('requerimientos','requerimientos.id = requisitosxProyecto.idRequisito')->get('requisitosxProyecto');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		$r['idRequisito'] = $idProyecto;
		echo json_encode($r);
	}
	public function getRequisitosNoFuncionales(){ //Para llenar la tabla de los Requisitos
		$idProyecto=$this->input->get('id');
		$sql = $this->db->select('requerimientos.*,requisitosxProyecto.*')->where('idProyecto',$idProyecto)->where('tipo',"Nofuncional")->join('requerimientos','requerimientos.id = requisitosxProyecto.idRequisito')->get('requisitosxProyecto');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		$r['idRequisito'] = $idProyecto;
		echo json_encode($r);
	}
	public function getRequisitosRestriccion(){ //Para llenar la tabla de los Requisitos
		$idProyecto=$this->input->get('id');
		$sql = $this->db->select('requerimientos.*,requisitosxProyecto.*')->where('idProyecto',$idProyecto)->where('tipo',"restriccion")->join('requerimientos','requerimientos.id = requisitosxProyecto.idRequisito')->get('requisitosxProyecto');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		$r['idRequisito'] = $idProyecto;
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
