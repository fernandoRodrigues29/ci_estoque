<?php 
if(isset($msg)){
        $m =  "<div class='alert ".$msg['type']."'>".
                "".$msg['m']."".
            "</div>";
         echo $m; 
}

?>
<div class="row">
    <div class="col-md-1">
        <a href="cadastrar" class="btn btn-lg btn-success"> Cadastrar</a>
    </div>
</div>
<br />
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Editar</th>
                <th>Excluir</th>  
            </tr>
        </thead>
    </table>
    <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable({
                "ajax":"<?php echo base_url($urlJson);?>",
                "columns":[
                    { "data": "id" },
                    { "data": "<?php echo $campoNome; ?>" },
                    {
                     "render" : function(data,type,row){ 
                        return "<a href='editar/"+row.id+"'><i class='fas fa-edit'></i></a>" },
                    },
                    {
                     "render" : function(data,type,row){ 
                        return "<a href='excluir/"+row.id+"'><i class='fas fa-trash-alt'></i></a>" },
                    }
                    
                ]
            });
          });
    </script>