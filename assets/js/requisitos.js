var idProyect =idProyecto; 
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
$(function () {
    console.log("Id del proyecto,",idProyecto);
	addRequisito();
	//añadirRequisitoAProyecto();
	getRequisitosFuncionales();
	getRequisitosNoFuncionales();
	setTitulo();
	subirArchivo1();
	verArchivo1();
    
});
function base64toBlob(base64Data, contentType) {
	contentType = contentType || '';
	var sliceSize = 1024;
	var byteCharacters = atob(base64Data);
	var bytesLength = byteCharacters.length;
	var slicesCount = Math.ceil(bytesLength / sliceSize);
	var byteArrays = new Array(slicesCount);
  
	for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
		var begin = sliceIndex * sliceSize;
		var end = Math.min(begin + sliceSize, bytesLength);
  
		var bytes = new Array(end - begin);
		for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
			bytes[i] = byteCharacters[offset].charCodeAt(0);
		}
		byteArrays[sliceIndex] = new Uint8Array(bytes);
	}
	return new Blob(byteArrays, { type: contentType });	
  }
function addRequisito(){
    $('#addRequisito').submit(function(e){  
        e.preventDefault();
		var formulario = $(this);
		var datos = $(formulario).serialize();
		var idProyecto =$("#idProyecto").attr('value');
        $.ajax({
            url: base_url + 'admin_ajax/addRequisito',
            type: 'GET',
            dataType: 'json',
            data:datos,
            beforeSend: function () {
            },
            success: function (r) {
				var idRequisito= r.content;
				añadirRequisitoAProyecto(idRequisito,idProyecto);

            	
            },
            error: function (xhr, status, msg) {
				console.log(xhr.responseText);
			},
			complete: function() {
				$("#addRequisito")[0].reset();
			}
        });
    });
}
function añadirRequisitoAProyecto(idRequisito,idProyecto){
	$.ajax({
		url: base_url + 'admin_ajax/addRequisitoXproyecto',
		type: 'GET',
		dataType: 'json',
		data:{idRequisito:idRequisito,
				idProyecto:idProyecto},
		beforeSend: function () {
		},
		success: function (r) {
			console.log(r.content)

			
		},
		error: function (xhr, status, msg) {
			console.log(xhr.responseText);
		}
	});
}
function setTitulo(){
    $.ajax({
		url: base_url + 'admin_ajax/nombreProyecto',
		type: 'GET',
        dataType: 'json',
        data:{
            id:idProyect
        },
		beforeSend: function () {
		},
		success: function (r) {
			console.log("Nombre Proyecto",r.content.nombre);
			var nombreProyecto = r.content.nombre;
			var contenido = "<h1> Requisitos del Proyecto ("+nombreProyecto+")</h1>";
			$("#titulo").html(contenido);
		},
		error: function (xhr, status, msg) {
			console.log(xhr.responseText);
		}
	});
}
function getRequisitosFuncionales(){
	var idProyecto = 1;
	$.ajax({
		url: base_url+'admin_ajax/getRequisitosFuncionales',
		type: 'GET',
		dataType: 'json',
		data:{idproyectoo:idProyecto
		},
		beforeSend:function(){
		},
		success:function(r){
			console.log('list Requisitos \n', r);
			var tableBody = $('#tablaRequisitos').find("tbody");
			var str = buildRequisitos(r.content);
			$(tableBody).html(str);
			table = $("#tablaRequisitos").DataTable(dataTableOptions);
			// console.log(table);
		},
		error:function(xhr, status, msg){
			console.log(xhr.responseText);
		}
	});
}
function getRequisitosNoFuncionales(){
	var idProyecto = 1;
	$.ajax({
		url: base_url+'admin_ajax/getRequisitosNoFuncionales',
		type: 'GET',
		dataType: 'json',
		data:{idproyectoo:idProyecto
		},
		beforeSend:function(){
		},
		success:function(r){
			console.log('list Requisitos \n', r);
			var tableBody = $('#tablaRequisitosNoFuncionales').find("tbody");
			var str = construirTablaRequisitosNoFuncionales(r.content);
			$(tableBody).html(str);
			table = $("#tablaRequisitosNoFuncionales").DataTable(dataTableOptions);
			// console.log(table);
		},
		error:function(xhr, status, msg){
			console.log(xhr.responseText);
		}
	});
}
function subirArchivo1() {
	$("#formDiagrama1").submit(function(event) {
		event.preventDefault();
		var form = this;
		var formData = new FormData();
		formData.append('idRequisito', $(form).find('#idRequisito').attr('value'));
		formData.append('file', $(form).find('input[type=file]').prop('files')[0]);
		var classCss = '';
		var textMsgResponse = '';
		console.log(formData);
		$.ajax({
			url: base_url+'admin_ajax/enviarDiagrama1',
			type: 'POST',
			dataType: 'json',
			data: formData,
			cache: false,
			contentType:false,
			processData: false,
			beforeSend: function() {
				$(form).find('input').prop('disabled', true);
				$(form).find('button').prop('disabled', true);
			},
			/*
			xhr: function() {
			var myXhr = $.ajaxSettings.xhr();
			//$(form).find("#progress").fadeIn('slow');
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',function(e){
							if(e.lengthComputable){
								var max = e.total;
								var current = e.loaded;
								var Percentage = (current * 100)/max;
								$(form).find("#progress").css('width', Percentage+'%');
								$(form).find("#progress").text((Percentage).toFixed(2)+'% completado');
							}  
						}, false);
			}
			return myXhr;
			
			},
			*/
			success: function(r) {
				console.log(r);
				if(r.response == 2) {
					classCss = 'alert-success';
					textMsgResponse = 'Guardado correctamente, para verlo por favor cierra y vuelve abrilo';
				} else {
					classCss = 'alert-danger';
					textMsgResponse = 'Ups!, No se pudo guardar :(';
				}
			},
			error: function(xhr, status, msg) {
				console.log(xhr.responseText);
				classCss = 'alert-danger';
				textMsgResponse = 'Ups!, ocurrio un error no se pudo guardar :(';
			},
			complete: function() {
				$(form)[0].reset();
				$(form).find('input').prop('disabled', false);
				$(form).find('button').prop('disabled', false);
				/*
				$(form).find("#progress").fadeOut('fast', function() {
					$(form).find("#progress").text('');
					$(form).find("#progress").removeAttr('style');
					$(form).find("#progress").fadeOut('fast');
				});
				*/
				$("#msg-cv").addClass(classCss);
				$("#msg-cv").text(textMsgResponse);
				$("#msg-cv").fadeIn('fast', function() {
					setTimeout(function() {
						$("#msg-cv").fadeOut('fast', function() {
							$("#msg-cv").removeClass(classCss);
							$("#msg-cv").text('');
						});
					}, 5000);
				});
			}
		});
	});
}
function verArchivo1() {
	$("body").on('click', 'button#diagrama1', function(evt) {
		var btn = this;
		var btnContent = $(btn).html();
		var idRequisito = $(btn).attr('value');
		$("#formDiagrama1 #idRequisito").attr('value', idRequisito);
		$.ajax({
			url: base_url+'admin_ajax/getDiagrama1',
			type: 'GET',
			dataType: 'json',
			data: { idRequisito: idRequisito },
			beforeSend: function() {
				var loader = '<i class="fa fa-spin fa-spinner"></i>';
				$(btn).html(loader);
				$(btn).prop('disabled', true);
			},
			success: function(r) {
				console.log(r);
				if(r.response == 2) {
					if(r.file) {					
						$("#iframe-pdf").fadeIn('fast', function() {
							var pdfBlob = base64toBlob(r.file, 'application/pdf');
							var url = URL.createObjectURL(pdfBlob);
							$("#iframe-pdf").attr('src', url);
						});
					} else {
						$("#iframe-pdf").fadeOut(0);
					}
					$("#abrirModalDiagrama1").trigger('click');//esto abre el modal
				}
			},
			error: function(xhr, status, msg) {
				console.log(xhr.responseText);
			},
			complete: function() {
				$(btn).html(btnContent);
				$(btn).prop('disabled', false);
			}
		});
	});
}
function buildRequisitos(listaRequisitos) {
	var str = '';
	$.each(listaRequisitos,function(index, el){
		var tr = $(trClone).clone();
		$(tr).attr('data-id', el.reqId);
		$(tr).find('#idRequisito').text(el.reqId);
		//$(tr).find('#Nombre').text(el.nombre);
		$(tr).find('#Creacion').text(el.agregado);
		$(tr).find('#Descripcion').text(el.descripcion);
		$(tr).find('#interfaz').text(el.interfaz);
		$(tr).find('#dependencia').text(el.dependencia);
		$(tr).find('#version').text(el.version);
		$(tr).find('#estado').text(el.estado);
		$(tr).find('#editarRequisito').attr('value', el.id);
		$(tr).find('#diagrama1').attr('value',el.idRequisito);
		//$(tr).find('#borrarUsuario').attr('value', el.id);
		//$(tr).find("#proyectoRequerimientos").attr('href', base_url+'admin/nav/requisitosProyect/'+el.id);
		//$(tr).find("#proyectoRequerimientos").attr('value', el.id);
		str += $(tr).prop('outerHTML');
	});
	return str;
}
function construirTablaRequisitosNoFuncionales(listaRequisitos) {
	var str = '';
	$.each(listaRequisitos,function(index, el){
		var tr = $(trCloneNoFuncionales).clone();
		$(tr).attr('data-id', el.idRequisito);
		$(tr).find('#idRequisito').text(el.idRequisito);
		//$(tr).find('#Nombre').text(el.nombre);
		$(tr).find('#Descripcion').text(el.descripcion);
		$(tr).find('#Creacion').text(el.agregado);
		$(tr).find('#version').text(el.version);
		$(tr).find('#estado').text(el.estado);
		$(tr).find('#editarRequisito').attr('value', el.id);
		//$(tr).find('#diagrama1').attr('value',el.idRequisito);
		//$(tr).find('#borrarUsuario').attr('value', el.id);
		//$(tr).find("#proyectoRequerimientos").attr('href', base_url+'admin/nav/requisitosProyect/'+el.id);
		//$(tr).find("#proyectoRequerimientos").attr('value', el.id);
		str += $(tr).prop('outerHTML');
	});
	return str;
}
