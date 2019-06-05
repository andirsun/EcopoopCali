<h1>Contribuidores del Proyecto <?php echo $idProyect?></h1>
<!--
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Frontend de la aplicacion con php y html
-->
<form class="form-inline" id="searchUser">
  <div class="form-group mb-2">
    <label for="staticEmail2" class="sr-only">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Usuario para Vincular : ">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Password</label>
    <input type="text" name="nomContribuyente" class="form-control" id="nomContribuyente" placeholder="Nombre Usuario">
  </div>
  <button type="submit" class="btn btn-success btn-sm mb-2">Buscar y Vincular <i class="fas fa-search"></i> </button>
</form>
<a href="https://www.sigere.site/admin/registro" type="button" id="añadirContribuidor" class="btn btn-success btn-sm mb-2" value=''>
    Crear usuario
    <i class="fas fa-user-plus fa-lg"></i>
</a>
<table class="table table-striped table-hover table-responsive" id="tablaContribuidores">
    <thead class="thead-dark">
        <tr >
            <th>ID</th>
            <th>Inscripcion</th>
            <th>Nombre </th>
            <th>Apellido </th>
            <th>Correo</th>
            <th >Acciones</th>
        </tr>
    </thead>
    <tbody>  
        <tr id="trCloneContribuidores">
            <th scope="row"  id="idUsuario"></th>
            <td id="inscripcion"></td>
            <td id="nombre"></td>
            <td id="apellido"></td>
            <td id="correo"></td>
            <td class="d-inline-flex d-none">
                <?php if ($level==1): ?>
                <button type="button" id="borrarContribuidor" class="btn btn-danger btn-sm" value=''>
                        <i class="fas fa-trash"></i>
                </button>
                <?php endif ?>
                </td>
        </tr> 
    </tbody>
</table>

<script>
	var idProyecto = '<? echo $idProyect ?>';
</script>
<script src="<?echo base_url() ?>assets/js/contribuidores.js?" type="text/javascript"></script>