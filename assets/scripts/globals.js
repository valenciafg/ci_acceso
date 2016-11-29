var protocol = window.location.protocol;
var host = window.location.host;
var path = window.location.pathname;
var base = protocol+"//"+host;
var app_name = window.location.pathname.substr(0,window.location.pathname.lastIndexOf('/'));
var app_url = base+app_name+'/';
var base_url = protocol+"//"+host+path;

$(document).ready(function() {
    function showErrorMessage(selector,msg,time){
        $(selector).html("<div class=\"ui negative message\"><i class=\"close icon\"></i><div class=\"header\">Error!</div><p>"+msg+"</p></div>");
        $(selector).show(1000).delay(time).fadeOut();
    }
    window.showErrorMessage = showErrorMessage;
    function showSuccessMessage(selector,msg,time){
        $(selector).html("<div class=\"ui success message\"><i class=\"close icon\"></i><div class=\"header\">Éxito!</div><p>"+msg+"</p></div>");
        $(selector).show(1000).delay(time).fadeOut();
    }
    window.showSuccessMessage = showSuccessMessage;

    function createDoorsEventsResultBody(result){
        var body = '';
        var tam = result.length;
        var event_type = '';
        var event_datetime;
        var event_datetime_formated;
        var fname;
        var lname;
        var user;
        for (var i = 0; i < tam; i++) {
            event_datetime = moment(result[i].x_timestamp);
            event_datetime_formated = event_datetime.format('DD-MM-YYYY HH:mm:ss');
            if(result[i].x_fname){
               fname = result[i].x_fname;
            }else{
                fname = ' ';
            }
            if(result[i].x_lname){
                lname = result[i].x_lname;
            }else{
                lname = ' ';
            }
            user = fname+' '+lname;
            if(result[i].x_hist_type === 35){
                event_type = "<div class='ui red label'>Acceso Denegado</div>";
            }else{
                event_type = "<div class='ui green label'>Puerta Abierta</div>";
            }
            body += '<tr>';
            body +=     '<td>'+result[i].x_term_name+'</td>';
            body +=     '<td>'+user+'</td>';
            body +=     '<td>'+event_type+'</td>';
            body +=     '<td>'+event_datetime_formated+'</td>';
            body += '</tr>';
        }
        return body;
    }
    window.createDoorsEventsResultBody = createDoorsEventsResultBody;

    function createDataTable(selector){
        if(selectorExist(selector)) {
            var table = selector.DataTable({
                "order": [[3, "desc"]],
                "language": {
                    "url": "extras/SpanishDatatable.json"
                }
            });
            return table;
        }
        return false;
    }
    window.createDataTable = createDataTable;

    function destroyDataTable(table_var){
        table_var.destroy();
    }
    function selectorExist(selector){
        return (selector.length>0);
    }
    window.destroyDataTable = destroyDataTable;

    function reinitialiseDataTable(selector,table_var){
        destroyDataTable(table_var);
        return createDataTable(selector);
    }
    window.reinitialiseDataTable = reinitialiseDataTable;

    var lastDoorMov = $('#lastDoorMov');
    var lastDoorMovTable = createDataTable(lastDoorMov);

    function updateDefaultTable(){
        $.ajax({
            url: app_url+"main/main/getLastActionsAJAX",
            type: "POST",
            dataType: "json",
            success: function(data){
                console.log(data);
                if(data.error === false){
                    destroyDataTable(lastDoorMovTable);
                    var events = createDoorsEventsResultBody(data.events);
                    $("#lastDoorMov-body").html(events);
                    lastDoorMovTable = createDataTable(lastDoorMov);
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    if($("#lastDoorMov").length>0){
        setInterval(updateDefaultTable, 30000);
    }
});