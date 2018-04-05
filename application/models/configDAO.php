<?php
require APPPATH.'/models/config.php';
class ConfigDAO extends Config
{
	function createDropDown($tabela,$campos) {
		$rs = $this->listarGeral($tabela);
			$linha = array(); 
				foreach ($rs as $key => $value) {
					$linha[$value[$campos[0]]] = $value[$campos[1]];	
				}
					return $linha;
	}
	function createDropDownSubQuery($tabela,$campos,$subquery) {
		$rs = $this->configDAO->listaSubquery($campos,$tabela,$subquery);
		//$rs = $this->listarGeral($tabela);
			$linha = array(); 
				foreach ($rs as $key => $value) {
					$linha[$value[$campos[0]]] = $value[$campos[1]];	
				}
					return $linha;
	}	


}
?>