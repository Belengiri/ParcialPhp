<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class principal_model extends CI_Model {
    public function traer_productos(){
        $query = $this->db->get('productos');
        return $query->result_array();
    }
    public function agregar_unidad($id){
        //false especifica que 'cantidad + 1 ' es una expresion sql
        $this->db->set('cantidad', 'cantidad + 1',false);
        $this->db->where('id_producto', $id); 
        $query = $this->db->update('productos');

        // Verificar si la actualización fue exitosa
        if ($this->db->affected_rows() > 0) {
            return TRUE; // Se realizó la actualización
        } else {
            return FALSE; // No se realizó la actualización
        }
        //return $query->affected_rows();
    }
    public function obtener_producto($id){
        $this->db->where('id_producto',$id);
        $query = $this->db->get('productos');
        return $query->row_array();
    }
    public function nuevo_producto($producto,$precio,$cantidad){
        $this->db->set('nombre_producto',$producto);
        $this->db->set('precio',$precio);
        $this->db->set('cantidad',$cantidad);
        $this->db->insert('productos');
        return $this->db->insert_id();
    }
    public function modificacion($producto,$precio,$cantidad,$id){
        $this->db->set('nombre_producto', $producto);
        $this->db->set('precio', $precio);
        $this->db->set('cantidad', $cantidad);
        $this->db->where('id_producto', $id); 
        $query = $this->db->update('productos');
        if ($this->db->affected_rows() > 0) {
            return TRUE; // Se realizó la actualización
        } else {
            return FALSE; // No se realizó la actualización
        }
    }
    public function quitar_unidad($id){
        //false especifica que 'cantidad - 1 ' es una expresion sql
        $this->db->set('cantidad', 'cantidad - 1',false);
        $this->db->where('id_producto', $id); 
        $query = $this->db->update('productos');

        // Verificar si la actualización fue exitosa
        if ($this->db->affected_rows() > 0) {
            return TRUE; // Se realizó la actualización
        } else {
            return FALSE; // No se realizó la actualización
        }
        //return $query->affected_rows();
    }
    public function eliminar_producto($id){
        $this->db->where('id_producto',$id);
        return $this->db->delete('productos');
    }

}