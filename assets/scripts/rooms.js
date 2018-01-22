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
});