$(function() {
    console.log("Hola");
    //setNombreStudent();
    //setNombreSesion();
    //setNombreSucursal();
    //setActive();
    toggleMenu();
    //getLevelUser();
    //getHeadquarters();
    //closeListHeadquarters();
    // getActiveHeadquarter();
    //changeHeadquarter();
    $('#loadModal').click(function(event) {
        loadModal('titulo 666', '<h1>body 666</h1>', 'btn popo');
    });
});

function toggleMenu() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
}