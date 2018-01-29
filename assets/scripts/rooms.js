$(document).ready(function () {
    /**
     * Seccion de operadores
     */
    var operatorsTable = $('#operatorsTable');
    var operatorsDTTable = createOperatorsDTTable(operatorsTable);

    function createOperatorsDTTable(selector) {
        if (selector.length > 0) {
            var table = selector.DataTable({
                "order": [
                    [0, "asc"]
                ],
                "pageLength": 10,
                "language": {
                    "url": "extras/SpanishDatatable.json"
                },
                "bDestroy": true
            });
            return table;
        }
        return false;
    }

    function getOperatorData(data, callback) {
        $.ajax({
            url: app_url + "rooms/rooms/searchOperators",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (response) {
                callback(response);
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }

    function getDepartments(callback) {
        var dp = null;
        if(typeof arguments[2] !== 'undefined'){
            dp = arguments[2];
        }
        $.ajax({
            url: app_url + "footprint/footprint/searchDepartment",
            type: "POST",
            data: arguments[1],
            dataType: "json",
            success: function (response) {
                callback(response, dp);
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    function getStatus(args,callback){
        $.ajax({
            url: app_url + "rooms/rooms/searchStatus",
            type: "POST",
            data: args,
            dataType: "json",
            success: function (response) {
                callback(response);
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    function getAvailability(args,callback){
        $.ajax({
            url: app_url + "rooms/rooms/searchAvailability",
            type: "POST",
            data: args,
            dataType: "json",
            success: function (response) {
                callback(response);
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    function handleDepartmentResponse(response, dp) {
        var options = '<option value="">[Seleccione]</option>';
        var sw = false;
        response.forEach(function (element, i) {
            if (dp === element.DEPARTMENT_CODE) {
                options += "<option value=\""+element.DEPARTMENT_CODE+"\" selected>"+element.DEPARTMENT_NAME+"</option>";
                $sw = true;
            } else {
                options += "<option value=\""+element.DEPARTMENT_CODE+"\">"+element.DEPARTMENT_NAME+"</option>";
            }
        });
        $("select[name=departamento]").html(options);
        if(!sw){
            $("select[name=departamento]").val('03');
        }
    }
    $('body').on('click', '.edit-operator-btn', function (e) {
        var id = $(this).attr("data-id");
        var data = {
            id: id
        };
        getOperatorData(data, function (response) {
            response = response[0];
            var department = response.department;
            $("input[name=codigo]").val(response.code);
            $("input[name=nombre]").val(response.name);
            $("input[name=id]").val(response.id);
            $("input[name=estatus][value=" + response.status + "]").prop('checked', true);
            var args = {
                returnAjax: true
            };
            getDepartments(handleDepartmentResponse, args, department);
        });
        $('#operators-edit-modal').modal('show');
    });
    function saveOperatorData(data){
        $.ajax({
            url: app_url + "rooms/rooms/saveOperatorData",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response){
                    alert('Operador modificado con exito');
                    location.reload();
                }else{
                    alert('Error al editar operador');
                }
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
                alert('Error al editar operador');
            }
        });
    }
    $('body').on('click','.guardar-edit-operator-btn', function(e){
        var form_data = $("#edit-operator-form").serialize();
        var data = {
            returnAjax: true
        };
        form_data = form_data + "&" + $.param(data);
        saveOperatorData(form_data);
    });
    /**
     * Seccion tipos de eventos
    */
    var eventTypesTable = $('#eventTypesTable');
    var eventTypesDTTable = createEventTypesDTTable(eventTypesTable);

    function createEventTypesDTTable(selector) {
        if (selector.length > 0) {
            var table = selector.DataTable({
                "order": [
                    [0, "asc"]
                ],
                "pageLength": 25,
                "language": {
                    "url": "extras/SpanishDatatable.json"
                },
                "bDestroy": true
            });
            return table;
        }
        return false;
    }
    /**
     * Seccion Agregar Event Type
     */
    $('body').on('click', '.add-event-type-btn', function (e) {
        $('#event-type-add-modal').modal('show');
        var args = {
            returnAjax: true
        };
        getDepartments(function(response){
            var options = '<option value="">[Seleccione]</option>';
            response.forEach(function (element, i) {
                options += "<option value=\""+element.DEPARTMENT_CODE+"\">"+element.DEPARTMENT_NAME+"</option>";
            });
        $("select[name=aet_departament]").html(options);
        }, args);
    });
    $('body').on('keypress','#aet_description',function(){
        if(this.value.length > 160){
            return false;
        }
        $("#add-counter-value").html(38 - this.value.length);
    });
    function validateEventCode(){
        var code = $("input[name=aet_codigo]").val();
        var description = $("input[name=aet_description]").val();
        var sw = true;
        var msg = '';
        if(code.length !== 3){
            sw = false;
            msg += 'Debe ingresar solo numero. ';
        }else{
            if(!code.match(/^[0-9]+$/)){
                sw = false;
                msg += 'La longitud del codigo debe ser tres (3). ';
            }
        }
        if(description.length < 1){
            sw = false;
            msg += 'Debe ingresar una descripcion. ';
        }
        if(!sw){
            alert(msg);
        }
        return sw;
    }
    function saveEventTypeData(data){
        $.ajax({
            url: app_url + "rooms/rooms/saveEventTypeData",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log('reps', response);
                if(response){
                    alert('Tipo de evento agregado con exito');
                    location.reload();
                }else{
                    alert('Error al agregar tipo de evento');
                }
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
                alert('Error al agregar tipo de evento');
            }
        });
    }
    $('body').on('click','.guardar-add-event-type-btn', function(e){
        if(validateEventCode()){
            var form_data = $("#add-event-type-form").serialize();
            var data = {
                returnAjax: true
            };
            form_data = form_data + "&" + $.param(data);
            saveEventTypeData(form_data);
        }
    });
    /**
     * Seccion editar Event Type
     */
    function getEvenTypeData(args, callback){
        $.ajax({
            url: app_url + "rooms/rooms/getEvenTypeData",
            type: "POST",
            data: args,
            dataType: "json",
            success: function (response) {
                callback(response);
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    function handleEditEventTypeDepartment(response, dp){
        var options = '<option value="">[Seleccione]</option>';
        var sw = false;
        response.forEach(function (element, i) {
            if (dp === element.DEPARTMENT_CODE) {
                options += "<option value=\""+element.DEPARTMENT_CODE+"\" selected>"+element.DEPARTMENT_NAME+"</option>";
                $sw = true;
            } else {
                options += "<option value=\""+element.DEPARTMENT_CODE+"\">"+element.DEPARTMENT_NAME+"</option>";
            }
        });
        $("select[name=eet_departament]").html(options);
        if(!sw){
            $("select[name=eet_departament]").val('03');
        }
    }
    $('body').on('click', '.edit-event-type-btn', function (e) {
        var id = $(this).attr('data-id');
        var dp = $(this).attr('data-dp');
        $("input[name=eet_id]").val(id);
        var args = {
            event: id,
            returnAjax: true
        };
        getEvenTypeData(args, function(response){
            if(response.length > 0){
                response = response[0];
                $("input[name=eet_codigo]").val(response.eventCode);
                $("input[name=eet_description]").val(response.description);
                $("#counter-value").html(38 - response.description.length);
                var args = {
                    returnAjax: true
                };
                getDepartments(handleEditEventTypeDepartment, args, response.department);
                // console.log(response);
                if(response.clasification !== null){
                    $("select[name=eet_clasification]").val(response.clasification);
                }
                getStatus(args, function(response){
                    var options = '<option value="">[Seleccione]</option>';
                    response.forEach(function (element, i) {
                        options += "<option value=\""+element.id+"\">"+element.Name+"</option>";
                    });
                    $("select[name=eet_status]").html(options);
                });
                if(response.status !== null){
                    $("select[name=eet_status]").val(response.status);
                }
                getAvailability(args, function(response){
                    var options = '<option value="">[Seleccione]</option>';
                    response.forEach(function (element, i) {
                        options += "<option value=\""+element.id+"\">"+element.name+"</option>";
                    });
                    $("select[name=eet_availability]").html(options);
                });
                if(response.availability !== null){
                    $("select[name=eet_availability]").val(response.availability);
                }
            }
        });
        $('#event-type-edit-modal').modal('show');
    });
    $('body').on('keypress','#eet_description',function(){
        if(this.value.length > 160){
            return false;
        }
        $("#counter-value").html(38 - this.value.length);
    });
    function saveEditEventTypeData(data){
        $.ajax({
            url: app_url + "rooms/rooms/saveEditEventTypeData",
            type: "POST",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log('reps', response);
                if(response){
                    alert('Tipo de evento modificado con exito');
                    location.reload();
                }else{
                    alert('Error al editar tipo de evento');
                }
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
                alert('Error al editar tipo de evento');
            }
        });
    }
    $('body').on('click', '.guardar-edit-event-type-btn', function(e){
        var form_data = $("#edit-event-type-form").serialize();
        var data = {
            returnAjax: true
        };
        form_data = form_data + "&" + $.param(data);
        console.log(form_data);
        saveEditEventTypeData(form_data);
    });    
    /**
     * Seccion buscar eventos
     */
    function crearCuerpoTablaEventos(data){
        var dataSet = [];
        data.forEach(function(element, i) {
          var row = [];
          var fecha = moment(element.regDate);
          var fecha_unix = fecha.unix();
          fecha = fecha.format('DD/MM/YYYY HH:mm:ss');
          row.push(i+1);
          row.push(element.roomExtension);
          row.push(element.roomName);
          row.push(element.Type);
          row.push(element.clasification);
          row.push(element.DEPARTMENT_NAME);
          row.push(element.alias);
          row.push(element.name);
          row.push(fecha_unix);
          row.push(fecha);
          dataSet.push(row);
        });
        return(dataSet);
    }
    function crearTablaEventos(selector, data){
        dTableFootprint = $(selector).DataTable({
            data: data,
            "order": [[9, "desc"]],
            "pageLength": 25,
            columns: [
                { title: "#" },
                { title: "Ext." },
                { title: "Habitacion" },
                { title: "Eventos" },
                { title: "Clasificacion" },
                { title: "Departamento" },
                { title: "Personal" },
                { title: "Nombre Pers." },
                { title: "Fecha UNIX" },
                { title: "Fecha" }
            ],
            "columnDefs": [
                { "visible": false, "targets": [8] },
              ],
            "language": {
                "url": "extras/SpanishDatatable.json"
            },
            "bDestroy": true
        });
    }
    function searchroomevents(){
        var start_date = $("#sevent_start_date").val();
        var start_time = $("#sevent_start_time").val();
        var end_date = $("#sevent_end_date").val();
        var end_time = $("#sevent_end_time").val();
        var room = $("#sevent-room").val();
        var operator = $("#sevent-operators").val();
        var start = start_date+' '+start_time+':00';
        start = moment(start,'D-M-YYYY H:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        var end = end_date+' '+end_time+':59';
        end = moment(end,'D-M-YYYY H:mm:ss').format('YYYY-MM-DD HH:mm:ss');
        var data = {
            returnAjax: true,
            start: start,
            end: end,
            room: room,
            operator: operator
        };
        $.ajax({
            url: app_url + "rooms/rooms/searchroomevents",
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function(){
                $("#room-event-loading").css('display','block');
                $("#room-event-message").css('display','none');
                $("#room-event-message").html('');
                $("#room-event-list").css('display','none');
              },
            success: function (response) {
                $("#room-event-loading").css('display','none');
                // console.log('reps', response, response.length);
                if(response.length > 0){
                    dataSet = crearCuerpoTablaEventos(response);
                    crearTablaEventos('#roomEventsTable', dataSet);
                    $("#room-event-list").css('display','block');
                }else{
                    $("#room-event-message").css('display','block');
                    $("#room-event-message").html('Busqueda sin resultados');
                }
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    var roomEventsTable = $("#roomEventsTable");
    if(roomEventsTable.length > 0){
        searchroomevents();
    }
    $("#search-room-event").click(function(){
        searchroomevents();
    });
});