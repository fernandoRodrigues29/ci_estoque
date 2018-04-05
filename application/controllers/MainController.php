<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MainController extends CI_Controller
{
	        public function __construct()
        {
                parent::__construct();
                $l = $this->session->userdata('login');
                /**/
                if(empty($l)){
                	redirect('auth/validar');
                }
                /**/
        }
	
	public function index(){
		
        $layout_data['conteudo'] = $this->load->view('bemVindo.php',null,true); 
		$this->load->view('principal',$layout_data);
		
	}
}


?>