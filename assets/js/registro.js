$(function(){ 	
	console.log(666);
	registrar();
});

function registrar(){
	$('#formRegistrar').submit(function(e){
		e.preventDefault();
		var form = this;
		var data = $(this).serialize();
		var btn = $(this).find('button');
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