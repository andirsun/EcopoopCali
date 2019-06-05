var dataTableOptions = {
	'language': {
		'search': 'Busqueda:',
		'zeroRecords': 'Upss, No encontramos a nadie',
		'info': 'Total Datos: _TOTAL_ ',
		'lengthMenu': "Mostrar _MENU_ entradas",
		'paginate': {
			'previous': 'Anterior',
			'next': 'Siguiente'
		}
	},
};
$(function(){ 	
	console.log(6666);
	
	getProyectos();
	registrar();
	borrarProyecto();
	//setNombreSesion();
});
function borrarProyecto(){
	$("body").on("click","#tablaProyectos #borrarProyecto",function(event){
		event.preventDefault();
		idseleccion=$(this).attr("value");
		if(confirm("Deseas Realmente Eliminar el proyecto ? ")){
			$.ajax({
				url: base_url + 'admin_ajax/borrarProyecto',
				type: 'GET',
				dataType: 'json',
				data:{id:idseleccion},
				beforeSend: function () {
					$("#tablaProyectos").dataTable().fnDestroy();
				},
				success: function (r) {
					if(r.response==2){
						alert("proyecto Eliminado");
						getProyectos();
					}else{
						alert(r.content);
					}

					
					
					//$("#editIdRequisito").attr('placeholder',idseleccion);
					
			
				},
				error: function (xhr, status, msg) {
					console.log(xhr.responseText);
				}
			});	
		}
	});
}
function setNombreSesion(){
	$.ajax({
			url: base_url+'admin_ajax/nombreSesion',
			type: 'GET',
			dataType: 'json',
			beforeSend:function() {
				
			},
			success:function(r) {
				console.log(r);
				if(r.response == 2) {
					$("#nombreUsuario").html('<i class="fas fa-user-tie fa-3x ml-3 "></i> ¡Hola!  '+r.content+'<i class="fas fa-circle mr-2 ml-2" style="color:#3ec63e"></i><b><i style="color:#3ec63e">en linea</i></b>');
					$("#nivelSesion").html('Tu nivel es '+r.nivel);
					
				}
			},
			error:function(xhr, status, msg) {
				console.log(xhr.responseText);
			}
		});
}
function getProyectos(){
	$.ajax({
		url: base_url+'admin_ajax/getProyects',
		type: 'GET',
		dataType: 'json',
		beforeSend:function(){
		},
		success:function(r){
			console.log('list Proyectos \n', r);
			var tableBody = $('#tablaProyectos').find("tbody");
			var str = buildTrProyect(r.content);
			$(tableBody).html(str);
			table = $("#tablaProyectos").DataTable(dataTableOptions);
			// console.log(table);
		},
		error:function(xhr, status, msg){
			console.log(xhr.responseText);
		}
	});
}
function registrar(){
	$('#formRegistrarProyecto').submit(function(e){
		e.preventDefault();
		var form = this;
		var data = $(this).serialize();
		var btn = $(this).find('button');
		$.ajax({
			url: base_url+'admin_ajax/addProyecto',
			type: 'GET',
			dataType: 'json',
			data: data,
			beforeSend:function(){
				console.log("aqui voy");
			},
			success:function(r){
				if(r.response==2){
                    window.location.replace(base_url+'admin/nav/proyectos');
                    alert("Añadido con Exito");
				}else{
					alert("Error Al añadir Proyecto");
				}
				console.log(r);
			},
			error:function(xhr, status, msg){
				console.log(xhr.responseText);
			}
		});
	});
}

function buildTrProyect(listProyect) {
	var str = '';
	$.each(listProyect,function(index, el){
		var tr = $(trClone).clone();
		$(tr).attr('data-id', el.id);
		$(tr).find('#idProyecto').text(el.idProyecto);
		$(tr).find('#Nombre').text(el.nombre);
		$(tr).find('#Creacion').text(el.fechaCreacion);
		$(tr).find('#Descripcion').text(el.descripcion);
		$(tr).find('#editarProyecto').attr('value', el.id);
		//$(tr).find('#borrarUsuario').attr('value', el.id);
		$(tr).find("#proyectoSRS").attr('href', base_url+'admin/nav/SRSProyect/'+el.id);
		$(tr).find("#proyectoContribuidores").attr('href', base_url+'admin/nav/contribuidoresProyect/'+el.id);
		$(tr).find("#editarProyect").attr('href', base_url+'admin/nav/editarProyect/'+el.id);
		$(tr).find("#proyectoRequerimientos").attr('href', base_url+'admin/nav/requisitosProyect/'+el.id);
		$(tr).find("#proyectoRequerimientos").attr('value', el.id);
		$(tr).find("#borrarProyecto").attr('value', el.id);

		str += $(tr).prop('outerHTML');
	});
	return str;
}