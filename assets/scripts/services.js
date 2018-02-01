$(document).ready(function() { 
    var services_menu = $(".services-menu");
    if(services_menu.length > 0){
        $('.services-menu .item').tab();
    }
    $("#cne-search").click(function(){
        $.ajax({
            url: app_url+"services/services/searchPeopleCNE",
            type: "POST",
            data: {
                returnAjax:  true,
                nacionalidad: $("#cne-nac").val(),
                cedula: $("#cne-ci").val()
            },
            dataType: "json",
            success: function(response){
                if(!response.error){
                    $(".cne-res-name").html(response.nombre);
                    $(".cne-res-ci").html(response.cedula);
                    $(".cne-res-estado").html(response.estado);
                    $(".cne-res-municipio").html(response.municipio);
                    $(".cne-res-parroquia").html(response.parroquia);
                    $(".cne-res-centro").html(response.centro);
                    $(".cne-res-direccion").html(response.direccion);
                    $(".cne-card").css('display','block');
                }
                console.log(response);
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
    $("#ivss-search").click(function(){
        var fecha_nac = $("#ivss-birth-date").val();
        var dia = moment(fecha_nac,'D-M-YYYY').format('DD');
        var mes = moment(fecha_nac,'D-M-YYYY').format('MM');
        var anho = moment(fecha_nac,'D-M-YYYY').format('YYYY');
        $.ajax({
            url: app_url+"services/services/searchIVSS",
            type: "POST",
            data: {
                returnAjax:  true,
                nacionalidad: $("#ivss-nac").val(),
                cedula: $("#ivss-ci").val(),
                dia: dia,
                mes: mes,
                anho: anho
            },
            dataType: "json",
            success: function(response){
                if(!response.error){
                    $(".ivss-res-name").html(response.nombre);
                    $(".ivss-res-ci").html(response.cedula);
                    $(".ivss-res-sexo").html(response.sexo);
                    $(".ivss-res-nacimiento").html(response.nacimiento);
                    $(".ivss-res-semanas").html(response.semanas);
                    $(".ivss-res-salarios").html(response.salarios);
                    $(".ivss-res-afiliacion").html(response.afiliacion);
                    $(".ivss-res-estatus").html(response.estatus);
                    $(".ivss-res-contingencia").html(response.contingencia);
                    $(".ivss-res-numeropatronal").html(response.numeropatronal);
                    $(".ivss-res-ingreso").html(response.ingreso);
                    $(".ivss-res-empresa").html(response.empresa);
                    $(".ivss-card").css('display','block');
                }
                console.log(response);
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
    $("#cantv-search").click(function(){
        $.ajax({
            url: app_url+"services/services/searchDebtCANTV",
            type: "POST",
            data: {
                returnAjax:  true,
                area: $("#cantv-area").val(),
                tlf: $("#cantv-tlf").val()
            },
            dataType: "json",
            success: function(response){
                if(!response.error){
                    $(".cantv-res-saldoactual").html(response.saldoactual);
                    $(".cantv-res-fechavencimiento").html(response.fechavencimiento);
                    $(".cantv-res-fechacorte").html(response.fechacorte);
                    $(".cantv-res-ultimafacturacion").html(response.ultimafacturacion);
                    $(".cantv-res-ultimopago").html(response.ultimopago);
                    $(".cantv-res-saldovencido").html(response.saldovencido);
                    $(".cantv-card").css('display','block');
                }
                console.log(response);
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
});