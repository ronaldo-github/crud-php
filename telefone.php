<!******************************************************************************>
<!*  teste.tb1>
<!*******************************************************************************>

<?php
include "conexao.php" 
?> 

<!******************************************************************************>
<!*  teste.telefone>
<!******************************************************************************>

<?php
include "conexao.php" 
?>

<html>
<head> 
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<link rel="stylesheet" href="css/datatables.bootstrap.css">	 
<script src="js/validator.min.js"></script>
 </head>
<body> 
<button class="btn btn-primary" data-target="#modal-novo" data-toggle="modal">NOVO REGISTRO</button> 
<br><br> 
 <table id="tabela" class="table table-striped table-bordered">
 <thead>
 <tr>
<th><b> id </b></th>
<th><b> telefone </b></th>
<th>Acao</th>
<th>Acao</th>
<th>Acao</th>
</tr>  
</thead>
</tbody>
 <?php
$sql = "SELECT * FROM telefone ";
$rs = $con->prepare($sql); 
if($rs->execute()){ 
 if($rs->rowCount() > 0){
while($row = $rs->fetch(PDO::FETCH_ASSOC)){ 
 ?>
<tr> 
 <td valign="top"><?php echo $row["id"];?></td>
 <td valign="top"><?php echo $row["telefone"];?></td>
<td> <button   data-toggle="modal" class="btn btn-xs btn-primary"  data-target="#modal-visualizar<?php echo $row["id"]; ?> " > VISUALIZAR </button>  </td> 
<td> <button   data-toggle="modal" class="btn btn-xs btn-primary" data-backdrop="static" data-target="#modal-editar<?php echo $row["id"]; ?> " > EDITAR </button>  </td> 
<td><button data-toggle="modal" class="btn btn-xs btn-primary"  data-target="#modal-apagar<?php echo $row["id"];?>">APAGAR</button></td> 








<!*******************************************************************************>
<!                             MODAL EDITAR                                    >
<!*******************************************************************************>
 </tr>
 <div class="modal fade" id="modal-editar<?php echo $row["id"]; ?>"> 
 <div class="modal-dialog">
<div class="modal-content"> 
<div class="modal-header">
<h2>edicao de registro</h2>
</div> 
<div class="modal-body"> 
<form name="editar_registro" method="POST" >
<p><b></b><br /><input type="hidden" name="id_editar" value="<?php echo $row["id"]; ?>"/>
<div>
 <p><b>telefone</b><br /><input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row["telefone"]; ?>"required/>
</div>
<p><input  class="btn btn-primary" type="submit" value="salvar" /><input type="hidden" value="1" name="editar" /> 
</form>
</div>
<div class="modal-footer"> 
<button class="btn btn-primary btnSeccion"  data-dismiss="modal">Fechar</button>
</div>
</div>
</div>
</div>
<!*******************************************************************************>
<!                              FIM MODAL EDITAR                                >
<!*******************************************************************************>
















<!*******************************************************************************>
<!-                             MODAL VISUALIZAR                               ->
<!*******************************************************************************>
 <div class="modal fade" id="modal-visualizar<?php echo $row["id"]; ?>"> 
 <div class="modal-dialog">
<div class="modal-content"> 
<div class="modal-header">
<h2>visualisar  registro</h2>
</div> 
<div class="modal-body"> 
<div>
 <p><b>telefone</b>     <?php echo $row["telefone"]; ?> 
</div>
</form>
</div>
<div class="modal-footer"> 
<button class="btn btn-primary"  data-dismiss="modal">Fechar</button>
</div>
</div>
</div>
</div>
<!*******************************************************************************>
<!-                              FIM MODAL VISUALIZAR                                ->
<!*******************************************************************************>
















<!*******************************************************************************>
<!-                              MODAL APAGAR                               ->
<!*******************************************************************************>
 <div class="modal fade" id="modal-apagar<?php echo $row["id"]; ?>"> 
 <div class="modal-dialog">
<div class="modal-content"> 
<div class="modal-header">
<h2>apagar  registro</h2>
<h4>deseja mesmo excluir o registro de nome = <?php echo $row["telefone"];  ?></h4> 
</div>
<div class="modal-body"> 
 <button class="btn btn-primary"  data-dismiss="modal">cancelar</button>   
<a class="btn btn-primary" href="telefone.php?id=<?php echo $row["id"];?>&apaga">APAGAR</a> 
</div>
</div>
</div>
</div>
<!*******************************************************************************>
<!-                              FIM MODAL APAGAR                                ->
<!*******************************************************************************>








<?php }}}?>
</tbody>
</table>








<!*******************************************************************************>
<!-                              MODAL NOVO                                ->
<!*******************************************************************************>
<div class="modal fade" id="modal-novo">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
 <h2>novo registro</h2>
 </div>
<div class="modal-body">
<form  method="POST" name="novo_registro" >
<div>
 <p><b>telefone</b><br /><input type="text" class="form-control" id="telefone" name="telefone" required/>
</div>
<p><input  class="btn btn-primary" type="submit" value="salvar" /><input type="hidden" value="1" name="novo" /> 
</form>
 </div> 
<div class="modal-footer"> 
<button class="btn btn-primary"  data-dismiss="modal">Fechar</button>
</div>
</div>
</div>
</div>
<!*******************************************************************************>
<!-                              FIM MODAL NOVO                                ->
<!*******************************************************************************>








</body>
</html>
<?php








/*******************************************************************************>
                              NOVO                               
*******************************************************************************/
if (isset($_POST["novo"])) {
$rs = $con->prepare("INSERT INTO telefone (telefone) VALUES (:telefone)");
 $rs->bindParam(":telefone", $_POST["telefone"], PDO::PARAM_STR);
if($rs->execute())
{
echo '<script>alert("registro incluido com sucesso!");</script>'; 
}
else
{
echo '<script>alert("nao foi possivel incluir o registro!");</script>';
}
echo '<script>location.href="telefone.php";</script>';
}
/*******************************************************************************>
                               FIM NOVO                                
*******************************************************************************/
















/*******************************************************************************>
                              EDITAR                                ->
*******************************************************************************/
if (isset($_POST["editar"])) {
$id_editar = (int) $_POST["id_editar"];
$rs = $con->prepare("UPDATE telefone SET telefone =:telefone WHERE id = $id_editar ");
 $rs->bindParam(":telefone", $_POST["telefone"], PDO::PARAM_STR);
if($rs->execute())
{
echo '<script>alert("registro alterado com sucesso!");</script>';
}
else
{
echo '<script>alert("nao foi possivel alterar o registro!");</script>';
}
echo '<script>location.href="telefone.php";</script>';
}
/*******************************************************************************>
                              FIM EDITAR                                
*******************************************************************************/
















/*******************************************************************************>
                             DELETAR                                ->
*******************************************************************************/
if(isset($_GET["apaga"])){
$id = (int) $_GET["id"];
 $rs = $con->prepare("DELETE FROM telefone WHERE id = :id");
$rs->bindParam(":id", $id, PDO::PARAM_INT);
if($rs->execute())
{
echo '<script>alert("registro ecluido com sucesso!");</script>';
}
else
{
echo '<script>alert("nao foi possivel excluir o registro!");</script>';
}
echo '<script>location.href="telefone.php";</script>';
}
/*******************************************************************************>
                              FIM DELETAR                               ->
*******************************************************************************/
?>








<script>
$(document).ready(function(){
 $('#tabela').DataTable({
"language": {
"lengthMenu": "Mostrando _MENU_ registros por pagina",
"zeroRecords": "Nada encontrado",
 "info": "Mostrando pagina _PAGE_ de _PAGES_",
"infoEmpty": "Nenhum registro disponivel",
"infoFiltered": "(filtrado de _MAX_ registros no total)",
"sSearch": "Pesquisar",
"oPaginate": {
"sNext": "Proximo",
"sPrevious": "Anterior",
"sFirst": "Primeiro",
"sLast": "ultimo"
}}
});
$(".btnSeccion").click(function(event) { 
 location.reload();
});
});
 </script>













