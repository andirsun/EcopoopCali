var userLevel;
var sucursalActive;
$(function(){
	setActive();
	toggleMenu();
	getLevelUser();
	getHeadquarters();
	closeListHeadquarters();
	// getActiveHeadquarter();
	changeHeadquarter();
	$('#loadModal').click(function(event) {
		loadModal('titulo 666','<h1>body 666</h1>','btn popo');
	});
});

function closeListHeadquarters() {
	$("#btn-close-headquarters").click(function(event) {
		$("#content-headquarters").removeClass('open');
		$("body").removeClass('overflow-hidden');
	});
}
function changeHeadquarter() {
	$("#content-list-headquartes").on('click', 'button#btn-change-headquarter', function(event) {
		var btn = this;
		var data = {
			idSucursal: $(btn).attr('headquarter')
		};
		console.log(data);
		$.ajax({
			url: base_url+'admin_ajax/changeSucursal',
			type: 'GET',
			dataType: 'json',
			data: data,
			beforeSend:function() {
				var loader = '<i class="fa fa-spin fa-spinner"></i> iniciando...';
				$(btn).prop('disabled', true);
				$(btn).html(loader);
			},
			success:function(r) {
				console.log(r);
				if(r.response == 2) {
					$("#content-headquarters").addClass('reload');
					setTimeout(function () {
						window.location.reload();
					}, 400);
				}
			},
			error:function(xhr, status, msg) {
				$(btn).prop('disabled', false);
				$(btn).text('iniciar');
				console.log(xhr.responseText);
			}
		});
	});
}
function getLevelUser() {
	$.ajax({
		url: base_url+'admin_ajax/getLevelCurrentUser',
		type: 'GET',
		dataType: 'json',
		beforeSend: function() {},
		success: function(r) {
			console.log(r);
			if(r.response == 2) {
				if(isNaN(r.content)) {
					userLevel = r.content;
					if(userLevel == 0) {
						$("#item-sucursal").removeAttr('style');
					} else {
						$("#item-sucursal").remove()
					}
				}
			}
		},
		error: function(xhr , status, msg) {
			console.log(xhr.responseText);
		}
	});
}
function getHeadquarters() {
	$("#btnHeadquaters").click(function(event) {
		$("#content-headquarters").addClass('open');
		$("body").addClass('overflow-hidden');
		$.ajax({
			url: base_url+'admin_ajax/getSucursales',
			type: 'GET',
			dataType: 'json',
			beforeSend: function() {},
			success: function(r) {
				console.log(r);
				if(r.response == 2) {
					var listHeadquarters = r.content;
					var str = '';
					if(listHeadquarters.length) {
						$.each(listHeadquarters, function(index, headquarter) {
							var cardClone = $("#card-headquarter").clone();
							$(cardClone).attr('id', 'headquarter-'+headquarter.id);
							$(cardClone).find('button#btn-change-headquarter').attr('headquarter', headquarter.id);
							// $(cardClone).find('#imag-head').attr('src', 'https://upload.wikimedia.org/wikipedia/commons/0/07/Sucursal_BCP_Bolivia.jpg');
							$(cardClone).find('#title-card').text(headquarter.name);
							// $(cardClone).find('#text-card').text('some text');
							str += $(cardClone).prop('outerHTML');
						});
					} else {
						str = '<h2 class="no-headquarters"></h2>';
					}
					$("#content-list-headquartes").html(str);
					getActiveHeadquarter();				
				}
			},
			error: function(xhr, status, msg) {
				console.log(xhr.responseText);
			}
		});
	});
}
function getActiveHeadquarter() {
	$.ajax({
		url: base_url+'admin_ajax/getSucursalActive',
		type: 'GET',
		dataType: 'json',
		async: false,
		beforeSend: function() {},
		success: function(r) {
			console.log(r);
			if(r.response == 2) {
				var idHeadquarter = r.content[0].id;
				console.log($("#content-list-headquartes").find('#headquarter-'+idHeadquarter+' #isActive'));
				$("#content-list-headquartes").find('#headquarter-'+idHeadquarter+' #isActive').addClass('active');
				$("#content-list-headquartes").find('#headquarter-'+idHeadquarter+' button').prop('disabled', true);
			}
		},
		error: function(xhr, status, msg) {
			console.log(xhr.responseText);
		}
	});	
}
function setActive(){
	$('a.nav-link[data-active="'+active+'"]').addClass('active');
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
function loadModal(title='', body='', btnCancel=''){
	var modal = $('#mainModal');
	if(title!=''){
		$(modal).find('#titleModal').html(title);
	}
	if(body!=''){
		$(modal).find('#bodyModal').html(body);
	}
	if(btnCancel!=''){
		$(modal).find('#btnOk').text(btnCancel);
	}
	$(modal).modal('show');
}
function CloseModal(){
	$('#mainModal').modal('hide');
}