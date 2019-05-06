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
});
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
		$(tr).find("#ProyectoRequerimientos").attr('href', base_url+'admin/nav/requerimientos/'+el.id);
		$(tr).find("#ProyectoRequerimientos").attr('value', el.id);
		str += $(tr).prop('outerHTML');
	});
	return str;
}