<ul class="nav nav-pills mb-3 p-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="tabIngresos" data-toggle="pill" href="#egresoEfectivo" role="tab" aria-controls="pills-home" aria-selected="true">Efectivo</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#egresoBancos" role="tab" aria-controls="pills-profile" aria-selected="false">Bancos</a>
    </li>
</ul>
<div class="tab-content p-2" id="pills-tabContent">
    <div class="tab-pane fade show active" id="egresoEfectivo" role="tabpanel" aria-labelledby="pills-home-tab">
        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalEgresoEfectivo" data-whatever="@mdo">Agregar Nuevo Egreso</button>
        <div  id="flujoCaja" class="container-fluid">
            

        </div>
        <div class="form-group  row no-gutters">
            <label for="inputEmail3" class="col-sm-1 col-form-label">Desde:</label>
            <div class="col-sm-2 mr-2">
                <input type="date" class="form-control" id="inicioFiltroDateEgresosEfectivo" placeholder="YYYY-MM-DD">
            </div>
            <label for="inputEmail3" class="col-sm-0 col-form-label mr-2">Hasta:</label>
            <div class="col-sm-2 mr-2">
                <input type="date" class="form-control" id="finFiltroDateEgresosEfectivo" placeholder="YYYY-MM-DD"  >
            </div>
            <div class="col-sm-0 mr-2">
                <button type="button" class="btn btn-primary" id="botonFiltrarEgresosEfectivo">
                    <i class="fas fa-search"></i>
                </button> 
            </div>
            <div class="col-sm-3 mr-2 ml-2"> 
                <input type="text"  class="form-control" id="dineroEgresos" placeholder="Dinero" readonly>
            </div>
    </div>
        <table class="table table-striped table-hover table-responsive" id="tablaEgresosEfectivo">
            <thead class="thead-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Responsable</th>
                    <th>Valor</th>
                    <th>Factura PDF</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <tr id="trClone">
                    <th scope="row" id="fecha"></th>
                    <td id="categoria"></td>          
                    <td id="descripcion"></td>
                    <td id="responsable"></td>
                    <td id="valor"></td>
                    <td id="factura">
                        <button type="button" value ="" class="btn btn-success btn-sm" id="diagrama1">
                            Factura
                            <i class="far fa-file-pdf ml-2"></i>
                        </button>
                    </td>
                    <td class="d-inline-flex">
                        <?php if ($level==1 ): ?>
                            <button type="button" id="borrarEgresoEfectivo" class="btn btn-danger ml-4" value=''>
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif ?>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="egresoBancos" role="tabpanel" aria-labelledby="pills-profile-tab">
        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalEgresoBancos" data-whatever="@mdo">Agregar Nuevo Egreso</button>
        <div  id="flujoCajaBanco" class="container-fluid">
            

            </div>
        <div class="form-group  row no-gutters ">
            <label for="inputEmail3" class="col-sm-1 col-form-label">Mostrar Desde :</label>
            <div class="col-sm-3 mr-2 mb-2">
                <input type="date" class="form-control" id="inicioFiltroDateEgresosBanco" placeholder="YYYY-MM-DD">
            </div>
            <label for="inputEmail3" class="col-sm-0 col-form-label mr-2">Hasta:</label>
            <div class="col-sm-3 mr-2">
                <input type="date" class="form-control" id="finFiltroDateEgresosBanco" placeholder="YYYY-MM-DD">
            </div>
            <div class="col-sm-0 mr-2">
                <button type="button" class="btn btn-primary" id="botonFiltrarEgresosBanco">
                    <i class="fas fa-search"></i>
                </button> 
            </div>
            <div class="col-sm-2 mr-2 ml-2"> 
                <input type="text"  class="form-control" id="dineroEgresosBanco" placeholder="Dinero" readonly>
            </div>
        </div>
        <table class="table table-striped table-hover table-responsive" id="tablaEgresosBanco">
            <thead class="thead-dark">
                <tr >
                    <th id="fecha">Fecha</th>
                    <th id="concepto">Concepto Gasto</th>
                    <th id="banco">Banco</th>
                    <th id="descripcion">Descripcion</th>
                    <th id="valor">Valor</th>
                    <th id="accionesEgreso">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr id="trClone1">
                    <th scope="row" id="fecha"></th>
                    <td id="concepto"></td>  
                    <td id="banco"></td>         
                    <td id="descripcion"></td>
                    <td id="valor"></td>
                    <td class="d-inline-flex">
                        <?php if ($level==1 ): ?>
                            <button type="button" id="borrarEgresoBanco" class="btn btn-danger ml-4" value=''>
                              <i class="fas fa-trash"></i>
                            </button>
                        <?php endif ?>
                    </td>
                </tr>  
            </tbody>
        </table>   
    </div>
</div>
<!-- Modal para agregar un nuevo ingreso En la pag de boostrap esta para colocar la peticion ajax y cambiar los textos con jquery-->
<div class="modal fade" id="modalEgresoEfectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Egreso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formEgresoEfectivo">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Valor Egreso: <span id="valEgresoFormated">0</span></label>
                <input name="valorEgresoEfectivo"type="number" class="form-control" id="valorEgresoEfectivo">
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <label class="mr-sm-2" for="categoriaEgresoEfectivo">Categoria:</label>
                    <select name="categoriaEgresoEfectivo"class="custom-select mr-sm-2" id="categoriaEgresoEfectivo">
                        <option selected>Seleccione...</option>
                        <option value="Inversion">Inversion</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Papeleria y utiles">Papeleria y utiles</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Transporte">Transporte</option>
                        <option value="Nomina">Nomina</option>
                        <option value="Viaticos">Viaticos</option>
                        <option value="Gastos Financieros">Gastos Financieros</option>
                        <option value="Otros">Otros</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-form-label">Descripcion Egreso:</label>
                <textarea name="descripcionEgresoEfectivo"class="form-control" id="descripcionEgresoEfectivo"></textarea>
            </div>
            <div class="form-group">
                <label  class="col-form-label">Responsable:</label>
                <input type="text" name="responsableEgresoEfectivo"class="form-control" id="responsableEgresoEfectivo">
            </div>
            <button type="submit" class="btn btn-primary" id="addEgresoEfectivo">Agregar</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
        </div>
        </div>
    </div>
</div>
<!-- Aca se acaba el modal para agregar un nuevo ingreso-->

<!-- Modal para agregar un nuevo Gasto En la pag de boostrap esta para colocar la peticion ajax y cambiar los textos con jquery-->
<div class="modal fade" id="modalEgresoBancos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Gasto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formEgresoBanco">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Valor Egreso: <span id="valEgresoFormated2">0</span></label>
                <input name="valorEgresoBanco" type="number" class="form-control" id="valorEgresoBanco">
            </div>
            <div class="form-group">
                <label  class="col-form-label">Banco:</label>
                <input name="bancoEgreso"type="text" class="form-control" >
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Concepto</label>
                    <select name="conceptoEgresoBanco"class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option selected>Seleccione...</option>
                        <option value="Inversion">Inversion</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Papeleria y Utiles">Papeleria y utiles</option>
                        <option value="Servicios">Servicios</option>
                        <option value="Transporte">Transporte</option>
                        <option value="Nomina">Nomina</option>
                        <option value="Viaticos">Viaticos</option>
                        <option value="Gastos Financieros">Gastos Financieros</option>
                        <option value="Otros">Otros</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Descripcion :</label>
                <textarea name="descripcionEgresoBanco"class="form-control" id="message-text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="addEgresoBanco">Agregar</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            
        </div>
        </div>
    </div>
</div>
<script src="<?echo base_url() ?>assets/js/egresos.js?<?echo time_unix(); ?>"></script>
<!-- Aca se acaba el modal para agregar un nuevo ingreso-->



<button type="hidden" hidden data-toggle="modal" data-target=".bd-example-modal-lg" id="abrirModalDiagrama1"></button>
<!-- Modal para ver el archivo pdf de la hoja de vida usuario -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <h2>Factura</h2>
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
