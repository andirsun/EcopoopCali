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
    setTitulo();
    
});
function addRequisito(){
    $('#addRequisito').submit(function(e){  
        e.preventDefault();
		var form = $(this);
		var data = $(form).serialize();
        $.ajax({
            url: base_url + 'admin_ajax/addRequisito',
            type: 'GET',
            dataType: 'json',
            data:data,
            beforeSend: function () {
            },
            success: function (r) {
               alert(r.content[0]);
            },
            error: function (xhr, status, msg) {
                console.log(xhr.responseText);
            }
        });
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
