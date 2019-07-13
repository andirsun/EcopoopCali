var dataTableOptions = {
    'language': {
        'search': 'Buscar:',
        'zeroRecords': 'Upss!!, No Encontramos Coincidencias',
        'info': 'Total de Datos: _TOTAL_ ',
        'lengthMenu': "Mostrar _MENU_ entradas",
        'paginate': {
            'previous': '<',
            'next': '>'
        }
    }

};
$(function() {
    console.log(666);
    //$('#tableEgresos').DataTable(dataTableOptions);
    //$('#tableEgresosBancos').DataTable(dataTableOptions);

    //flujoDeCajaBanco();
    //deleteEgresoEfectivo();
    //deleteEgresoBanco();
    //flujoDeCajaEfectivo();
    añadirEgresoEfectivo();
    //añadirEgresoBanco();
    //ponerEgresosEfectivoPorFecha();
    //ponerEgresosBancoPorFecha();
    getEgresosEfectivo();
    //getEgresosBancos();
    //filtrarEgresosEfectivo();
    //filtrarEgresosBanco();
    formatoMoneda();
    verArchivo1();
    subirArchivo1();

});

function base64toBlob(base64Data, contentType) {
    contentType = contentType || '';
    var sliceSize = 1024;
    var byteCharacters = atob(base64Data);
    var bytesLength = byteCharacters.length;
    var slicesCount = Math.ceil(bytesLength / sliceSize);
    var byteArrays = new Array(slicesCount);

    for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
        var begin = sliceIndex * sliceSize;
        var end = Math.min(begin + sliceSize, bytesLength);

        var bytes = new Array(end - begin);
        for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
            bytes[i] = byteCharacters[offset].charCodeAt(0);
        }
        byteArrays[sliceIndex] = new Uint8Array(bytes);
    }
    return new Blob(byteArrays, { type: contentType });
}

function deleteEgresoEfectivo() {
    $("body").on("click", "#tablaEgresosEfectivo #borrarEgresoEfectivo", function(event) {
        var id = $(this).attr('value');
        if (confirm("Eliminar Egreso?")) {
            $.ajax({
                url: base_url + 'admin_ajax/deleteEgreso',
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $("#tablaEgresosEfectivo").dataTable().fnDestroy();
                },
                success: function(r) {
                    console.log("Egreso Eliminado");
                    getEgresosEfectivo();
                    flujoDeCajaEfectivo();
                },
                error: function(xhr, status, msg) {
                    console.log(xhr.responseText);
                }
            });
        }

    });

}

function deleteEgresoBanco() {
    $("body").on("click", "#tablaEgresosBanco #borrarEgresoBanco", function(event) {
        var id = $(this).attr('value');
        if (confirm("Eliminar Ingreso?")) {
            $.ajax({
                url: base_url + 'admin_ajax/deleteEgreso',
                type: 'GET',
                dataType: 'json',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $("#tablaEgresoBanco").dataTable().fnDestroy();
                },
                success: function(r) {
                    console.log("Egreso Eliminado");
                    getEgresosBancos();
                    flujoDeCajaBanco();
                },
                error: function(xhr, status, msg) {
                    console.log(xhr.responseText);
                }
            });
        }

    });

}

function flujoDeCajaEfectivo() {
    $.ajax({
        url: base_url + 'admin_ajax/flujoDeCajaEfectivo',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(r) {
            console.log("Ingresos Sumatoria - egresos", r.content);

            var precio = r.content;

            var contenido = "<h1> Saldo: $ " + $.number(Number(precio), 0, ',', '.') + "</h1>";
            $("#flujoCaja").html(contenido);
        },
        error: function(xhr, status, msg) {
            console.log(xhr.responseText);
        }
    });
}

function flujoDeCajaBanco() {
    $.ajax({
        url: base_url + 'admin_ajax/flujoDeCajaBanco',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(r) {
            console.log("Ingresos Sumatoria - egresos", r.content);

            var precio = r.content;

            var contenido = "<h1> Saldo: $ " + $.number(Number(precio), 0, ',', '.') + "</h1>";
            $("#flujoCajaBanco").html(contenido);
        },
        error: function(xhr, status, msg) {
            console.log(xhr.responseText);
        }
    });
}

function añadirEgresoEfectivo() {
    $("#formEgresoEfectivo").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var data = $(form).serialize();
        $.ajax({
            url: base_url + 'admin_ajax/addEgresoEfectivo',
            type: 'GET',
            dataType: 'json',
            data: data,
            beforeSend: function() {
                //$("#tablaEgresosEfectivo").dataTable().fnDestroy();//Toca Hacer esto para que no aparezca el error de  DataTables warning: table id={id} - Cannot reinitialise DataTable.
            },
            success: function(r) {
                location.reload(true);
                //getEgresosEfectivo();
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            },
            complete: function() {
                $(form)[0].reset();
            }
        });

    });
}

function añadirEgresoBanco() {
    $("#formEgresoBanco").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var data = $(form).serialize();
        $.ajax({
            url: base_url + 'admin_ajax/addEgresoBanco',
            type: 'GET',
            dataType: 'json',
            data: data,
            beforeSend: function() {
                //$("#tablaEgresosEfectivo").dataTable().fnDestroy();//Toca Hacer esto para que no aparezca el error de  DataTables warning: table id={id} - Cannot reinitialise DataTable.
            },
            success: function(r) {
                location.reload(true);
                //$("#tablaEgresosBanco").dataTable().fnDestroy();//Toca Hacer esto para que no aparezca el error de  DataTables warning: table id={id} - Cannot reinitialise DataTable.
                ///getEgresosBancos();
                //flujoDeCajaBanco();

            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            },
            complete: function() {
                $(form)[0].reset();
            }
        });
    });
}

function ponerEgresosEfectivoPorFecha() {
    var dateIncio = new Date();
    //var lastDay = new Date(date.getFullYear(), date.getMonth() , date.getDay());
    //var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var day = dateIncio.getDate();
    var month = dateIncio.getMonth() + 1;
    var year = dateIncio.getFullYear();
    if (month < 10) month = "0" + month; //formato que se vea de dos digitos
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    var firstDay = year + "-" + month + "-" + "01";
    $("#inicioFiltroDateEgresosEfectivo").val(firstDay);
    $("#finFiltroDateEgresosEfectivo").val(today);
    $("#botonFiltrarEgresosEfectivo").on("click", function(event) {
        var fechaInicio = $("#inicioFiltroDateEgresosEfectivo").val();
        var fechaFin = $("#finFiltroDateEgresosEfectivo").val();
        $.ajax({
            url: base_url + 'admin_ajax/calcularDineroEgresos',
            type: 'GET',
            dataType: 'json',
            data: {
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            beforeSend: function() {

            },
            success: function(r) {
                //console.log("Ingresos Sumatoria",r.content);
                var precio = r.content[0].valor;
                var contenido = "Saldo: $" + $.number(precio, 0, '', '.') + " Pesos.";
                $("#dineroEgresos").val(contenido);
                //$("#dineroEgresos").val(r.content[0].valor);	

            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            }
        });
    });
}

function ponerEgresosBancoPorFecha() {
    var dateIncio = new Date();
    //var lastDay = new Date(date.getFullYear(), date.getMonth() , date.getDay());
    //var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var day = dateIncio.getDate();
    var month = dateIncio.getMonth() + 1;
    var year = dateIncio.getFullYear();
    if (month < 10) month = "0" + month; //formato que se vea de dos digitos
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    var firstDay = year + "-" + month + "-" + "01";
    $("#inicioFiltroDateEgresosBanco").val(firstDay);
    $("#finFiltroDateEgresosBanco").val(today);
    $("#botonFiltrarEgresosBanco").on("click", function(event) {
        var fechaInicio = $("#inicioFiltroDateEgresosBanco").val();
        var fechaFin = $("#finFiltroDateEgresosBanco").val();
        $.ajax({
            url: base_url + 'admin_ajax/calcularDineroEgresosBanco',
            type: 'GET',
            dataType: 'json',
            data: {
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            beforeSend: function() {

            },
            success: function(r) {
                var precio = r.content[0].valor;
                var contenido = "Saldo: $" + $.number(precio, 0, '', '.') + " Pesos.";
                $("#dineroEgresosBanco").val(contenido);
                //$("#dineroEgresosBanco").val(r.content[0].valor);	
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            }
        });
    });

}

function getEgresosEfectivo() {
    $.ajax({
        url: base_url + 'admin_ajax/getEgresosEfectivo',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            //$("#tablaEgresosEfectivo").dataTable().fnDestroy();
        },
        success: function(r) {
            console.log('list users \n', r);
            var tableBody = $('#tablaEgresosEfectivo').find("tbody");
            var str = buildTrUserEfectivo(r.content);
            $(tableBody).html(str);
            table = $("#tablaEgresosEfectivo").DataTable({
                "order": [
                    [1, "desc"]
                ]
            });
            //flujoDeCajaEfectivo();
            //console.log(table);
        },
        error: function(xhr, status, msg) {
            console.log(xhr.responseText);
        }
    });
}

function getEgresosBancos() {
    $.ajax({
        url: base_url + 'admin_ajax/getEgresosBancos',
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {
            $("#tablaEgresosBanco").dataTable().fnDestroy();
        },
        success: function(r) {
            console.log('list Egresos \n', r);
            var tableBody = $('#tablaEgresosBanco').find("tbody");
            var str = buildTrUserBanco(r.content);
            $(tableBody).html(str);
            table = $("#tablaEgresosBanco").DataTable(dataTableOptions);
            flujoDeCajaBanco();
            console.log(table);
        },
        error: function(xhr, status, msg) {
            console.log(xhr.responseText);
        }
    });
}

function filtrarEgresosEfectivo() {
    $("#botonFiltrarEgresosEfectivo").on("click", function(event) {
        console.log("Click Boton Filtrar Egresos");
        var fechaInicio = $("#inicioFiltroDateEgresosEfectivo").val();
        var fechaFin = $("#finFiltroDateEgresosEfectivo").val();
        console.log(fechaInicio);
        console.log(fechaFin);
        $.ajax({
            url: base_url + 'admin_ajax/filtrarEgresosEfectivo',
            type: 'GET',
            dataType: 'json',
            data: {
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            beforeSend: function() {
                $("#tablaEgresosEfectivo").dataTable().fnDestroy(); //Toca Hacer esto para que no aparezca el error de  DataTables warning: table id={id} - Cannot reinitialise DataTable.
            },
            success: function(r) {
                console.log('list users \n', r);
                var tableBody = $('#tablaEgresosEfectivo').find("tbody");
                var str = buildTrUserEfectivo(r.content);
                $(tableBody).html(str);
                table = $("#tablaEgresosEfectivo").DataTable(dataTableOptions);
                console.log(table);
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            }
        });
    });
}

function filtrarEgresosBanco() {
    $("#botonFiltrarEgresosBanco").on("click", function(event) {
        console.log("Click Boton Filtrar Egresos");
        var fechaInicio = $("#inicioFiltroDateEgresosBanco").val();
        var fechaFin = $("#finFiltroDateEgresosBanco").val();
        console.log(fechaInicio);
        console.log(fechaFin);
        $.ajax({
            url: base_url + 'admin_ajax/filtrarEgresosBanco',
            type: 'GET',
            dataType: 'json',
            data: {
                fechaInicio: fechaInicio,
                fechaFin: fechaFin
            },
            beforeSend: function() {
                $("#tablaEgresosBanco").dataTable().fnDestroy(); //Toca Hacer esto para que no aparezca el error de  DataTables warning: table id={id} - Cannot reinitialise DataTable.
            },
            success: function(r) {
                console.log('list users \n', r);
                var tableBody = $('#tablaEgresosBanco').find("tbody");
                var str = buildTrUserBanco(r.content);
                $(tableBody).html(str);
                table = $("#tablaEgresosBanco").DataTable(dataTableOptions);
                console.log(table);
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            }
        });
    });
}

function formatoMoneda() {
    $("#valorEgresoEfectivo").keyup(function(event) {
        var val = Number($(this).val());
        $("#valEgresoFormated").text($.number(val, 0, '', '.'));
    });
    $("#valorEgresoBanco").keyup(function(event) {
        var val = Number($(this).val());
        $("#valEgresoFormated2").text($.number(val, 0, '', '.'));
    });
}

function subirArchivo1() {
    $("#formDiagrama1").submit(function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData();
        formData.append('idEgreso', $(form).find('#idRequisito').attr('value'));
        formData.append('file', $(form).find('input[type=file]').prop('files')[0]);
        var classCss = '';
        var textMsgResponse = '';
        console.log(formData);
        $.ajax({
            url: base_url + 'admin_ajax/enviarDiagrama1',
            type: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(form).find('input').prop('disabled', true);
                $(form).find('button').prop('disabled', true);
            },
            /*
            xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            //$(form).find("#progress").fadeIn('slow');
            if(myXhr.upload){
            	myXhr.upload.addEventListener('progress',function(e){
            				if(e.lengthComputable){
            					var max = e.total;
            					var current = e.loaded;
            					var Percentage = (current * 100)/max;
            					$(form).find("#progress").css('width', Percentage+'%');
            					$(form).find("#progress").text((Percentage).toFixed(2)+'% completado');
            				}  
            			}, false);
            }
            return myXhr;
			
            },
            */
            success: function(r) {
                console.log(r);
                if (r.response == 2) {
                    classCss = 'alert-success';
                    textMsgResponse = 'Guardado correctamente, para verlo por favor cierra y vuelve abrilo';
                } else {
                    classCss = 'alert-danger';
                    textMsgResponse = 'Ups!, No se pudo guardar :(';
                }
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
                classCss = 'alert-danger';
                textMsgResponse = 'Ups!, ocurrio un error no se pudo guardar :(';
            },
            complete: function() {
                $(form)[0].reset();
                $(form).find('input').prop('disabled', false);
                $(form).find('button').prop('disabled', false);
                /*
                $(form).find("#progress").fadeOut('fast', function() {
                	$(form).find("#progress").text('');
                	$(form).find("#progress").removeAttr('style');
                	$(form).find("#progress").fadeOut('fast');
                });
                */
                $("#msg-cv").addClass(classCss);
                $("#msg-cv").text(textMsgResponse);
                $("#msg-cv").fadeIn('fast', function() {
                    setTimeout(function() {
                        $("#msg-cv").fadeOut('fast', function() {
                            $("#msg-cv").removeClass(classCss);
                            $("#msg-cv").text('');
                        });
                    }, 5000);
                });
            }
        });
    });
}

function verArchivo1() {
    $("body").on('click', 'button#diagrama1', function(evt) {
        var btn = this;
        var btnContent = $(btn).html();
        var idRequisito = $(btn).attr('value');
        $("#formDiagrama1 #idRequisito").attr('value', idRequisito);
        $.ajax({
            url: base_url + 'admin_ajax/getDiagrama1',
            type: 'GET',
            dataType: 'json',
            data: { idRequisito: idRequisito },
            beforeSend: function() {
                var loader = '<i class="fa fa-spin fa-spinner"></i>';
                $(btn).html(loader);
                $(btn).prop('disabled', true);
            },
            success: function(r) {
                console.log(r);
                if (r.response == 2) {
                    if (r.file) {
                        $("#iframe-pdf").fadeIn('fast', function() {
                            var pdfBlob = base64toBlob(r.file, 'application/pdf');
                            var url = URL.createObjectURL(pdfBlob);
                            $("#iframe-pdf").attr('src', url);
                        });
                    } else {
                        $("#iframe-pdf").fadeOut(0);
                    }
                    $("#abrirModalDiagrama1").trigger('click'); //esto abre el modal
                }
            },
            error: function(xhr, status, msg) {
                console.log(xhr.responseText);
            },
            complete: function() {
                $(btn).html(btnContent);
                $(btn).prop('disabled', false);
            }
        });
    });
}

function buildTrUserEfectivo(listUser) {
    var str = '';
    $.each(listUser, function(index, el) {
        var tr = $("#trClone").clone();
        //if (el.conceptoIngreso == null) {
        //	el.conceptoIngreso = "No Hay concepto";
        //}
        //$(tr).removeAttr('id');
        $(tr).find('#fecha').text(el.date);
        $(tr).find('#categoria').text(el.category);
        $(tr).find('#descripcion').text(el.description);
        $(tr).find('#responsable').text(el.person);
        $(tr).find('#valor').text($.number(Number(el.value), 0, '', '.'));
        $(tr).find('#borrarEgresoEfectivo').attr('value', el.id);
        $(tr).find('#diagrama1').attr('value', el.id);
        str += $(tr).prop('outerHTML');
    });
    return str;
}

function buildTrUserBanco(listUser) {
    var str = '';
    $.each(listUser, function(index, el) {
        var tr = $("#trClone1").clone();
        //var birthday = '--';
        //if(el.birthday != "0000-00-00" && el.birthday != null) {
        //	birthday = el.birthday;
        //}
        //$(tr).removeAttr('id');
        $(tr).find('#fecha').text(el.fecha);
        $(tr).find('#concepto').text(el.tipo);
        $(tr).find('#descripcion').text(el.concepto);
        $(tr).find('#valor').text($.number(Number(el.valor), 0, '', '.'));
        $(tr).find('#borrarEgresoBanco').attr('value', el.id);
        //$(tr).find('#borrarUsuario').attr('value', el.id);

        str += $(tr).prop('outerHTML');
    });
    return str;
}