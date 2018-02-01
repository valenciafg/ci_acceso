var protocol = window.location.protocol;
var host = window.location.host;
var path = window.location.pathname;
var base = protocol+"//"+host;
var app_name = window.location.pathname.substr(0,window.location.pathname.lastIndexOf('/'));
var app_url = base+app_name+'/';
var base_url = protocol+"//"+host+path;

$(document).ready(function() {
    /**
     * Default Error Message
     * @param selector: jQuery Selector
     * @param msg: Body Message
     * @param time: Time on show
     */
    function showErrorMessage(selector,msg,time){
        $(selector).html("<div class=\"ui negative message\"><i class=\"close icon\"></i><div class=\"header\">Error!</div><p>"+msg+"</p></div>");
        $(selector).show(1000).delay(time).fadeOut();
    }
    window.showErrorMessage = showErrorMessage;
    /**
     * Default Success Message
     * @param selector
     * @param msg
     * @param time
     */
    function showSuccessMessage(selector,msg,time){
        $(selector).html("<div class=\"ui success message\"><i class=\"close icon\"></i><div class=\"header\">Éxito!</div><p>"+msg+"</p></div>");
        $(selector).show(1000).delay(time).fadeOut();
    }
    window.showSuccessMessage = showSuccessMessage;
    /**
     * Create HTML table body to Doors data
     * @param result
     * @returns {string}
     */
    function createDoorsEventsResultBody(result){
        var body = '';
        var tam = result.length;
        var event_type = '';
        var event_datetime;
        var unix_event_datetime;
        var event_datetime_formated;
        var fname;
        var lname;
        var user;
        for (var i = 0; i < tam; i++) {
            event_datetime = moment(result[i].x_timestamp);
            unix_event_datetime = event_datetime.unix();
            event_datetime_formated = event_datetime.format('DD/MM/YYYY hh:mm:ss A');
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
                if(result[i].x_hist_type === 33) {
                    event_type = "<div class='ui green label'>Tarjeta Inválida</div>";
                }else{
                    if(result[i].x_hist_type === 37){
                        event_type = "<div class='ui orange label'>Fuera de Horario</div>";
                    }else{//68
                        event_type = "<div class='ui green label'>Puerta Abierta</div>";
                    }
                }
            }
            body += '<tr>';
            body +=     '<td>'+result[i].x_term_name+'</td>';
            body +=     '<td>'+user+'</td>';
            body +=     '<td>'+event_type+'</td>';
            body +=     '<td data-order="'+unix_event_datetime+'">'+event_datetime_formated+'</td>';
            body += '</tr>';
        }
        return body;
    }
    window.createDoorsEventsResultBody = createDoorsEventsResultBody;
    /**
     *
     * @param data
     */
    function createPermissionTableBody(data){
        var body = '';
        var tam = data.length;
        var created_datetime;
        var unix_created_datetime;
        var created_datetime_formated;
        var fname;
        var lname;
        var department;
        for (var i = 0; i < tam; i++) {
            created_datetime = moment(data[i].c_s_timestamp);
            unix_created_datetime = created_datetime.unix();
            created_datetime_formated = created_datetime.format('DD/MM/YYYY');
            fname = data[i].c_fname;
            lname = data[i].c_lname;
            department = data[i].dept_name;
            if(department === null)
                department = 'Sin asignar';
            body += '<tr>';
            body +=     '<td>'+fname+'</td>';
            body +=     '<td>'+lname+'</td>';
            body +=     '<td>'+department+'</td>';
            body +=     '<td data-order="'+unix_created_datetime+'">'+created_datetime_formated+'</td>';
            body += '</tr>';
        }
        return body;
    }
    window.createPermissionTableBody = createPermissionTableBody;
    /**
     * Create a DataTable
     * @param selector
     * @returns {*}
     */
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
    /**
     * Create a default DataTable Object
     * @param selector jQuery Selector
     * @param orderArray default Order Array
     * @returns {*}
     */
    function createCallsDataTable(selector,orderArray){
        if(selectorExist(selector)) {
            var table = selector.DataTable({
                "order": orderArray,
                "language": {
                    "url": "extras/SpanishDatatable.json"
                }
            });
            return table;
        }
        return false;
    }
    window.createCallsDataTable = createCallsDataTable;
    /**
     * Destroy a single DataTable object
     * @param table_var
     */
    function destroyDataTable(table_var){
        table_var.destroy();
    }
    function selectorExist(selector){
        return (selector.length>0);
    }
    window.destroyDataTable = destroyDataTable;
    /**
     *
     * @param selector
     * @param table_var
     * @returns {*}
     */
    function reinitialiseDataTable(selector,table_var){
        destroyDataTable(table_var);
        return createDataTable(selector);
    }
    window.reinitialiseDataTable = reinitialiseDataTable;

    /**
     * get the time to resfresh last move table
     */
     function getGeneralUpdateTime(callback){
         $.ajax({
             url: app_url + "settings/settings/getGeneralUpdateTimeAjax",
             type: "POST",
             dataType: "json",
             async: false,
             success: function(response){callback(response.time);},
             error: function(request, error) { callback(30);}
         });
     }
     window.getGeneralUpdateTime = getGeneralUpdateTime;
     var generalRefreshTime = 30000;
     getGeneralUpdateTime(function(response){
         generalRefreshTime = response * 1000;
     });
    var lastDoorMov = $('#lastDoorMov');
    var lastDoorMovTable = createDataTable(lastDoorMov);

    /**
     * Update Door events table via AJAX
     */
    function updateDefaultTable(){
        $.ajax({
            url: app_url+"main/main/getLastActionsAJAX",
            type: "POST",
            dataType: "json",
            success: function(data){
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
        setInterval(updateDefaultTable, generalRefreshTime);
    }
    if($("#upScrollToTop").length > 0){
        $(window).scroll(function(){
            if($(this).scrollTop() > 100){
                $("#upScrollToTop").fadeIn();
                $("#upScrollToDown").fadeOut();
            }else{
                $("#upScrollToTop").fadeOut();
                $("#upScrollToDown").fadeIn();
            }
        });
        $("#upScrollToTop").click(function(){
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
        $("#upScrollToDown").click(function(){
            $('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 800);
            return false;
        });
    }
    $(".room-level-list-item").click(function(){
        var valor = $(this).text();
        var target = $('#piso-' + valor);
        if( target.length ) {
            $('html, body').animate({
                scrollTop: target.offset().top + $("#main-menu").height()
            }, 1000);
        }
    });
});