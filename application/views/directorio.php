<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h1">Directorio de Contribuidores</h1>
  
</div>
<table class="table table-sm table-striped table-responsive " id="tablaDirectorio">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Completo</th>
      <th scope="col">Correo electronico </th>
      <th scope="col">Tipo de documento</th>
      <th scope="col">Documento</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<div class="modal fade" id="modalEditarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Informacion de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="target" >
            <div class="form-group row">
                <label for="userName" class="col-sm-2 col-form-label">Nombre </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="userNameEdit" id="userNameEdit" placeholder="Nombre de Usuario">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Acudiente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="acudienteEdit" id="acudienteEdit" placeholder="Numero">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Direccion</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="adressEdit" id="adressEdit" placeholder="Referencia">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Tel Principal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="mainTelEdit" id="mainTelEdit" placeholder="1 cedula,0 Tarjeta">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Tel Secundario</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="optionalTelEdit" id="optionalTelEdit" placeholder="Numero">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Cumpleaños</label>
                <div class="col-sm-10">
                    <input type="date" name="cumpleañosEdit" class="form-control" id="cumpleañosEdit" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-10">
                    <input type="text" name="correoEdit" class="form-control" id="correoEdit" placeholder="email">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnActualizar" class="btn btn-success" data-toggle="modal">
        Editar Datos
    </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="d-none">
  <table>
    <tr id="cloneTr">
      <td id="id"></td>
      <td id="name"></td>
      <td id="nombreAcudiente"></td>
      <td id="direccion"></td>
      <td id="tel"></td>
      <td id="tel2"></td>
      <td id="birthday"></td>
      <td id="email"></td>
      <td id="type_document"></td>
      <td id="document"></td>
      <td id="idHuellero"></td>
      <td id="idSucursal"></td>
      <td id="numeroInscripcion"></td>
    </tr>
  </table>
</div>
<script src="<?echo base_url() ?>assets/js/directorio.js?<?echo time_unix(); ?>"></script>
<!--Aca acaba la tabla para ver las bitacoras -->