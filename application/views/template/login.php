<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  <link href="<?php echo  base_url("public/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo  base_url("public/js/bootstrap.min.js"); ?>"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
	 <style type="text/css">
      .principal {
        width: 70%;
        border: 0px solid red;
        padding: 25px 25px 25px 25px; 
        margin-top: 10%;
          -webkit-box-shadow: 0px 0px 52px -14px rgba(120,104,101,1);
          -moz-box-shadow: 0px 0px 52px -14px rgba(120,104,101,1);
          box-shadow: 0px 0px 52px -14px rgba(120,104,101,1);
      }
  </style>
</head>
<body>
<div class="principal center-block">
<div class="row">
  <?php
if(isset($msg)){
    $m =  "<div class='alert ".$msg['type']."'>".
        "".$msg['m']."".
        "</div>";
     echo $m; 
}
echo validation_errors(); 
?>
</div>
              <form method="POST" action="<?php echo $formAction;?>">
                <div class="form-group">
                  <label>Usuario</label>
                  <input type="text" name ="usuario" class="form-control"  placeholder="Usuario">
                </div>
                
                <div class="form-group">
                  <label >Senha</label>
                  <input type="password" name="senha" class="form-control"  placeholder="senha">
                </div>
                <div class="form-group">
                  <button  type='submit' class="btn btn-success btn-block btn-lg">Acessar</button>
                </div>
              </form>
              <button data-toggle="modal" data-target="#exampleModal" class="btn btn-info btn-block btn-lg">
               *Novo
              </button>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cad-Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo $formActionCadastrar; ?>">
          <div class="form-group">
            <label>Nome</label>
            <input name="nome" type="text" class="form-control"  placeholder="Nome">
          </div>
          <div class="form-group">
            <label>Usuario</label>
            <input name="usuario" type="text" class="form-control"  placeholder="Usuario">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input name="senha" type="password" class="form-control"  placeholder="Senha">
          </div>
          <div class="form-group">
            <button  type='submit' class="btn btn-success btn-block btn-lg">Cadastrar!</button>
          </div>                    
        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">X - SAIR</button>
      </div>

    </div>
  </div>
</div>
</body>
</html>