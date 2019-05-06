var userLevel;
var sucursalActive;
$(function(){
	//setActive();
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
