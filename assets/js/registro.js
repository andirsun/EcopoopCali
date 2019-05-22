$(function(){ 	
	console.log(6666);
	registrar();
	//getProyects();
});

function registrar(){
	$('#formRegistrar').submit(function(e){
		e.preventDefault();
		var form = this;
		var data = $(this).serialize();
		var btn = $(this).find('button');
		var nombre = $("#name").val();
		var contraseña = $("#email").val();
		var correo = $("#pass").val("value");
		var idProyecto = $("#proyect").attr("value");
		$.ajax({
			url: base_url+'admin_ajax/addUsuario',
			type: 'GET',
			dataType: 'json',
			data: data,
			beforeSend:function(){
				console.log("aqui voy");
			},
			success:function(r){
				if(r.response==2){
					alert("Usuario añadido con exito")
				}else{
					alert("Error Al añadir");
				}
				console.log(r);
			},
			error:function(xhr, status, msg){
				console.log(xhr.responseText);
			}
		});
	});
}
function getProyects(){
	$.ajax({
		url: base_url+'admin_ajax/getProyects',
		type: 'GET',
		dataType: 'json',
		beforeSend:function(){
		},
		success:function(r){
			console.log(r.content);
			var select = $('select#proyect');
			var str = '<option value="" selected>Seleccione...</option>';
			if(r.response==2){
				$.each(r.content,function(index, el){
					str += '<option value="'+el.idProyecto+'">'+el.nombre+'</option>';
				});
				$(select).html(str);
			}
			// console.log(r);
		},
		error:function(xhr, status, msg){
			console.log(xhr.responseText);
		}
	});
}
/*(function($) {

    $(".toggle-password").click(function() {

        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

})(jQuery);
*/