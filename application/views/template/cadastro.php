
<?php
if(isset($msg)){
		$m =  "<div class='alert ".$msg['type']."'>".
	 			"".$msg['m']."".
		  	"</div>";
		 echo $m; 
}
echo validation_errors(); 
echo form_open($action);

foreach ($inputs as $key => $value) {
	echo '<div class="form-group row">'.
		'<label class="col-sm-2 col-form-label" for="">'.$value['placeholder'].'</label>'.
			'<div class="col-sm-10">'.form_input($value).'</div>'.
			'</div>';	
}
if(isset($selects)) {
	foreach ($selects as $value) {
		echo '<div class="form-group row">'.
			form_dropdown($value['name'], $value['lista'], $value['selecionado'],'class="form-control"').
		'</div>';
	}
}

echo '<button type="submit" class="btn btn-success btn-block">'.$labelSubimit.'</button>';
echo "<a class='btn btn-info btn-block' href='listar'>Voltar</a>";
echo form_close();

?>
