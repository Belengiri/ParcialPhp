<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class principal extends CI_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('principal_model');
    }
    public function index(){
        $productos['productos']=$this->principal_model->traer_productos();
        $this->load->view('principal_view',$productos);
    }
    public function agregar_nuevo(){
        $this->form_validation->set_rules('nombre','Producto','required');
        $this->form_validation->set_rules('precio','Precio','required');
        $this->form_validation->set_rules('cantidad','Cantidad','required');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('errors',['Productos'=>'Rellene los campos']);
            $this->session->set_flashdata('activo','esta activo');
            redirect('principal');
        }else{
            $producto = set_value('nombre');
            $precio = set_value('precio');
            $cantidad = set_value('cantidad');
            $this->principal_model->nuevo_producto($producto,$precio,$cantidad);
            $this->session->set_flashdata('mensaje','Producto cargado');
            redirect('principal');
        }
    }
    public function agregar_cantidad($id){
        if($this->principal_model->agregar_unidad($id)){
            $this->session->set_flashdata('mensaje','Unidad Agregada con exito');
            redirect('principal');
        }else{
            $this->session->set_flashdata('errors',['Productos' =>'Error al Agregar unidad']);
            redirect('principal');
        }

    }
    public function quitar_cantidad($id){
        if($this->principal_model->quitar_unidad($id)){
            $this->session->set_flashdata('mensaje','Unidad Quitada con exito');
            redirect('principal');
        }else{
            $this->session->set_flashdata('errors',['Productos' =>'Error al Quitar unidad']);
            redirect('principal');
        }

    }
    public function modificar($id){
        $this->form_validation->set_rules('nombre','Producto','required');
        $this->form_validation->set_rules('precio','Precio','required');
        $this->form_validation->set_rules('cantidad','Cantidad','required');
        if($this->form_validation->run() == false){
            $this->session->set_flashdata('errors',['Productos'=>'Rellene los campos']);
            $this->session->set_flashdata('activoEditar','esta activo');
            redirect('principal');
        }else{
            $producto = set_value('nombre');
            $precio = set_value('precio');
            $cantidad = set_value('cantidad');
            $this->principal_model->modificacion($producto,$precio,$cantidad,$id);
            $this->session->set_flashdata('mensaje','Producto Modificado');
            redirect('principal');
        }
    }
    public function botonagregar(){
        $this->session->set_flashdata('activo','esta activo');
        redirect('principal');
    }
    
    public function botoneditar($id){
        $this->session->set_flashdata('activoEditar','esta activo');
        $this->session->set_userdata('id_producto',$id);
        if($data=$this->principal_model->obtener_producto($id)){
            $this->session->set_userdata('nombre_producto',$data['nombre_producto']);
            $this->session->set_userdata('precio',$data['precio']);
            $this->session->set_userdata('cantidad',$data['cantidad']);
            redirect('principal/index');
        }else{
            redirect('principal/index');
        }
        
    }

    public function eliminar($id){
       if($this->principal_model->eliminar_producto($id)){
            $this->session->set_flashdata('mensaje', 'Producto eliminado con éxito.');
            redirect('principal');
       }else {
            $this->session->set_flashdata('errors', ['Productos' => 'Error al eliminar producto.']);
            redirect('principal');
       }
    }
}