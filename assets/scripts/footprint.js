$(document).ready(function() {
    function crearCuerpoTablaCaptahuellas(data){
        var dataSet = [];
        data.forEach(function(element, i) {
          var row = [];
          var fecha = moment(element.LOG_TIME);
          var fecha_unix = fecha.unix();
          fecha = fecha.format('DD/MM/YYYY');
          row.push(fecha_unix);
          row.push(fecha);
          dataSet.push(row);
        });
        return(dataSet);
    }
    function crearTablaCaptahuellas(selector, data){
        dTableFootprint = $(selector).DataTable({
            data: data,
            "order": [[0, "desc"]],
            "pageLength": 25,
            columns: [
                { title: "Fecha UNIX" },
                { title: "Fecha" }
            ],
            "language": {
                "url": "extras/SpanishDatatable.json"
            },
            "bDestroy": true
        });
    }
    function searchFootprintAJAX(data){
        $.ajax({
            url: app_url+"footprint/footprint/searchFootprint",
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response){
                console.log(response);
                /*dataSet = crearCuerpoTablaCaptahuellas(response);
                console.log('asdas', dataSet);
                crearTablaCaptahuellas('#footprint-result-list-table',dataSet);
                $("#sfootprint-result-list").css("display","block");*/
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    $("#search-footprint").click(function () {
        start_date = $('#start_date').val();
        start_time = $('#start_time').val();
        end_date = $('#end_date').val();
        end_time = $('#end_time').val();
        department = $('#sfootprint-department').find(":selected").val();
        employee = $('#sfootprint-employee').find(":selected").val();
        console.log(start_date,start_time,end_date,end_time,department,employee);
        var data = {
            start_date: start_date,
            start_time: start_time,
            end_date: end_date,
            end_time: end_time,
            department: department,
            employee: employee
        };
        if(employee === ''){
            alert('Debe seleccionar un empleado');
        }else{
            searchFootprintAJAX(data);
        }        
    });
    function buscarEmpleados(department, callback){
        $.ajax({
            url: app_url+"footprint/footprint/searchEmployees",
            type: "POST",
			data: {
                department: department,
                returnAjax: true,
            },
			dataType: "json",
			success: function (response) {
                console.log(response);
                callback(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log("Request: " + JSON.stringify(jqXHR));
				console.log("Error: " + JSON.stringify(textStatus));
				console.log("Error: ", errorThrown);
			}
		});
    }
    $("#sfootprint-department").change(function(){
        var department = $(this).val();
        buscarEmpleados(department, function(response){
            var options = '<option value="">- Empleados -</option>';
			if (response.length > 0) {
				response.forEach(function (element, i) {
					options += "<option value=\"" + element.USER_ID + "\">" + element.FIRST_NAME + " " + element.LAST_NAME + "</option>";
				});
			}
			$("#sfootprint-employee").html(options);
        });
    });
});