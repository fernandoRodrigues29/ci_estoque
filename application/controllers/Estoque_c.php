<?php
class Estoque_c extends CI_Controller
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
		$this->listar();
	}

	public function cadastrar(){
		$this->load->model('configDAO');
			
			$this->form_validation->set_rules('produto', 'Produto', 'required');
			$this->form_validation->set_rules('qtd', 'Quantidade', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			
		$data['action'] = 'http://localhost:8090/estoque_c/cadastrar';
		$data['inputs'] = array(
			array(
				'type'  => 'text',
		        'name'  => 'qtd',
		        'class' => 'form-control',
		        'placeholder' => 'Quantidade'
				),
			array(
				'type'  => 'text',
		        'name'  => 'status',
		        'class' => 'form-control',
		        'placeholder' => 'Status'
				)			
		);
  	    $l_produto = $this->configDAO->createDropDownSubQuery('produto',array('id','produto'),'id NOT IN (SELECT produto FROM estoque)');
		$data['selects'] =	array(
			array(
				'name' =>'produto',
				'selecionado' =>'',
				'lista' =>	$l_produto
			)			
		);

		if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					//mensagem
					$dbd['produto']    = $this->input->post('produto');
					$dbd['qtd']      = $this->input->post('qtd');
					$dbd['status']  = $this->input->post('status');

						if($this->configDAO->inserir('estoque',$dbd)){
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
		$this->load->model('configDAO');
		$data = NULL;
		if($this->session->userdata('msg')){
			$data['msg'] = $this->session->userdata('msg');
			$this->session->unset_userdata('msg');
		}
		$data['urlJson'] = 'estoque_c/jsonListar';
		$data['campoNome'] ='produto';
 		$layout_data['conteudo'] = $this->load->view('template/listar',$data,TRUE); 
		$this->load->view('principal',$layout_data);		

	}

	public function jsonListar(){
		$this->load->model('configDAO');
		$rs['data'] = $this->configDAO->listarJoin('estoque.id,produto.produto','produto','estoque','produto.id = estoque.produto');
		//$rs['data'] = $this->configDAO->listarGeral('produto');
		echo json_encode($rs);
	}

	public function excluir(){
			$this->load->model('configDAO');
			$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2){
					$id = intval($colecaoURL[2]);
					if($this->configDAO->deletar('estoque',array('id'=>$id))){
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
						redirect('estoque_c/listar');
	}
	
	public function editar(){
			$this->load->model('configDAO');
			
			//$this->form_validation->set_rules('produto', 'Produto', 'required');
			$this->form_validation->set_rules('qtd', 'Quantidade', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
		 
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					$id 		     = $this->input->post('id');
					$pd['qtd']       = $this->input->post('qtd');
					$pd['status']         = $this->input->post('status');
				
				if($this->configDAO->atualizar($pd,'estoque',array('id'=>$id))){
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
				redirect('estoque_c/listar');
		 }else{
		 	$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2) {
					$id = intval($colecaoURL[2]);
					
					$arr = $this->configDAO->listarWhere('*','estoque',array('id'=>$id));
						
						foreach ($arr as $key => $value) {
							$vproduto    = $value['produto'];
							$vqtd        = $value['qtd'];
							$vstatus     = $value['status'];
						}
							//criação do formulario
							$data['action'] = 'http://localhost:8090/estoque_c/editar';
								$data['inputs'] = array(
									array(
										'type'  => 'hidden',
								        'name'  => 'id',
								        'value' => $id,
								        'placeholder' => ''
								        ),
									array(
										'type'  => 'text',
								        'name'  => 'qtd',
								        'class' => 'form-control',
								        'placeholder' => 'Quantidade',
								        'value' => $vqtd
										),
									array(
										'type'  => 'text',
								        'name'  => 'status',
								        'class' => 'form-control',
								        'placeholder' => 'Status',
								        'value' => $vstatus
										)
								);
							/*readonly */
							/**	
							$l_produtos = $this->configDAO->createDropDown('produto',array('id','produto'));
							$data['selects'] =	array(
								array(
									'name' =>'produto',
									'selecionado' =>$vproduto,
									'lista' =>	$l_produtos
								)			
							);
							/**/


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