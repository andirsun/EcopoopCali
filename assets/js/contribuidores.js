idProyect =idProyecto; 
/*
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Backed javascript de Contribuidores
*/
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
    getContribuidores();
    añadirContribuidor();
    borrarContribuidor()
    
});
function añadirContribuidor(){
    $('#searchUser').submit(function(e){  
        e.preventDefault();
		var formulario = $(this);
		var datoss = $(formulario).serialize();
        var nombreContribuyente =$("#nomContribuyente").val();
        var datos = {
            id: idProyect,
            nombre:nombreContribuyente

        };
        console.log("datos",datos);
        $.ajax({
            url: base_url + 'admin_ajax/asociarContribuidor',
            type: 'GET',
            dataType: 'json',
            data:datos,
            beforeSend: function () {
            },
            success: function (r) {
                console.log("Respuesta ",r);
                if(r.response == 2){
                    alert("Usuario Vinculado con exito");
                }
                else{
                    alert("Usuario No encontrado, Crea el usuario Primero");
                }
                getContribuidores();
				

            	
            },
            error: function (xhr, status, msg) {
				console.log(xhr.responseText);
			},
			complete: function() {
				$("#searchUser")[0].reset();
			}
        });
    });

}
function borrarContribuidor(){
    $("body").on("click","#tablaContribuidores #borrarContribuidor",function(event){
        idseleccion=$(this).attr("value");
        console.log("iddddd",idProyect);
        if (confirm("Deseas Borrarlo?")){
            $.ajax({
                url: base_url+'admin_ajax/borrarContribuidor',
                type: 'GET',
                dataType: 'json',
                data:{id:idseleccion,
					idProyecto:idProyect},
                beforeSend:function(){
                },
                success:function(r){
                    console.log("Eliminado");
                    getContribuidores();
                },
                error:function(xhr, status, msg){
                    console.log(xhr.responseText);
                }
            });
        }
	});

}
function getContribuidores(){
    var datos = {
		id: idProyect
	};
    $.ajax({
		url: base_url+'admin_ajax/contribuidoresPorProyecto',
		type: 'GET',
        dataType: 'json',
        data:datos,
		beforeSend:function(){
            $("#tablaContribuidores").dataTable().fnDestroy();
		},
		success:function(r){
            
            console.log('list Contribuidores \n', r);
            if(r.response==2){
                var tableBody = $('#tablaContribuidores').find("tbody");
			    var str = construirTablaContribuidores(r.content);
			    $(tableBody).html(str);
			    table = $("#tablaContribuidores").DataTable(dataTableOptions);
            }
			else{
                alert("No hay Contribuidores En este proyecto");
            }
		},
		error:function(xhr, status, msg){
			console.log(xhr.responseText);
		}
	});

}

function construirTablaContribuidores(usuarios) {
	var str = '';
	$.each(usuarios,function(index, el){
		var tr = $(trCloneContribuidores).clone();
		//$(tr).attr('data-id', el.idUser);
		$(tr).find('#idUsuario').text(el.idUser);
		$(tr).find('#apellido').text(el.apellidos);        
        $(tr).find('#nombre').text(el.nombre);
		$(tr).find('#inscripcion').text(el.date);
		$(tr).find('#correo').text(el.correo);
		//$(tr).find('#version').text(el.version);
		//$(tr).find('#estado').text(el.estado);
		//$(tr).find('#editarRequisito').attr('value', el.id);
		//$(tr).find('#diagrama1').attr('value',el.idRequisito);
		//$(tr).find('#borrarUsuario').attr('value', el.id);
		//$(tr).find("#proyectoRequerimientos").attr('href', base_url+'admin/nav/requisitosProyect/'+el.id);
		$(tr).find("#borrarContribuidor").attr('value', el.idUser);
		str += $(tr).prop('outerHTML');
	});
	return str;
}