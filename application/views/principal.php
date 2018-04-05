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
<link href="<?php echo  base_url("public/css/dashboard.css"); ?>" rel="stylesheet" type="text/css" />	 
</head>
<body>
	 <div class="container-fluid">
    <div class="row">
      <div class="menuHorizontal">
        <ul class="menuTop">
          <li><a href=""> Sistema De Estoque </a></li>
          <li><a href="<?php echo  base_url("auth/sair"); ?>"> Sair </a></li>
        </ul>
      </div>
    </div>
    <div class="row">
          <div class="sidebar_menu">
                <ul class="sidebar-nav">
                  <li>
                    <a href="<?php echo  base_url("categoria_c/listar"); ?>">
                      Categoria
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo  base_url("fornecedor_c/listar"); ?>">
                      Fornecedor
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo  base_url("produto_c/listar"); ?>">
                      Produto
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo  base_url("estoque_c/listar"); ?>">
                      Estoque
                    </a>
                  </li>                  
                </ul>
          </div>
          
          <div class="principal">

              <h1>Pagina Principal</h1>

              <section class="row text-center placeholders">
              	<div class="col-lg-12">
              		<!----
                  <div class="col-lg-8 col-lg-offset-1">
             			 <!---->
                  <div class="center-block"> 
                   <?php echo $conteudo; ?>		
              		</div>
              	</div> 
              </section>
              <div class="table-responsive">
              </div>
            
            </div>
    </div>
</div>
</body>
</html>