<!--
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Frontend de la aplicacion con php y html
-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1>Nuevo Proyecto</h1>
</div>
<form id="formRegistrarProyecto"> 
    <!--<input type="hidden" id="id" name="id" value="0">
    <input type="hidden" id="level" name="level" value="3">-->
    <div class="form-group row no-gutters">
        <label for="userName" class="col-sm-1 col-form-label">Nombre: </label>
        <div class="col-sm-6">
            <input type="text" class="form-control"  name="nombre" id="userName" placeholder="Nombre del proyecto" required>
        </div>
    </div>
    <div class="form-group row no-gutters">
        <label for="password" class="col-sm-1 col-form-label">ID Proyecto: </label>
        <div class="col-sm-6">
            <input type="number"  class="form-control" name="idProyecto" id="idHuellero" placeholder="Numero">
        </div>
    </div>
    <div class="form-group row no-gutters">
        <label for="NumeroInscripcion" class="col-sm-1 col-form-label">Descripcion: </label>
        <div class="col-sm-6">
            <input type="text"  class="form-control" name="descripcion" id="NumeroInscripcion" placeholder="Describe brevemente el proyecto ">
        </div>
    </div>
    
    <div class="form-group row no-gutters">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">  
                Crear Proyecto
            </button>
            <button type="button" id="cancel-edit" style="display: none;" class="btn btn-danger">
                Cancelar edicion
            </button>
        </div>
    </div>
    <div class="alert" id="msg-add-user" style="display: none;">
        <h3 id="text-add-form" class="m-0"></h3>
    </div>
</form>
<script src="<?php echo base_url() ?>assets/js/proyectos.js"></script>