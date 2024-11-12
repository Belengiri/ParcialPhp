<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	public function index()
	{
		$this->load->view('login_view');
	}
	public function administrador(){
		$this->load->view('admin_view');
	}
	public function login(){
		$this->form_validation->set_rules('usuario','Usuario','required');
		$this->form_validation->set_rules('clave','Clave','required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('errors',['Usuarios' => 'LLene los campos ']);
			redirect('auth');
		}else{
			$usuario=set_value('usuario');
			$clave=set_value('clave');
			if($uid = $this->login_model->control_usuarios($usuario,$clave)){
				$u= $this->login_model->traer_por_id($uid);
				$this->session->set_userdata("id_usuario",$uid);
				$this->session->set_userdata('usuario',$u['usuario']);
				$this->session->set_userdata('id_rol',$u['id_rol']);
				if($u['id_rol'] == 1){
					redirect('auth/administrador');
				}else{
					redirect('principal/index');
				}
			}else{
				$this->session->set_flashdata('errors',['Usuarios' => 'Usuario no encontrado']);
				redirect('auth');
			}

		}
	}
	public function salir(){
		$this->session->sess_destroy();
		redirect('auth');
	}
}
