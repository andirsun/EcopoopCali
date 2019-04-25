<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ajax extends CI_Controller {
	private $data;
	public function __construct(){
		parent::__construct();
		$this->sucursal = $_SESSION['sucursal'];
		$this->data = array('view'=>'addUser');
	}
	public function index()	{
		$this->load->view('admin/index',$this->data);
	}
	public function addUser(){
		$id = $this->input->get('id');
		$r = array(
			'name' => $this->input->get('name'),
			//'idHuellero' => $this->input->get('idHuellero'),
			'type_document' => $this->input->get('type_document'), //int -  0 Ti, 1: cedula, 
			'document' => $this->input->get('document'), // int 
			'birthday' => $this->input->get('birthday'), // string: yyyy-mm-dd
			'date' => date('Y-m-d H:i:s'), // string: yyyy-mm-dd
			'observaciones' => $this->input->get('observaciones'),
			'level' => $this->input->get('level'), // 0: admin, 1: secretario, 2: profesor, 3:alumno,
			'email' => $this->input->get('email'), //
			'tel' => $this->input->get('tel'), //
			'password' => do_hash($this->input->get('password')),
			);
		if($id==0){
			$this->db->insert('users',$r);
			$id = $this->db->insert_id();
			//$this->mainModel->addLog('userCreated','',$id);
		}else{
			$this->db->where('id',$id)->update('users',$r);
			//$this->mainModel->addLog('userEdited','',$id);
		}
		$sql = $this->db->where('id',$id)->get('users')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function addClassUser(){
		$idUser = $this->input->get('idUser');
		$idClassHead = $this->input->get('idClassHead');
		$nHours = $this->input->get('nHours');
		$dateStart = $this->input->get('dateStart');
		$idInstrument = $this->input->get('idInstrument');
		$instrument = $this->db->where('id',$this->input->get('idInstrument'))->get('instrumentos')->result()[0];
		$hoursRest = $this->mainModel->horasRestantesEstudiante($idUser,$idInstrument);
		$checkClass = $this->db->select('id')->where('idStudent',$idUser)->where('idClassHead',$idClassHead)->get('relStudentClassHead');
		$nAlumns = $this->db->select('COUNT(id) AS n')->where('idClassHead',$idClassHead)->get('relStudentClassHead')->result()[0]->n;
		if($checkClass->num_rows()==0){
			$classHead = $this->db->where('id',$idClassHead)->get('clasesHead');
			if($classHead->num_rows()>0){

				$classHead = $classHead->result()[0];
				if($classHead->private==0){
					if($nAlumns < $instrument->cupos ){
						if($hoursRest >= $nHours){
							// $a = array(
							// 	'idStudent' => $idUser,
							// 	'idClassHead' => $idClassHead,
							// 	'nHours' => $nHours,
							// 	'dateStart' => $dateStart,
							// 	'idInstrument' => $idInstrument
							// );
							// $this->db->insert('clases',$a);
							
							$a = array(
								'idStudent' => $idUser,
								'idClassHead' => $idClassHead,
								'dateStart' => $dateStart.' '.$this->input->get('time'),
								'nHours' => $nHours,
								'nDay' => $this->input->get('nDay'),
								'type' => $this->input->get('type'),
							);

							$this->db->insert('relStudentClassHead',$a);

							$id = $this->db->insert_id();
							// $sql = $this->db->where('id',$id)->get('clases');
							$this->mainModel->addLog('classStudenAdded','',$id);

							$r['response'] = 2;
							$r['content'] = 'added';
						}else{
							$r['response'] = 1;
							$r['content'] = 'exceededHours';
						}
					}else{
						$r['response'] = 1;
						$r['content'] = 'alumnsExceded';

					}
				}else{
					$r['response'] = 1;
					$r['content'] = 'classPrivate';
				}

			}else{
				$r['response'] = 1;
				$r['content'] = 'classNotExist';
			}

		}else{
			$r['response'] = 1;
			$r['content'] = 'classRegistered';	
		}
		echo json_encode($r);
	}
	public function addHeadClass(){
		$idInstrument = $this->input->get('idInstrument');
		$nHours = $this->input->get('nHours');
		$date = $this->input->get('date');
		$a = array(
			'idInstrument' => $idInstrument,
			'dateStart' => $date,
			'hours' => $nHours,
			'nDay' => $this->input->get('dayWeek'),
			'idSucursal' => 1,
			'time' => $this->input->get('time')
		);
		$this->db->insert('clasesHead',$a);
		$id = $this->db->insert_id();
		$this->mainModel->addLog('classHeadCreated','',$id);
		$sql = $this->db->where('id',$id)->get('clasesHead');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function addEgresoEfectivo(){
		$r = array(
			'fecha'=> date('y-m-d H:i:s'),
			'valor'=>$this->input->get('valorEgresoEfectivo'),
			'medioPago'=>0,
			'concepto'=>$this->input->get('descripcionEgresoEfectivo'),
			'idSucursal'=> $_SESSION['sucursal'],
			'tipo'=>$this->input->get('conceptoEgresoEfectivo')
		);
		$this->db->insert('egresos',$r);
		$ultimoid = $this->db->insert_id();
		$this->mainModel->addLog('Egreso Efectivo Añadido','',$ultimoid);
		$sql = $this->db->where('id',$ultimoid)->get('egresos')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function addEgresoBanco(){
		$r = array(
			'fecha'=> date('y-m-d H:i:s'),
			'valor'=>$this->input->get('valorEgresoBanco'),
			'medioPago'=>1,
			'concepto'=>$this->input->get('descripcionEgresoBanco'),
			'idSucursal'=> $_SESSION['sucursal'],
			'tipo'=>$this->input->get('conceptoEgresoBanco')
		);
		$this->db->insert('egresos',$r);
		$ultimoid = $this->db->insert_id();
		$this->mainModel->addLog('Egreso Banco Añadido','',$ultimoid);
		$sql = $this->db->where('id',$ultimoid)->get('egresos')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function addHoursToInstrumentStudent(){
		$idUser = $this->input->get('idUser');
		$idInstrument = $this->input->get('idInstrument');
		$check = $this->mainModel->checkInstrumentStudent($idUser, $idInstrument);
		$hoursRest = $this->mainModel->horasRestantesEstudiante($idUser,$idInstrument);
		if($check){
			$nHours = $this->input->get('nHours');
			$price = $this->input->get('price');
			$totalHours = $nHours + $hoursRest;
			$a = array(
				'idStudent' => $idUser,
				'idInstrument' => $idInstrument,
				'hours' => $nHours,
				'price' => $price,
				'date' => date('y-m-d H:i:s'),
				'bono' => $this->input->get('bono'),
				'medioPago' => $this->input->get('medioPago'),
				'tipoDescuento' => $this->input->get('medioPago'),
				'hoursRest' => $hoursRest,
				'idSucursal' => $this->sucursal,
				'nRecibo' => $this->input->get('nRecibo'),
				'conceptoIngreso'=>$this->input->get('conceptoPaquete'),
				'totalHours' => $totalHours
			);
			$this->db->insert('clasesBuys',$a);
			$id = $this->db->insert_id();
			$this->mainModel->addLog('hourAddedToInstrumentStuden','',$id);
			$sql = $this->db->where('id',$id)->get('clasesBuys');
			$r['response'] = 2;
			$r['content'] = $sql->result()[0];
		}else{
			$r['response'] = 1;
			$r['content'] = 'userHaveNotInstrument';
		}
		echo json_encode($r);
	}
	public function addInstrumentToUser(){
		$idUser = intval($this->input->get('idUser'));
		$idInstrument = intval($this->input->get('idInstrument'));

		if($idUser > 0 && $idInstrument > 0){
			$check = $this->mainModel->checkInstrumentStudent($idUser, $idInstrument);
			if(!$check){
				$a = array('idUser'=>$idUser,'idInstrument'=>$idInstrument);
				$this->db->insert('userRelInstrument',$a);
				$id = $this->db->insert_id();
				$this->mainModel->addLog('instrumentAddedToUser',$idInstrument,$id);
				$sql = $this->db->where('id',$id)->get('userRelInstrument');
				$r['response'] = 2;
				$r['content'] = $sql->result()[0];
			}else{
				$r['response'] = 1;
				$r['content'] = 'relationExisted';
			}
		}else{
			$r['response'] = 1;
			$r['content'] = 'dataError';
		}

		echo json_encode($r);
	}
	public function addTeacherToClass(){
		$idClassHead = $this->input->get('idClassHead');


		$idTeacher = $this->input->get('idTeacher');
		$idClassHead = $this->input->get('idClassHead');
		$idInstrument = $this->db->where('id',$idClassHead)->get('clasesHead')->result()[0]->idInstrument;
		$idUser = $this->input->get('idStudent');
		$val = $this->input->get('val');
		$currentDate = $this->input->get('currentDate');
		$class = $this->db->where('idClassHead',$idClassHead)->where('idStudent',$idUser)->get('relStudentClassHead');
		if($class->num_rows()>0){
			$checkClass = $this->db->where('idClassHead',$idClassHead)->where('idStudent',$idUser)->where('dateClass',$currentDate)->get('clases');
			if($checkClass->num_rows()>0){
				$this->db->where('id',$checkClass->result()[0]->id)->update('clases',array('idTeacher'=>$idTeacher));
				$r['response'] = 2;
				$r['content'] = 'saved';
			}else{
				$a = array(
					'idClassHead'=> $idClassHead,
					'idStudent' => $idUser,
					'idTeacher' => $idTeacher,
					'idInstrument' => $idInstrument,
					'date' => date('Y-m-d H:i:s'),
					'dateClass' => $currentDate
				);
				$this->db->insert('clases',$a);
				$r['response'] = 1;
				$r['content'] = 'saved';
			}
		}else{
			$r['response'] = 1;
			$r['content'] = 'classNotFound';
		}
		echo json_encode($r);			
	}
	public function addIngreso(){
		$r = array(
			'date'=> date('y-m-d H:i:s'),
			'price'=>$this->input->get('valor'),
			'medioPago'=>0,
			'conceptoIngreso'=>$this->input->get('concepto'),
			'idSucursal'=> $_SESSION['sucursal']
		);
		$this->db->insert('clasesBuys',$r);
		$ultimoid = $this->db->insert_id();
		$this->mainModel->addLog('Ingreso Añadido','',$ultimoid);
		$sql = $this->db->where('id',$ultimoid)->get('clasesBuys')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function statusClass(){
		$idClassHead = $this->input->get('idClassHead');
		$idInstrument = $this->db->where('id',$idClassHead)->get('clasesHead')->result()[0]->idInstrument;
		$idUser = $this->input->get('idStudent');
		$val = $this->input->get('val');
		$currentDate = $this->input->get('currentDate');
		$class = $this->db->where('idClassHead',$idClassHead)->where('idStudent',$idUser)->get('relStudentClassHead');
		if($class->num_rows()>0){
			$checkClass = $this->db->select('id, status')->where('idClassHead',$idClassHead)->where('idStudent',$idUser)->where('dateClass',$currentDate)->get('clases');
			if($checkClass->num_rows()==0){
				$a = array(
					'idClassHead'=> $idClassHead,
					'idStudent' => $idUser,
					'status' => $val,
					'idInstrument' => $idInstrument,
					'date' => date('Y-m-d H:i:s'),
					'dateClass' => $currentDate
				);
				$this->db->insert('clases',$a);
				$r['response'] = 2;
				$r['content'] = 'saved';
			}else{
				if($checkClass->result()[0]->status==0){
					$r['response'] = 2;
					$r['content'] = 'saved';
					$this->db->where('id',$checkClass->result()[0]->id)->update('clases',array('status'=>$val));
				}else{
					$r['response'] = 1;
					$r['content'] = 'laClaseYaFueActuliazada';
				}
			}
		}else{
			$r['response'] = 1;
			$r['content'] = 'classNotFound';
		}
		echo json_encode($r);
	}
	
	public function sendTeacher(){
		$id = $this->input->get('id');
		$a = array(
			'name' => $this->input->get('name'),
			'type_document' => 1, //int -  0 Ti, 1: cedula, 
			'document' => $this->input->get('document'), // int 
			'birthday' => $this->input->get('birthday'), // string: yyyy-mm-dd
			'date' => date('Y-m-d H:i:s'), // string: yyyy-mm-dd
			'level' => 2, // 0: admin, 1: secretario, 2: profesor, 3:alumno,
			'email' => $this->input->get('email'), //
			'tel' => $this->input->get('tel'),
			'password' => do_hash($this->input->get('password')),
			'idSucursal'=> $_SESSION['sucursal']
		);
		if($id==0){
			$this->db->insert('users',$a);
			$id = $this->db->insert_id();
			$this->mainModel->addLog('Teacher Created','',$id);
		}else{
			$this->db->where('id',$id)->update('users',$a);
			$this->mainModel->addLog('Teacher Edited','',$id);
		}
		$sql = $this->db->where('id',$id)->get('users')->result();
		$b['content'] = $sql;
		$b['response'] = 2;
		echo json_encode($b);
	}
	public function autenticar(){
		$user= $this->input->get('user');
		$pass = $this->input->get('pass');
		$sql = $this->db->where('name',$user)->where('password',$pass)->get('users');
		if($sql->num_rows()==0){
			$r['response'] = 2;
			$r['content'] = 'userNotExist';
		}else{
			$r['response'] = 1;
			$r['content'] = 'userExist';
		}
		echo json_encode($r);
	}
	public function checkData(){
		echo '<pre>';
			var_dump($_GET);
		echo '</pre>';
	}
	public function deleteClassStudent(){
		// echo '<pre>';
		// 	var_dump($_GET);
		// echo '</pre>';
		$this->db
		->where('idStudent',$this->input->get('idUser'))
		->where('idClassHead',$this->input->get('idClassHead'))
		->update('relStudentClassHead',array('status'=>1));
		$r['response'] = 2;
		$r['content'] = 'deleted';
		echo json_encode($r);
	}
	public function checkDocument(){
		$doc = $this->input->get('doc');
		$type = $this->input->get('type');
		$sql = $this->db->where('type_document',$type)->where('document',$doc)->get('users');
		if($sql->num_rows()==0){
			$r['response'] = 2;
			$r['content'] = 'userNotExist';
		}else{
			$r['response'] = 1;
			$r['content'] = 'userExist';
		}
		echo json_encode($r);
	}
	public function calcularDineroIngresos(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select_sum('price');
		$this->db->from('clasesBuys cb');
		$this->db->where('medioPago',0);
		$this->db->where('cb.date >=',$fechaInicio.' 00:00:00');
		$this->db->where('cb.date <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		//$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function calcularDineroEgresos(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select_sum('valor');
		$this->db->from('egresos');
		$this->db->where('medioPago',0);
		$this->db->where('egresos.fecha >=',$fechaInicio.' 00:00:00');
		$this->db->where('egresos.fecha <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		//$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function calcularDineroEgresosBanco(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select_sum('valor');
		$this->db->from('egresos');
		$this->db->where('medioPago',1);
		$this->db->where('egresos.fecha >=',$fechaInicio.' 00:00:00');
		$this->db->where('egresos.fecha <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		//$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function calcularDineroIngresosBanco(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select_sum('price');
		$this->db->from('clasesBuys cb');
		$this->db->where('medioPago',1);
		$this->db->where('cb.date >=',$fechaInicio.' 00:00:00');
		$this->db->where('cb.date <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		//$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function deleteInstrument(){
		$id = $this->input->get('id');
		$sql2 = $this->db->where('idInstrument',$id)->delete('userRelInstrument');
		$sql = $this->db->where('id',$id)->delete('instrumentos');
		$sql2 = $this->db->where('idInstrument',$id)->delete('userRelInstrument');
		$this->mainModel->addLog('insturmentDeleted','',$id);
		$r['response'] = 2;
		$r['content'] = 'deleted';
		echo json_encode($r);
	}
	public function deleteUser(){
		$id = $this->input->get('id');
		$sql = $this->db->where('idUser',$id)->delete('userRelInstrument');
		$sql = $this->db->where('idUser',$id)->delete('directorios');
		$sql = $this->db->where('id',$id)->delete('users');
		$r['response'] = 2;
		$r['content'] = 'deleted';
		echo json_encode($r);
	}
	public function editUser(){
		$id = $this->input->get('id');
		$a = array(
			'name' => $this->input->get('name'),
			'idHuellero' => $this->input->get('idHuellero'),
			'type_document' => $this->input->get('type_document'), //int -  0 Ti, 1: cedula, 
			'document' => $this->input->get('document'), // int 
			'birthday' => $this->input->get('birthday'), // string: yyyy-mm-dd
			'observaciones' => $this->input->get('observaciones'),
			'password' => do_hash($this->input->get('password')),
			);

		$this->db->where('id',$id); //inserto el usuaruo en la tabla
		$this->db->update('users',$a);
		$r['response'] = 2;
		$r['content'] = 'Actualizado';
	}
	public function editInfoUser(){
		// $r = array(
		// 	'name' => $this->input->get('name'),
		// 	'type_document' => $this->input->get('type_document'), //int -  0 Ti, 1: cedula, 
		// 	'document' => $this->input->get('document'), // int 
		// 	'birthday' => $this->input->get('birthday'), // string: yyyy-mm-dd
		// 	'date' => date('Y-m-d H:i:s'), // string: yyyy-mm-dd
		// 	'observaciones' => $this->input->get('observaciones'),
		// 	'level' => $this->input->get('level'), // 0: admin, 1: secretario, 2: profesor, 3:alumno,
		// 	'email' => $this->input->get('email'), //
		// 	'tel' => $this->input->get('tel'), //
		// 	'password' => do_hash($this->input->get('password')),
		// 	'tel2'=> $this->input->get('tel2'), // para el telefono 2 
		// 	//'address'=> $this->input->get('address'), 
		// 	'nombreAcudiente' => $this->input->get('nombreAcudiente'), //
		// 	// 'nClases'=> $this->input->get('nClases'), // para el numero de clases
		// 	'numeroInscripcion'=> $this->input->get('numeroInscripcion'),
		// 	'direccion'=> $this->input->get('direccion')
		// 	);
		// $name = $this->input->get('nameEdit');
		// $name = $this->input->get('nameEdit');
		// $name = $this->input->get('nameEdit');
		// $name = $this->input->get('nameEdit');
		// $name = $this->input->get('nameEdit');
		echo '<pre>';
			var_dump($_GET);
		echo '</pre>';
	}
	public function formClassUser(){
		$idUser = $this->input->get('idUser');
		$this->data['idUser'] = $idUser;
		$this->load->view('admin/clasesStudent', $this->data,FALSE);
	}
	public function filtrarIngresosEfectivo(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select('cb.*,i.name,es.name nombre');
		$this->db->from('clasesBuys cb');
		$this->db->join('instrumentos i','cb.idInstrument = i.id' );
		$this->db->join('users es','cb.idStudent = es.id' );
		$this->db->where('medioPago',0);
		$this->db->where('cb.date >=',$fechaInicio.' 00:00:00');
		$this->db->where('cb.date <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function filtrarIngresosBanco(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$this->db->select('cb.*,i.name,es.name nombre');
		$this->db->from('clasesBuys cb');
		$this->db->join('instrumentos i','cb.idInstrument = i.id' );
		$this->db->join('users es','cb.idStudent = es.id' );
		$this->db->where('medioPago',1);
		$this->db->where('cb.date >=',$fechaInicio.' 00:00:00');
		$this->db->where('cb.date <=',$fechaFin.' 23:59:59');
		////falta el where para que hale los datos de la sucursal de quien esta en la sesion
		$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function filtrarEgresosEfectivo(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$sql = $this->db->where('medioPago',0)->where('fecha >=',$fechaInicio.' 00:00:00')->where('fecha <=',$fechaFin.' 23:59:59')->get('egresos'); //0 para medio pago efectivo 1 para medio pago banco 
		$r['response'] = 2;	
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function filtrarEgresosBanco(){
		$fechaInicio= $this->input->get('fechaInicio');
		$fechaFin= $this->input->get('fechaFin');
		$sql = $this->db->where('medioPago',1)->where('fecha >=',$fechaInicio.' 00:00:00')->where('fecha <=',$fechaFin.' 23:59:59')->get('egresos'); //0 para medio pago efectivo 1 para medio pago banco 
		$r['response'] = 2;	
		$r['content'] = $sql->result();
		echo json_encode($r);	
	}
	public function getClassAvailableStudent(){
		$sql = $this->db->where('idInstrument',$this->input->get('idInstrument'))->order_by('nDay asc, time asc')->get('clasesHead');
		$instrument = $this->db->where('id',$this->input->get('idInstrument'))->get('instrumentos')->result()[0];
		$data = array();
		foreach ($sql->result() as $key => $c) {
			$idStudent = $this->db->where('idStudent',$this->input->get('idUser'))->where('status',0)->where('idClassHead',$c->id)->get('relStudentClassHead')->num_rows() == 0 ? null : $this->input->get('idUser');
			//$this->db->where('idStudent',$this->input->get('idUser'))->where('idClassHead',$c->id)/*->join('clasesHead','clasesHead.id = relStudentClassHead.idClassHead')*/->get('relStudentClassHead')->num_rows() == 0 ? null : $this->input->get('idUser');

			// echo '<pre>';
			// 	var_dump($c->id);
			// echo '</pre>';
			$c->idStudent = $idStudent;
			//No borrar ni por el putas, info requerida en el front
			$nAlumns = $this->db->select('COUNT(id) AS n')->where('status',0)->where('idClassHead',$c->id)->get('relStudentClassHead')->result()[0]->n;
			$data[] = array('dataClass'=>$c,'studentsInscribed'=>$nAlumns);
		}
		$r['response'] = 2;
		$r['content'] = $data;
		$r['instrument'] = $instrument;
		echo json_encode($r);
	}
	public function getIngresosEfectivo(){
		$this->db->select('cb.*,i.name,es.name nombre,es.idSucursal');
		$this->db->from('clasesBuys cb');
		$this->db->join('instrumentos i','i.id=cb.idInstrument', 'left outer');
		$this->db->join('users es','es.id=cb.idStudent', 'left outer');
		$this->db->where('medioPago',0);
		$this->db->where('cb.idSucursal',$_SESSION['sucursal']);
		$this->db->order_by('date desc');
		$sql=$this->db->get();
		//$sql = $this->db->where('medioPago',0)->get('clasesBuys'); 
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getIngresosBanco(){
		$this->db->select('cb.*,i.name,es.name nombre,es.idSucursal');
		$this->db->from('clasesBuys cb');
		$this->db->join('instrumentos i','cb.idInstrument = i.id' );
		$this->db->join('users es','cb.idStudent = es.id' );
		$this->db->where('medioPago',1);
		$this->db->where('es.idSucursal',$_SESSION['sucursal']);
		$this->db->order_by('date desc');
		$sql=$this->db->get();
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getEgresosEfectivo(){
		$sql = $this->db->where('medioPago',0)->get('egresos'); //0 para medio pago efectivo 1 para medio pago banco 
		$r['response'] = 2;	
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getEgresosBancos(){
		$sql = $this->db->where('medioPago',1)->get('egresos'); 
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getHeadClassInstrumentHour(){
		$time = $this->input->get('time');
		$nDay = $this->input->get('nDay');
		$sql = $this->db->where('time',$time)->where('nDay',$nDay)->get('clasesHead');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getInstruments(){
		if(isset($_GET['id'])){
			$this->db->where('id',$_GET['id']);
		}
		$sql = $this->db->where('idSucursal',$_SESSION['sucursal'])->get('instrumentos');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getInstrumentsStudent(){
		$idUser = $this->input->get('idUser');
		$sql = $this->db->select('A.*')->join('instrumentos A','A.id=B.idInstrument')->where('B.idUser',$idUser)->get('userRelInstrument B');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getInstrumentPackageStudent(){
		$idUser = $this->input->get('idUser');
		$idInstrument = $this->input->get('idInstrument');
		$sql = $this->db->where('idStudent',$idUser)->where('idInstrument',$idInstrument)->get('clasesBuys');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getInsturmentById(){
		$id = $this->db->where('id',$id)->get('instrumentos');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getHoursResidual(){
		$idUser = $this->input->get('idUser');
		$idInstrument = $this->input->get('idInstrument');
		$nHours = $this->mainModel->horasRestantesEstudiante($idUser, $idInstrument);
		$r['response'] = 2;
		$r['content'] = $nHours;
		echo json_encode($r);
	}
	public function getClassWeek(){
		$f = $this->input->get('dateStart');
		$data = array();
		$b = 1;
		for($i=0; $i<7;$i++){

			$date = $f;
			$stro = strtotime($date. '+'.$i.' days');
			$date = date('Y-m-d',$stro);
			$start = $date.' 00:00:00';
			$end = $date.' 23:59:59';
			$sqlRecurrent = $this->db->where('clasesHead.nDay',$b)->where('A.type',0)->where('idSucursal',$_SESSION['sucursal'])->where('A.status',0)->join('relStudentClassHead A','A.idClassHead=clasesHead.id')->get('clasesHead');
			$sqlUnique = $this->db->where('A.dateStart >',$start)->where('A.dateStart <',$end)->where('A.type >',0)->join('relStudentClassHead A','A.idClassHead=clasesHead.id')->get('clasesHead');
			$data[$date] = array('regular'=>$sqlRecurrent->result(),'single'=> $sqlUnique->result());
			$b++;
		}
		$r['response'] = 2;
		$r['content'] = $data;
		echo json_encode($r);
		// echo '<pre>';
		// 	var_dump($stro);
		// 	var_dump($date);
		// echo '</pre>';
	}
	public function getSoonClassStudentInstrument(){
		$idUser = $this->input->get('idUser');
		$idInstrument = $this->input->get('idInstrument');
		$date = date('Y-m-d').' 00:00:00';
		$sql = $this->db->select('A.*, A.id AS idClassStudentRel')->where('A.idStudent',$idUser)->join('clasesHead C','C.id=A.idClassHead')->where('C.idInstrument',$idInstrument)->where('A.status',0)->get('relStudentClassHead A');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getListStudentClass(){
		// echo '<pre>';
		// 	var_dump($_GET);
		// echo '</pre>';
		$idClassHead = $this->input->get('idClassHead');
		$sql = $this->db->select('U.name as nameStudent, U.id as idStudent, C.*, c.id as idClass')->join('relStudentClassHead c','c.idClassHead=C.id')->join('users U','U.id=c.idStudent')->where('C.id',$idClassHead)->get('clasesHead C');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		$r['data'] = $_GET;
		echo json_encode($r);
	}
	public function getUsers(){ //Para llenar la tabla de los usuarios
		$sql = $this->db->where('level',3)->where('idSucursal',$_SESSION['sucursal'])->order_by('name asc')->get('users'); //ordena pro orden alfabetico
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getTeachers(){ //Para llenar la tabla de los usuarios
		$sql = $this->db->where('level',2)->where('idSucursal',$_SESSION['sucursal'])->order_by('name asc')->get('users'); //ordena pro orden alfabetico
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getUserById(){
		$id = $this->input->get('idseleccion');
		$sql = $this->db->where('id',$id)->where('idSucursal',$_SESSION['sucursal'])->get('users');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getUserByIdDirectory(){
		$id = $this->input->get('idseleccion');
		$sql = $this->db->where('idUser',$id)->where('idSucursal',$_SESSION['sucursal'])->get('directorios');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getUsersDirectory(){
		$sql = $this->db->where('level',3)->where('idSucursal',$_SESSION['sucursal'])->get('users');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function getUserLevel(){
		$level = $this->input->get('level');
		if($level!=null){
			$this->db->where('level',$level);
		}
		$this->db->where('idSucursal',$_SESSION['sucursal']);
		$sql = $this->db->get('users');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function historyClassStudent(){
		$f1 = $this->input->get('dateFrom');
		$f2 = $this->input->get('dateEnd');
		$idInstrument = $this->input->get('idInstrument');
		$idStudent = $this->input->get('idStudent');
		$sql = $this->db->where('dateClass >=',$f1)->where('dateClass <=',$f2)->where('idInstrument',$idInstrument)->where('idStudent',$idStudent)->get('clases');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function loadHandleClassInstruments(){
		$data['date'] = $this->input->get('date');
		$this->load->view('admin/addClassForm', $data, FALSE);
	}
	public function nav(){
		$uri = $this->uri->segment(3);
		if($uri!=null){
			$this->data['view'] = $uri;
		}
		$this->load->view('admin/index',$this->data);
	}
	public function sendInstrument(){
		// echo '<pre>';
		// 	var_dump($_GET);
		// echo '</pre>';
		$id = $this->input->get('id');
		$name = $this->input->get('name');
		$cupos = isset($_GET['nCupo']) ? $this->input->get('nCupo') : 0;
		//$a = array('name'=>$name, 'cupos'=>$this->input->get('nCupos'));
		$a = array('name'=>$name, 'cupos'=>$cupos, 'idSucursal'=>$_SESSION['sucursal']);
		if($id==0){
			$this->db->insert('instrumentos',$a);
			$id = $this->db->insert_id();
		}else{
			$this->db->where('id',$id)->update('instrumentos',$a);
		}
		$sql = $this->db->where('id',$id)->get('instrumentos');
		$r['response'] = 2;
		$r['content'] = $sql->result();
		echo json_encode($r);
	}
	public function removeClassStudent(){
		$id = $this->input->get('id');
		$this->db->where('id',$id)->update('relStudentClassHead',array('status'=>1));
		$r['response'] = 2;
		$r['content'] = 'removed';
		echo json_encode($r);
	}
	
	public function toggleBlockedClass(){
		$idClassHead = $this->input->get('idClassHead');
		$val = $this->input->get('val');
		$this->db->where('id',$idClassHead)->update('clasesHead',array('private'=>$val));
		$r['response'] = 2;
		$r['content'] = 'saved';
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
