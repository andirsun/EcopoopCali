<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mis Proyectos</h1>
</div>
<a href="<?php echo base_url() ?>admin/nav/addProyect" class="btn btn-success mb-3">Crear Nuevo Proyecto</a>
    <table class="table table-striped table-hover table-responsive" id="tablaProyectos">
        <thead class="thead-dark">
            <tr id="trClone2">
                <th>ID</th>
                <th>Creacion</th>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th >Acciones</th>
            </tr>
        </thead>
        <tbody>  
            <tr id="trClone">
                <th scope="row"  id="idProyecto">ID</th>
                <td id="Creacion">Creacion</td>
                <td id="Nombre">Nombre </td>
                <td id="Descripcion">Descripcion</td>
                <td class="d-inline-flex d-none">
                    <a href="#" id="proyectoContribuidores" target="_blank" class="btn btn-success mr-3 btn-sm" value=''>
                        Contribuidores
                        <i class="fas fa-users"></i>
                    </a>
                    
                    <a href="#" id="proyectoSRS" target="_blank" class="btn btn-danger mr-3 btn-sm" value=''>
                        SRS
                        <i class="fas fa-file-download"></i>
                    </a>
                    <a href="#" id="editarProyect" target="_blank" class="btn btn-warning mr-3 btn-sm" value=''>
                        Editar Proyecto
                        <i class="fas fa-edit"></i>
                    </a>
                   
                    <!--<?php if ($level==0 || $level==4): ?>
                        <button type="button" id="borrarUsuario" class="btn btn-danger" value=''>
                            <i class="fas fa-trash"></i>
                        </button>
                    <?php endif ?>-->
                    <a href="#" id="proyectoRequerimientos" target="_blank" class="btn btn-primary btn-sm mr-3" value=''>
                        Requisitos
                        <i class="fas fa-tasks"></i>
                    </a>
                    
                    <button type="button" id="borrarProyecto" class="btn btn-danger btn-sm" value=''>
                            <i class="fas fa-trash"></i>
                    </button>
                    
                    </td>
            </tr> 
        </tbody>
    </table>
<!--
    <div class="d-none">
        <table>
            <tbody>
                <tr id="trClone">
                    <th scope="row" id="idProyecto"></th>
                    <td id="Nombre"></td>
                    <td id="Creacion"></td>
                    <td id="Descripcion"></td>
                    <td class="d-inline-flex">
                    <button type="button" id="editarProyecto" class="btn btn-warning" value=''>
                        <i class="fas fa-edit"></i>
                    </button>
                    <?php if ($level==0 || $level==4): ?>
                        <button type="button" id="borrarUsuario" class="btn btn-danger" value=''>
                            <i class="fas fa-trash"></i>
                        </button>
                    <?php endif ?>
                    <a href="#" id="usuarioCalendario" target="_blank" class="btn btn-primary" value=''>
                    <i class="fas fa-tasks"></i>
                    </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    --> 

    <script src="<?php echo base_url() ?>assets/js/proyectos.js?"></script>