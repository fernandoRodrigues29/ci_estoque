<?php

class Config extends CI_Model
{
	
	function __construct()
	{
		 parent::__construct();
	}

	public function inserir($tabela,$data)
	{
		$this->db->insert($tabela, $data);
			if($this->db->affected_rows() > 0){
				return TRUE;	
			}else{
				return FALSE;
			}
		//print_r($this->db->last_query());
		$this->db->close();
	}

	public function listarGeral($tabela)
	{
		 return $this->db->get($tabela)->result_array();
		 $this->db->close();
	}
	
	public function listarWhere($select,$tabela,$where)
	{
		$this->db->select($select);
		$this->db->where($where);
		$query = $this->db->get($tabela);

		return $query->result_array();
		$this->db->close();
	}

	public function deletar($tabela,$id)
	{
		$this->db->where($id);
			$this->db->delete($tabela);
				if($this->db->affected_rows() > 0){
					return TRUE;	
				}else{
					return FALSE;
				}		
				$this->db->close();
	}

	public function atualizar($dados,$tabela,$where){
		$this->db->set($dados);
		$this->db->where($where);
		$this->db->update($tabela);
			if($this->db->affected_rows() > 0){
				return TRUE;	
			}else{
				return FALSE;
			}
			$this->db->close();
	}

	public function listarJoin($select,$tab1,$tab2,$where) {
		$this->db->select($select);
			$this->db->from($tab1);
			$this->db->join($tab2, $where); 
				$query = $this->db->get();
					return $query->result_array();
						$this->db->close();
	}

	public function listaSubquery($select,$tabela,$subquery){
		$this->db->select($select)->from($tabela);
			$this->db->where($subquery, NULL, FALSE);
				$query =  $this->db->get();
				return $query->result_array();
					$this->db->close();
		/**
		$this->db->select('*')->from('certs');
		$this->db->where('`id` NOT IN (SELECT `id_cer` FROM `revokace`)', NULL, FALSE);
		/**/
	}
}
?>