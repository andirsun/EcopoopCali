var userLevel;
var sucursalActive;
$(function(){
	setNombreSesion();
	toggleMenu();
	console.log("hola");
	cargarRequerimiento();
	actualizarRequerimiento();

	//getLevelUser();
	//getHeadquarters();
	//closeListHeadquarters();
	// getActiveHeadquarter();
	//changeHeadquarter();
	//$('#loadModal').click(function(event) {
	//	loadModal('titulo 666','<h1>body 666</h1>','btn popo');
	//});
});
function actualizarRequerimiento(){
	$('#formEditRequisito').submit(function(e){  
        e.preventDefault();
		var formulario = $(this);
		var datos = $(formulario).serialize();
        
        console.log("datos",datos);
        $.ajax({
            url: base_url + 'admin_ajax/updateRequisito',
            type: 'GET',
            dataType: 'json',
            data:datos,
            beforeSend: function () {
            },
            success: function (r) {
                console.log("Respuesta ",r);
                if(r.response == 2){
                    alert("Requisito Actualizado Con exito");
                }
				

            	
            },
            error: function (xhr, status, msg) {
				console.log(xhr.responseText);
			}
        });
    });
}

function cargarRequerimiento(){
	
	$.ajax({
		url: base_url+'admin_ajax/editarRequisitosFuncionales',
		type: 'GET',
		dataType: 'json',
		data:{id:idReq},
		beforeSend:function() {
			
		},
		success:function(r) {
			console.log(r);
			$("#editIdRequisito").attr('placeholder',r.content.idRequisito);
			$("#editDescripcionRequisito").attr('placeholder',r.content.descripcion);
			$("#editDependenciaRequisito").attr('placeholder',r.content.dependencia);
			$("#editVersionRequisito").attr('placeholder',r.content.version);
			$("#editEstadoRequisito").attr('placeholder',r.content.estado);
		},
		error:function(xhr, status, msg) {
			console.log(xhr.responseText);
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
function toggleMenu(){
	$('#toggleMenu').click(function(){
		var btn = $(this);
		var s = parseInt($(btn).attr('data-status'));
		var menu = $('#sidebar');
		if(s==0){
			$(menu).animate({
				'left': '0',
			},250,function(){
				$(btn).attr('data-status',1);
			});
		}else{
			$(menu).animate({
				'left': '-100%',
			},250,function(){
				$(btn).attr('data-status',0);
			});
		}
	});
}
