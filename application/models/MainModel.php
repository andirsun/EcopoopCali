<?php

class MainModel extends CI_Model{

    public function __construnct(){
        parent::__construct();
    }
    /*
    public function addLog($type, $desc, $id){
    	$idUser = !isset($_SESION['data_user']) ? 0 : $_SESION['data_user']->id;
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$this->db->insert('aLog',
    		array(
    			'idUser'=>$idUser,
    			'ip'=>$ip,'type'=>$type,'description'=>$desc,'idVal'=>$id
    		)
    	);
    }

    public function checkInstrumentStudent($idUser, $idInstrument){
    	$check = $this->db->where('idUser',$idUser)->where('idInstrument',$idInstrument)->get('userRelInstrument');
    	if($check->num_rows()>0){
    		return true;
    	}else{
    		return false;
    	}

    }
    public function horasRestantesEstudiante($idUser, $idInstrument){
        $lastPackage = $this->db->where('idStudent',$idUser)->where('idInstrument',$idInstrument)->order_by('id','desc')->get('clasesBuys');

        if($lastPackage->num_rows()==0){
            $hoursRest = 0;
        }else{
            $lastPackage = $lastPackage->result()[0];
            $totalHoursLast = $lastPackage->totalHours;
            $dateLastPackage = explode(' ', $lastPackage->date);
            $hoursTaked = $this->db->select('COUNT(id) AS n')->where('dateClass >=',$dateLastPackage[0])->where('idStudent',$idUser)->where('idInstrument',$idInstrument)->where('status="1" OR status="2"')->get('clases')->result()[0]->n;
            $hoursRest = $totalHoursLast - $hoursTaked;
        }
        return $hoursRest;
    }
    */
}