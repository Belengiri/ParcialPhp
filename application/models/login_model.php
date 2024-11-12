<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

    public function traer_por_id($id){
        $this->db->select('usuarios.*','roles.nombre_rol AS rol');
        $this->db->join('roles','roles.id_rol=usuarios.id_rol','inner');
        $this->db->from('usuarios');
        $this->db->where('id_usuario',$id);
        $query= $this->db->get();
        return $query->row_array();
    }
	public function control_usuarios($usuario,$clave){
        $this->db->select('id_usuario');
        $this->db->where('usuario',$usuario);
        $this->db->where('clave',md5($clave));
       $query = $this->db->get('usuarios');
       if($query->num_rows() > 0){
        $respuesta = $query->row_array();
        return $respuesta['id_usuario'];
       }else{
            return false;
       }
    }

}