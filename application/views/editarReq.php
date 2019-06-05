<!--
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Frontend de la aplicacion con php y html
-->
<div class="container-fluid">
    <form id="formEditRequisito">
        <div class="form-group">
            <label  class="col-form-label" value="" id="dataHead">ID: </label>
            <input  name="editIdRequisito"class="form-control" type="number" id="editIdRequisito" value="<?php echo $idRequisito?>" readonly> <!--El name se usa para poder hacer el submit del formulario-->
        </div>
        <div class="form-group">
            <label class="col-form-label">Descripcion</label>
            <textarea name="editDescripcionRequisito"type="text" class="form-control" id="editDescripcionRequisito" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label class="col-form-label">Dependencias</label>
            <textarea name="editDependenciaRequisito"type="text" class="form-control" id="editDependenciaRequisito" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label class="col-form-label">Version</label>
            <input name="editVersionRequisito" type="text" class="form-control" id="editVersionRequisito">
        </div>
        <div class="form-group">
            <label class="col-form-label">Estado</label>
            <input name="editEstadoRequisito" type="number" class="form-control" id="editEstadoRequisito">
        </div>
        <button type="submit" class="btn btn-primary" id="botonEditarRequisito">Editar a Ultima Version</button>
    </form>
</div>
<script>
	var idReq = '<? echo $idRequisito ?>';
</script>