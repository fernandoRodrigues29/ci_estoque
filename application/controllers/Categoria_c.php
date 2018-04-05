<?php

class Categoria_c extends CI_Controller
{
        public function __construct()
        {
                parent::__construct();
                $l = $this->session->userdata('login');
                if(empty($l)){
                	redirect('auth/validar');
                }
        }

	public function index(){
		$this->cadastrar();
	}

	public function cadastrar(){
		$this->load->model('categoriaDAO');
			
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');

		$data['action'] = 'http://localhost:8090/categoria_c/cadastrar';
		$data['inputs'] = array(
			array(
				'type'  => 'text',
		        'name'  => 'categoria',
		        'class' => 'form-control',
		        'placeholder' => 'Categoria'
				)
		);
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					//mensagem
					$dbd['categoria'] = $this->input->post('categoria');
					
						if($this->categoriaDAO->inserir('categoria',$dbd)){
							
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
						$data['msg'] = $mensagem;
					
                }else{
                	//mensagem
                	$mensagem = array(
					    'type'     => 'alert-danger',
					    'm' => 'Cadastro não Realizado!'
					);
					$data['msg'] = $mensagem;
                }
		 }
		$data['labelSubimit'] = "Cadastrar!";
        $layout_data['conteudo'] = $this->load->view('template/cadastro',$data,TRUE); 
		$this->load->view('principal',$layout_data);
	}

	public function listar(){
		//verificar evio de mensagem
		$data = NULL;
		if($this->session->userdata('msg')){
			$data['msg'] = $this->session->userdata('msg');
			$this->session->unset_userdata('msg');
		}
		$data['urlJson'] = 'categoria_c/jsonListar';
		$data['campoNome'] ='categoria';
 		$layout_data['conteudo'] = $this->load->view('template/listar',$data,TRUE); 
		$this->load->view('principal',$layout_data);		

	}

	public function jsonListar(){
		$this->load->model('categoriaDAO');
		$rs['data'] = $this->categoriaDAO->listarGeral('categoria');
		echo json_encode($rs);
	}

	public function excluir(){
			$this->load->model('categoriaDAO');
			$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2){
					$id = intval($colecaoURL[2]);
					if($this->categoriaDAO->deletar('categoria',array('id'=>$id))){
						$mensagem = array(
							'username' => 'msg',
					    	'type'     => 'alert-success',
					    	'm' => 'Excluido com sucesso!'
						);
					}else{
						$mensagem = array(
							'username' => 'msg',
					    	'type'     => 'alert-danger',
					    	'm' => 'erro ao excluir!'
						);
					}
				}else{
					$mensagem = array(
							'username' => 'msg',
					    	'type'     => 'alert-danger',
					    	'm' => 'URL incorreta!'
						);
				}
					$this->session->set_userdata('msg',$mensagem);					
						redirect('categoria_c/listar');
	}
	
	public function editar(){
			$this->load->model('categoriaDAO');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					$pd['categoria'] = $this->input->post('categoria');
					$pd['id'] = $this->input->post('id');
				if($this->categoriaDAO->atualizar($pd,'categoria',array('id'=>$pd['id']))){
							
							$mensagem = array(
						    	'type'     => 'alert-success',
						    	'm' => 'Atualizado com Sucesso!'
							);
						}else{
							
							$mensagem = array(
						    	'type'     => 'alert-darnger',
						    	'm' => 'erro no Cadastrado!'
							);
						}
						$data['msg'] = $mensagem;
					
                }else{
                	//mensagem
                	$mensagem = array(
					    'type'     => 'alert-danger',
					    'm' => 'Edição não Realizado!'
					);
					$data['msg'] = $mensagem;
				}
                $this->session->set_userdata('msg',$mensagem);					
					redirect('categoria_c/listar');
		 }else{
		 	$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2) {
					$id = intval($colecaoURL[2]);
					$arr = $this->categoriaDAO->listarWhere('*','categoria',array('id'=>$id));
						foreach ($arr as $key => $value) {
							$categoria = $value['categoria'];	
						}
							$data['action'] = 'http://localhost:8090/categoria_c/editar';
								$data['inputs'] = array(
									array(
										'type'  => 'hidden',
								        'name'  => 'id',
								        'value' => $id,
								        'placeholder' => ''
								        ),
									array(
										'type'  => 'text',
								        'name'  => 'categoria',
								        'class' => 'form-control',
								        'placeholder' => 'Categoria',
								        'value' => $categoria
										)
								);
				}else {
						$mensagem = array(
							'username' => 'msg',
					    	'type'     => 'alert-danger',
					    	'm' => 'erro ao excluir!'
						);					
				}
		 }
		 $data['labelSubimit'] = "Editar!";
	    $layout_data['conteudo'] = $this->load->view('template/cadastro',$data,TRUE); 
		$this->load->view('principal',$layout_data);

	}
}

?>