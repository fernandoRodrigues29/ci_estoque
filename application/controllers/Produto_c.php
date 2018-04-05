<?php
class Produto_c extends CI_Controller
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
			
			$this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
			$this->form_validation->set_rules('produto', 'Produto', 'required');
			$this->form_validation->set_rules('valor', 'Valor', 'required');
			$this->form_validation->set_rules('descricao', 'Descrição', 'required');

		$data['action'] = 'http://localhost:8090/produto_c/cadastrar';
		$data['inputs'] = array(
			array(
				'type'  => 'text',
		        'name'  => 'produto',
		        'class' => 'form-control',
		        'placeholder' => 'Produto'
				),
			array(
				'type'  => 'text',
		        'name'  => 'valor',
		        'class' => 'form-control',
		        'placeholder' => 'Valor'
				),
			array(
				'type'  => 'text',
		        'name'  => 'descricao',
		        'class' => 'form-control',
		        'placeholder' => 'Descrição'
				)			
		);

		 $l_categorias = $this->configDAO->createDropDown('categoria',array('id','categoria'));
		 $l_fornecedores = $this->configDAO->createDropDown('fornecedor',array('id','fornecedor'));

		$data['selects'] =	array(
			array(
				'name' =>'categoria',
				'selecionado' =>'',
				'lista' =>	$l_categorias
			),
			array(
				'name' =>'fornecedor',
				'selecionado' =>'',
				'lista' =>	$l_fornecedores	
			)			
		);

		if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					//mensagem
					$dbd['produto']    = $this->input->post('produto');
					$dbd['valor']      = $this->input->post('valor');
					$dbd['descricao']  = $this->input->post('descricao');
					$dbd['fk_categoria']  = $this->input->post('categoria');
					$dbd['fk_fornecedor'] = $this->input->post('fornecedor');
						if($this->configDAO->inserir('produto',$dbd)){
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
		$data['urlJson'] = 'produto_c/jsonListar';
		$data['campoNome'] ='produto';
 		$layout_data['conteudo'] = $this->load->view('template/listar',$data,TRUE); 
		$this->load->view('principal',$layout_data);		

	}

	public function jsonListar(){
		$this->load->model('categoriaDAO');
		$rs['data'] = $this->categoriaDAO->listarGeral('produto');
		echo json_encode($rs);
	}

	public function excluir(){
			$this->load->model('configDAO');
			$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2){
					$id = intval($colecaoURL[2]);
					if($this->configDAO->deletar('produto',array('id'=>$id))){
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
						redirect('produto_c/listar');
	}
	
	public function editar(){
			$this->load->model('configDAO');
			
			$this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required');
			$this->form_validation->set_rules('categoria', 'Categoria', 'required');
			$this->form_validation->set_rules('produto', 'Produto', 'required');
			$this->form_validation->set_rules('valor', 'Valor', 'required');
			$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		 
		 if($this->input->post()){
		 	    if ($this->form_validation->run())
                {
					$pd['id'] 		     = $this->input->post('id');
					$pd['produto']       = $this->input->post('produto');
					$pd['valor']         = $this->input->post('valor');
					$pd['descricao']     = $this->input->post('descricao');
					$pd['fk_categoria']  = $this->input->post('categoria');
					$pd['fk_fornecedor'] = $this->input->post('fornecedor');


				if($this->configDAO->atualizar($pd,'produto',array('id'=>$pd['id']))){
							
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
					redirect('produto_c/listar');
		 }else{
		 	$colecaoURL = explode('/', $this->uri->uri_string());
				if(count($colecaoURL) >2) {
					$id = intval($colecaoURL[2]);
					
					$arr = $this->configDAO->listarWhere('*','produto',array('id'=>$id));
						
						foreach ($arr as $key => $value) {
							$vproduto    = $value['produto'];
							$vvalor      = $value['valor'];
							$vdescricao  = $value['descricao'];
							$vcategoria  = $value['fk_categoria'];
							$vfornecedor = $value['fk_fornecedor'];	
						}
							//criação do formulario
							$data['action'] = 'http://localhost:8090/produto_c/editar';
								$data['inputs'] = array(
									array(
										'type'  => 'hidden',
								        'name'  => 'id',
								        'value' => $id,
								        'placeholder' => ''
								        ),
									array(
										'type'  => 'text',
								        'name'  => 'produto',
								        'class' => 'form-control',
								        'placeholder' => 'Produto',
								        'value' => $vproduto
										),
									array(
										'type'  => 'text',
								        'name'  => 'valor',
								        'class' => 'form-control',
								        'placeholder' => 'Valor',
								        'value' => $vvalor
										),
									array(
										'type'  => 'text',
								        'name'  => 'descricao',
								        'class' => 'form-control',
								        'placeholder' => 'Descrição',
								        'value' => $vdescricao
										)
								);

							 $l_categorias = $this->configDAO->createDropDown('categoria',array('id','categoria'));
							 $l_fornecedores = $this->configDAO->createDropDown('fornecedor',array('id','fornecedor'));

							$data['selects'] =	array(
								array(
									'name' =>'categoria',
									'selecionado' =>$vcategoria,
									'lista' =>	$l_categorias
								),
								array(
									'name' =>'fornecedor',
									'selecionado' =>$vfornecedor,
									'lista' =>	$l_fornecedores	
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