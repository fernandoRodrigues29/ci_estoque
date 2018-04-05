<?php
class Auth extends CI_Controller
{
	function index(){
		$this->validar();
	}
	function validar() {
		$this->load->model('configDAO');
		if($this->session->userdata('msg')){
			$data['msg'] = $this->session->userdata('msg');
			$this->session->unset_userdata('msg');
		}
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');
		
		if($this->form_validation->run()){
			if($this->input->post()){
				$usuario = $this->input->post('usuario');
					$senha = $this->input->post('senha');
						$senha = md5($senha);
							$arr = $this->configDAO->listarWhere('id','usuario',array('usuario'=>$usuario,'senha'=>$senha));	

				if(count($arr)>0){
					$this->session->set_userdata('login',TRUE);
					redirect('maincontroller');	
				}else{
					$mensagem = array(
				  	'type'     => 'alert-darnger',
				   	'm' => 'erro na autenticação do usuario!'
				);
				}
				$data['msg'] = $mensagem;	
			}	
		}
		
		$data['formAction'] = 'http://localhost:8090/auth/validar';
		$data['formActionCadastrar'] = 'cadastrar';
		$this->load->view('template/login',$data); 
	}
	

	function cadastrar() {
		$this->load->model('configDAO');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');

		if ($this->form_validation->run()){
			$pd['usuario'] = $this->input->post('usuario');
			$senha = $this->input->post('senha');
			$pd['senha'] = md5($senha);
			$pd['nome'] = $this->input->post('nome');;
			if($this->configDAO->inserir('usuario',$pd)){
				$mensagem = array(
				  	'type'     => 'alert-success',
				  	'm' => 'Cadastrado com Sucesso!'
				);
			}else{
				$mensagem = array(
				  	'type'     => 'alert-darnger',
				   	'm' => 'erro no Cadastrado!'
				);
			}
			 $this->session->set_userdata('msg',$mensagem); 
		}else{
				$mensagem = array(
				  	'type'     => 'alert-darnger',
				   	'm' => 'erro no Cadastrado!'
				);
				 $this->session->set_userdata('msg',$mensagem);	
		}
		redirect('auth/validar');		 
	}

	function sair(){
		$this->session->unset_userdata('login');
		redirect('auth/validar');
	}
}
?>