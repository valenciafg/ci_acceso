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
                "pageLength": 50,
                "language": {
                    "url": "extras/SpanishDatatable.json"
                },
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
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
                "pageLength": 50,
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
          row.push(element.guestName);
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
            "order": [[10, "desc"]],
            "pageLength": 50,
            columns: [
                { title: "#" },
                { title: "Ext." },
                { title: "Habitacion" },
                { title: "Huesped" },
                { title: "Eventos" },
                { title: "Clasificacion" },
                { title: "Departamento" },
                { title: "Personal" },
                { title: "Nombre Pers." },
                { title: "Fecha UNIX" },
                { title: "Fecha" }
            ],
            "columnDefs": [
                { "visible": false, "targets": [9] },
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
    /**
     * Seccion Room Status
     */
    var roomstatus_list = $("#room-status-card-list");
    function getRoomStatusUpdateTime(callback){
        $.ajax({
            url: app_url + "settings/settings/getRoomStatusUpdateTimeAjax",
            type: "POST",
            dataType: "json",
            async: false,
            success: function(response){callback(response.time);},
            error: function(request, error) { callback(30);}
        });
    }
    function getCheckOutTimeLimit(callback){
        $.ajax({
            url: app_url + "settings/settings/getCheckOutTimeLimitAjax",
            type: "POST",
            dataType: "json",
            async: false,
            success: function(response){callback(response.time);},
            error: function(request, error) { callback(30);}
        });
    }
    /**
     * Consulta y realiza llamada a creacion de elemetos cards
     */
    function createRoomStatusCard(){
        $.ajax({
            url: app_url+"rooms/rooms/getRoomStatus",
            type: "POST",
            data: {
                returnAjax: true
            },
            dataType: "json",
            success: function(response){
                // console.log(response);
                if(response.length > 0){
                    makeRoomStatusCards(response);
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    function handleCreateEventLoop(response){}
    /**
     * Crea dinamicamente los elementos cards para cada habitacion
     * @param {*} rooms 
     */
    function makeRoomStatusCards(rooms){
        var checkoutTimeLimit = 10;
        getCheckOutTimeLimit(function(response){
            checkoutTimeLimit = response;
        });
        var tam = rooms.length;
        var j = 0;
        var piso_anterior = '';
        var piso_actual = '';
        var cards = '';
        var is_check_out = false;
        var current_date = moment();
        var event_date;
        for(var i = 0; i < tam; i++){
            var check_out_class = '';
            is_check_out = rooms[i].statusCode == 6;
            event_date = moment(rooms[i].eventDate,'YYYY-MM-DD HH:mm:ss');
            piso_actual = rooms[i].Location;
            if(is_check_out){
                // console.log('****-****',current_date.diff(event_date,'minutes'),current_date.format('YYYY-MM-DD HH:mm:ss'),event_date.format('YYYY-MM-DD HH:mm:ss'));
                co_diff = current_date.diff(event_date,'minutes');
                if(co_diff > checkoutTimeLimit){
                    check_out_class = 'blink_me_quick';
                    var dataParams = {
                        returnAjax: true,
                        event_code:'109',
                        room: rooms[i].PhoneNumber,
                        roomName: rooms[i].roomName
                    };
                    createRoomEvent(dataParams, handleCreateEventLoop);
                }else{
                    if((co_diff >= checkoutTimeLimit/2) && (co_diff <= checkoutTimeLimit)){
                        check_out_class = 'blink_me';
                    }
                }
            }
            var availabilityClass = 'negro';
            if(rooms[i].availabilityCode !== null){
                availabilityCode = rooms[i].availabilityCode;
                switch(availabilityCode){
                    case 1:
                        availabilityClass = 'negro';
                        break;
                    case 2:
                        availabilityClass = 'verde';
                        break;
                    case 3:
                        availabilityClass = 'rojo';
                        break;
                    case 4:
                        availabilityClass = 'naranja';
                        break;
                    case 5:
                        availabilityClass = 'amarillo';
                        break;
                    default:
                        availabilityClass = 'negro';
                        break;
                }
            }
            var statusClass = 'negro';
            if(rooms[i].statusCode !== null){
                statusCode = rooms[i].statusCode;
                switch(statusCode){
                    case 1:
                        statusClass = 'verde';
                        break;
                    case 2:
                        statusClass = 'amarillo';
                        break;
                    case 3:
                        statusClass = 'azul';
                        break;
                    case 4:
                        statusClass = 'rojo';
                        break;
                    case 5:
                        statusClass = 'negro';
                        break;
                    case 6:
                        statusClass = 'naranja';
                        break;
                    case 7:
                        statusClass = 'morado';
                        break;
                    default:
                        statusClass = 'negro';
                        break;
                }
            }
            var iconClass = 'fa-bed'; 
            if(rooms[i].PhoneNumber== '304'){
                iconClass = 'fa-wheelchair-alt';
            }
            var id_piso = '';
            if(piso_actual !== piso_anterior || j === 0){
                id_piso = piso_actual.toLowerCase();
                id_piso = id_piso.replace(/ /g, '-');
                if(j !== 0){
                    cards += "</div>";
                }else{
                    id_piso = 'piso-1';                
                }
                cards += "<div id=\""+id_piso+"\" class=\"ui cards\">";
            }
            cards +=  "<div class='card'>";
            cards +=  "<div class=\"content\">";
            if(rooms[i].availabilityCode==2){//Check-in
                cards +=  "<button data-check=\"1\" data-room=\""+rooms[i].PhoneNumber+"\" data-name=\""+rooms[i].roomName+"\" class=\"ui inverted basic button check-in-btn\" style=\"margin:0;padding:0;\"><i class=\"ui left floated fa "+iconClass+" fa-2x fa-border "+availabilityClass+"\" aria-hidden=\"true\"></i></button>";
            }else{
                if(rooms[i].availabilityCode==4 || rooms[i].availabilityCode==5){//Check-out
                    cards +=  "<button data-check=\"0\" data-room=\""+rooms[i].PhoneNumber+"\" data-name=\""+rooms[i].roomName+"\" class=\"ui inverted basic button check-out-btn\" style=\"margin:0;padding:0;\"><i class=\"ui left floated fa "+iconClass+" fa-2x fa-border "+availabilityClass+"\" aria-hidden=\"true\"></i></button>";
                }else{
                    cards +=  "<i class=\"ui left floated fa "+iconClass+" fa-2x fa-border "+availabilityClass+' '+check_out_class+"\" aria-hidden=\"true\"></i>";
                }
            }            
            cards +=  "<div class=\"header borde-negro "+statusClass+"\">";
            cards += rooms[i].roomName;
            cards +=  "</div>";
            cards +=  "<div class=\"meta\">";
            cards +=  rooms[i].Location+'. Ext.: '+rooms[i].PhoneNumber;
            cards += "</div>";
            cards += "<div class=\"meta\">";
            if(rooms[i].statusCode !== null){
                cards += '<br/>'+rooms[i].statusName;
            }
            cards += "</div>";
            cards += "<div class=\"description\">";
            cards += rooms[i].eventDescription!==null?rooms[i].eventDescription:'';
            if(rooms[i].availabilityCode !== null){
                cards += '<br/><br/><div style="text-align:center;">'+rooms[i].availabilityName+'</div>';
            }
            cards += "</div>";
            cards += "</div>";
            cards += "</div>";
            piso_anterior = rooms[i].Location;
            j++;
        }
        $("#room-status-card-list").html(cards);
    }
    if(roomstatus_list.length > 0){
        var refreshTime = 30000;
        getRoomStatusUpdateTime(function(response){
            refreshTime = response * 1000;
        });
        
        createRoomStatusCard();
        setInterval(createRoomStatusCard, refreshTime);
    }
    /**
     * 
     * @param {*} selector 
     */
    function createCheckEvent(selector){
        var check = selector.attr('data-check');
        var room = selector.attr('data-room');
        var name = selector.attr('data-name');
        $("#check-room").val(room);
        $("#check-code").val(check);
        $("#check-name").val(name);
        if(check==="1"){
            $("#add-check-header").html('Nuevo Check-In');
            $("#check-confirm-message").html("¿Desea crear el check-in para la habitacion "+room+"?");
        }else{
            $("#add-check-header").html('Nuevo Check-Out');
            $("#check-confirm-message").html("¿Desea crear el check-out para la habitacion "+room+"?");
        }
        $("#add-check-event-modal").modal('show');
    }
    $("body").on('click','.check-in-btn', function(){
        createCheckEvent($(this));
    });
    $("body").on('click','.check-out-btn', function(){
        createCheckEvent($(this));
    });
    function createRoomEvent(data,callback){
        $.ajax({
            url: app_url+"rooms/rooms/createRoomEvent",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response){
                console.log(response);
                callback(response);
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    $("body").on('click','.add-check-save-button', function(){
        var check = $("#check-code").val();
        var room = $("#check-room").val();
        var name = $("#check-name").val();
        var data = {
            returnAjax: true,
            check_type: check,
            room: room,
            roomName: name
        };
        createRoomEvent(data, function(){
            
        });
    });
});