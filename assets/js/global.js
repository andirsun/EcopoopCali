$(function() {
    console.log("Hola");
    //setNombreStudent();
    setNombreSesion();
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

function setNombreSesion() {
    $.ajax({
        url: base_url + 'admin_ajax/nombreSesion',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(r) {
            console.log(r);
            if (r.response == 2) {
                $("#nombreUsuario").append(' ¡Hola!  ' + r.content + '<i class="fas fa-circle mr-2 ml-2" style="color:#3ec63e"></i><b><i style="color:#3ec63e">en linea</i></b>');
                // $("#nivelSesion").html('Tu nivel es ' + r.nivel);

            }
        },
        error: function(xhr, status, msg) {
            console.log(xhr.responseText);
        }
    });
}