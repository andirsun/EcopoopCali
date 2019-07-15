/*
Anderson Laverde 
ander.laverde.dev@gmail.com
4 de junio de 2019
Backed javascript de la autenticacion 
*/
$(function() {
    console.log("Hola desde login.js");
    autenticar();
});

function autenticar() {
    $('#formLogin').submit(function(e) {
        e.preventDefault();
        var form = this;
        var data = $(this).serialize();
        var btn = $(this).find('button');
        $.ajax({
            url: base_url + 'login/makeLogin',
            type: 'GET',
            dataType: 'json',
            data: data,
            beforeSend: function() {
                $(btn).prop('disabled', true);
                $(btn).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            success: function(r) {
                if (r.response == 2) {
                    window.location.replace(base_url + 'admin');
                } else {
                    $(form).find("#txt-login-msg").text('Datos incorrectos');
                    $(form).find("#msg-login").fadeIn('fast', function() {
                        setTimeout(function() {
                            $(form).find("#msg-login").fadeOut('fast');
                        }, 1800);
                    });
                }
                $(btn).html('Login');
                console.log(r);
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            },
            complete: function() {
                /* body... */
                (btn).html('Login');
                (btn).prop('disabled', false);
            }
        });
    });
}