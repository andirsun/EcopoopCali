<div class="container" id="titulo">
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#requisitos" role="tab" aria-controls="pills-home" aria-selected="true">Requisitos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Añadir</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="requisitos" role="tabpanel">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#reqFuncionales" role="tab" aria-controls="pills-home" aria-selected="true">Funcionales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#reqNoFuncionales" role="tab" aria-controls="pills-profile" aria-selected="false">No Funcionales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#reqRestriccion" role="tab" aria-controls="pills-contact" aria-selected="false">Restriccion</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="reqFuncionales" role="tabpanel" aria-labelledby="pills-home-tab">
                <table class="table table-striped table-hover table-responsive" id="tablaRequisitos">
                    <thead class="thead-dark">
                        <tr id="trClone2">
                            <th>ID</th>
                            <th>Creacion</th>
                            <th>Descripcion</th>
                            <th>Interfaz</th>
                            <th>Dependencia</th>
                            <th>Version</th>
                            <th>Estado</th>
                            <th>Documentos</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr id="trClone">
                            <th scope="row"  id="idRequisito"></th>
                            <td id="Creacion"></td>
                            <td id="Descripcion"></td>
                            <td id="interfaz">
                                <i id="interfazIcon" class="fas fa-edit"></i></td>
                            <td id="dependencia"></td>
                            <td id="version"></td>
                            <td id="estado">
                                <button type="button" value =""class="btn btn-danger btn-sm" id="btnEstado">
                                </button>
                            </td>
                            <td id="documentos">
                                <button type="button" value =""class="btn btn-danger btn-sm" id="diagrama1">
                                    Diagrama 1
                                    <i class="far fa-file-pdf ml-2"></i>
                                </button>
                            </td>
                            <td class="d-inline-flex d-none">
                            <?php if ($level==1): ?>
                            <a href="#" id="editarRequisitoFuncional" target="_blank" class="btn btn-warning  btn-sm" value=''>
                                Editar
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php endif ?>
                                
                                <a href="#" id="versionesRequisitos" target="_blank" class="btn btn-primary btn-sm" value=''>
                                Versiones
                                </a>
                                <?php if ($level==1): ?>
                                    <button type="button" id="borrarReqFuncional" class="btn btn-danger btn-sm" value=''>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif ?>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="reqNoFuncionales" role="tabpanel" aria-labelledby="pills-profile-tab">
                <table class="table table-striped table-hover table-responsive" id="tablaRequisitosNoFuncionales">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Creacion</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr id="trCloneNoFuncionales">
                            <th scope="row"  id="idRequisito"></th>
                            <td id="Creacion"></td>
                            <td id="Descripcion"></td>
                            <td id="estado">
                                <button type="button" value =""class="btn btn-danger btn-sm" id="btnEstado">
                                </button>
                            </td>
                            <td class="d-inline-flex d-none">
                            <?php if ($level==1): ?>
                                <button type="button" id="editarRequisito" class="btn btn-warning btn-sm" value=''>
                                    Editar
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php endif ?>
                                <?php if ($level==1): ?>
                                    <button type="button" id="borrarReqNoFuncional" class="btn btn-danger" value=''>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif ?>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="reqRestriccion" role="tabpanel" aria-labelledby="pills-contact-tab">
                <table class="table table-striped table-hover table-responsive" id="tablaRequisitosRestriccion">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Creacion</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr id="trCloneRestriccion">
                            <th scope="row"  id="idRequisito"></th>
                            <td id="Creacion"></td>
                            <td id="Descripcion"></td>
                            <td id="estado">
                                <button type="button" value =""class="btn btn-danger btn-sm" id="btnEstado">
                                </button>
                            </td>
                            <td class="d-inline-flex d-none">
                            <?php if ($level==1): ?>
                                <button type="button" id="editarRequisito" class="btn btn-warning btn-sm" value=''>
                                    Editar
                                    <i class="fas fa-edit"></i>
                                </button>
                                <?php endif ?>
                                <?php if ($level==1): ?>
                                    <button type="button" id="borrarReqRestriccion" class="btn btn-danger" value=''>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                <?php endif ?>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form class="form-group" id="addRequisito"addPackageInstrument>

            <div class="row">
                <fieldset class="form-group col-sm-2">
                    <label>ID Requisito</label>
                    <input type="number" min="1" class="form-control" name="idReq" id="idReq" placeholder="Ex 001" required>
                </fieldset>		
                <fieldset class="form-group col-sm-2">
                    <label>Version</label>
                    <input type="text" class="form-control" name="versionReq" id="versionReq" placeholder="Number" >
                </fieldset>	
                <fieldset class="form-group m-0 col-sm-3">
                    <label>Tipo</label>
                    <select id="tipoReq" name="tipoReq" class="form-control" required>
                        <option value="">--Selecciona el tipo--</option>
                        <option value="funcional">Funcional</option>
                        <option value="noFuncional">No Funcional</option>
                        <option value="restriccion">Restriccion</option>
                    </select>
                </fieldset>
            </div>
            <div class="row">
                <fieldset class="form-group col-sm-3">
                    <label>Descripcion</label>
                    <textarea type="text" class="form-control" name="descripcionReq" id="descripcionReq" placeholder="Cuenta de que se trata el requisito.." required></textarea>
                </fieldset>	
                <fieldset class="form-group col-sm-2">
                    <label>Dependencia</label>
                    <textarea type="text" class="form-control" name="dependenciaReq" id="dependenciaReq" placeholder="Escribe los requisitos de los que depende" ></textarea>
                </fieldset>
                <fieldset class="form-group col-sm-2">
                    <label>Interfaz</label>
                    <select name="interfazReq" id="interfazReq"  class="form-control" required>
                        <option value="">--Selecciona--</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                </fieldset>	
            </div>
            <div class="row mt-2">
                <fieldset class="form-group m-0 col-sm-3">
                    <label>Importancia para el Cliente</label>
                    <select id="importanciaReq" name="importanciaReq" class="form-control" required>
                        <option value="">--Selecciona--</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="media-alta">Media-Alta</option>
                        <option value="alta">Alta</option>
                        <option value="maxima">Maxima</option>
                    </select>
                </fieldset>
                <fieldset class="form-group m-0 col-sm-3">
                    <label>Prioridad Para el desarrollo</label>
                    <select id="prioridadReq" name="prioridadReq" class="form-control">
                        <option value="">--Selecciona--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </fieldset>
                <fieldset class="form-group m-0 col-sm-1">
                    <label>Proyecto</label>
                    <input type="number" class="form-control" id="idProyecto" name="idProyecto" value="<?php echo $idProyect?>" id="idProyecto" placeholder="<?php echo $idProyect?>" disabled>
                </fieldset>
            </div>
            <div class="row">
                <div class="col-sm-2 d-flex mt-3">
                    <button type="submit" class="btn btn-block btn-success align-self-end">
                        Crear Requisito
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<button type="hidden" hidden data-toggle="modal" data-target=".bd-example-modal-lg" id="abrirModalDiagrama1"></button>
<!-- Modal para ver el archivo pdf de la hoja de vida usuario -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <h2>Diagrama1</h2>
      <iframe src="" id="iframe-pdf" class="mb-2" style="display:none;width:100%;height:400pt;" frameborder="0"></iframe>
      <form class="d-inline-block mt-4" id="formDiagrama1">
        <input type="hidden" id="idRequisito">
        <div class="d-flex mb-2">
          <input type="file" name="file" id="file-cv" class="" accept="application/pdf" required>
          <!--<label for="file-cv" class="">
            <span class="one-file">1 archivo</span>
            <i class="fas fa-file-upload mr-1"></i>
            Seleccionar archivo
          </label>-->
          <button type="submit" class="btn btn-success rounded-0">
            <i class="fas fa-save mr-1"></i> Guardar 
          </button>
          <!--
          <button type="button" class="ml-1 btn btn-danger rounded-0" id="clearInputFileCv">
            <i class="fas fa-eraser mr-1"></i> Limpiar
          </button>-->
        </div>
        <!-- <div class="progress-bard-file" id="progress" style="display: none;"></div>
<!--         <span class="num-files" id="file-cv-info">
          nombre del archivo
        </span> -->
        <div id="msg-cv" class="alert" style="display: none;"></div>
      </form>
    </div>
  </div>
</div>

<button hidden id ="triggerModall" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edicion Requisito</h5>
            <button type="button" id="cargarDatos" class="btn btn-primary ">Cargar Datos</button>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formEditRequisito">
                <div class="form-group">
                    <label  class="col-form-label" value="" id="dataHead">ID: </label>
                    <input  name="editIdRequisito"class="form-control" type="number" id="editIdRequisito" placeholder=""> <!--El name se usa para poder hacer el submit del formulario-->
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
        </div>
        </div>
    </div>
</div>

<script>
	var idProyecto = '<? echo $idProyect ?>';
</script>
<script src="<?echo base_url() ?>assets/js/requisitos.js?" type="text/javascript"></script>
