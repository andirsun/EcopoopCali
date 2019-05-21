<div class="container" id="titulo">
</div>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Requisitos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Añadir</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <table class="table table-striped table-hover table-responsive" id="tablaRequisitos">
            <thead class="thead-dark">
                <tr id="trClone2">
                    <th>ID</th>
                    <th>Creacion</th>
                    <th>Nombre </th>
                    <th>Descripcion</th>
                    <th>Documentos</th>
                    <th >Acciones</th>
                </tr>
            </thead>
            <tbody>  
                <tr id="trClone">
                    <th scope="row"  id="idRequisito"></th>
                    <td id="Creacion"></td>
                    <td id="Nombre"></td>
                    <td id="Descripcion"></td>
                    <td>Documentos</td>
                    <td class="d-inline-flex d-none">
                        <button type="button" id="editarRequisito" class="btn btn-warning mr-3" value=''>
                            <i class="fas fa-edit"></i>
                        </button>
                        <!--<?php if ($level==0 || $level==4): ?>
                            <button type="button" id="borrarUsuario" class="btn btn-danger" value=''>
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif ?>-->
                        <a href="#" id="proyectoRequerimientos" target="_blank" class="btn btn-primary" value=''>
                        <i class="fas fa-tasks"></i>
                        </a>
                    </td>
                </tr> 
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form class="form-group" id="addRequisito"addPackageInstrument>

            <div class="row">
                <fieldset class="form-group col-sm-1">
                    <label>ID Requisito</label>
                    <input type="number" min="1" class="form-control" name="idReq" id="idReq" placeholder="Ex 001" required>
                </fieldset>		
                <fieldset class="form-group col-sm-2">
                    <label>Version</label>
                    <input type="number" class="form-control" name="versionReq" id="versionReq" placeholder="Number" >
                </fieldset>	
                <fieldset class="form-group m-0 col-sm-2">
                    <label>Tipo</label>
                    <select id="tipoReq" name="tipoReq" class="form-control" required>
                        <option value="">--Selecciona el tipo--</option>
                        <option value="funcional">Funcional</option>
                        <option value="noFuncional">No Funcional</option>
                        <option value="Restriccion">Restriccion</option>
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
                    <textarea type="text" class="form-control" name="dependenciaReq" id="dependenciaReq" placeholder="Escribe los requisitos de los que depende" required></textarea>
                </fieldset>
                <fieldset class="form-group col-sm-2">
                    <label>Interfaz</label>
                    <textarea type="text" class="form-control" name="interfazReq" id="interfazReq" placeholder="Escribe si depende de una interfaz grafica"></textarea>
                </fieldset>	
            </div>
            <div class="row mt-2">
                <fieldset class="form-group m-0 col-sm-2">
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
                <fieldset class="form-group m-0 col-sm-2">
                    <label>Prioridad Para el desarrollo</label>
                    <select id="prioridadReq" name="prioridadReq" class="form-control" required>
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
<button type="hidden" hidden data-toggle="modal" data-target=".bd-example-modal-lg" id="btn-open-modal-cv"></button>
<!-- Modal para ver el archivo pdf de la hoja de vida usuario -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <h2>Hoja de vida</h2>
      <iframe src="" id="iframe-pdf" class="mb-2" style="display:none;width:100%;height:400pt;" frameborder="0"></iframe>
      <form class="d-inline-block mt-4" id="form-file-cv">
        <input type="hidden" id="idTeacher">
        <div class="d-flex mb-2">
          <input type="file" name="file" id="file-cv" class="file-cv" accept="application/pdf" required>
          <label for="file-cv" class="label-cv">
            <span class="one-file">1 archivo</span>
            <i class="fas fa-file-upload mr-1"></i>
            Seleccionar archivo
          </label>
          <button type="submit" class="btn btn-success rounded-0">
            <i class="fas fa-save mr-1"></i> Guardar 
          </button>
          <button type="button" class="ml-1 btn btn-danger rounded-0" id="clearInputFileCv">
            <i class="fas fa-eraser mr-1"></i> Limpiar
          </button>
        </div>
        <div class="progress-bard-file" id="progress" style="display: none;"></div>
<!--         <span class="num-files" id="file-cv-info">
          nombre del archivo
        </span> -->
      </form>
    </div>
  </div>
</div>
<script>
	var idProyecto = '<? echo $idProyect ?>';
</script>
<script src="<?echo base_url() ?>assets/js/requisitos.js?" type="text/javascript"></script>
