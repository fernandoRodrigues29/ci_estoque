<?php
class Fornecedor_c extends CI_Controller
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
			
			$this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required');

		$data['action'] = 'http://localhost:8090/fornecedor_c/cadastrar';
		$data['inputs'] = array(
			array(
				'type'  => 'text',
		        'name'  => 'fornecedor',
		        'class' => 'form-control',
		        'placeholder' => 'Fornecedor'
				)
		);
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					//mensagem
					$dbd['fornecedor'] = $this->input->post('fornecedor');
					
						if($this->categoriaDAO->inserir('fornecedor',$dbd)){
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
		$data['urlJson'] = 'fornecedor_c/jsonListar';
		$data['campoNome'] ='fornecedor';
 		$layout_data['conteudo'] = $this->load->view('template/listar',$data,TRUE); 
		$this->load->view('principal',$layout_data);		

	}

	public function jsonListar(){
		$this->load->model('categoriaDAO');
		$rs['data'] = $this->categoriaDAO->listarGeral('fornecedor');
		echo json_encode($rs);
	}

	public function excluir(){
			$this->load->model('categoriaDAO');
			$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2){
					$id = intval($colecaoURL[2]);
					if($this->categoriaDAO->deletar('fornecedor',array('id'=>$id))){
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
						redirect('fornecedor_c/listar');
	}
	
	public function editar(){
			$this->load->model('categoriaDAO');
			$this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required');
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					$pd['fornecedor'] = $this->input->post('fornecedor');
					$pd['id'] = $this->input->post('id');
				if($this->categoriaDAO->atualizar($pd,'fornecedor',array('id'=>$pd['id']))){
							
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
					redirect('fornecedor_c/listar');
		 }else{
		 	$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2) {
					$id = intval($colecaoURL[2]);
					$arr = $this->categoriaDAO->listarWhere('*','fornecedor',array('id'=>$id));
						foreach ($arr as $key => $value) {
							$fornecedor = $value['fornecedor'];	
						}
							//criação do formulario
							$data['action'] = 'http://localhost:8090/fornecedor_c/editar';
								$data['inputs'] = array(
									array(
										'type'  => 'hidden',
								        'name'  => 'id',
								        'value' => $id,
								        'placeholder' => ''
								        ),
									array(
										'type'  => 'text',
								        'name'  => 'fornecedor',
								        'class' => 'form-control',
								        'placeholder' => 'Fornecedor',
								        'value' => $fornecedor
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