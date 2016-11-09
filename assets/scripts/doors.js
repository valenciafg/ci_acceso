$(document).ready(function() {
    var doorsSelector = $('#doors-result-list-table');
    var doorsTable = createDataTable(doorsSelector);
    $("#search-doors").click(function () {
        var door_selector = $('#doors-search').find(":selected");
        var door_id = door_selector.val();
        var door_name = door_selector.attr("data-name");
        var door_guid = door_selector.attr("data-guid");
        var start_date = $('#start_date').val();
        var start_time = $('#start_time').val();
        var end_date = $('#end_date').val();
        var end_time = $('#end_time').val();
        $.ajax({
            url: app_url+"doors/doors/searchEventByDoorAndSchedule",
            type: "POST",
            data: {
                'door_id':door_id,
                'door_name':door_name,
                'door_guid':door_guid,
                'start_date':start_date,
                'start_time':start_time,
                'end_date':end_date,
                'end_time':end_time
            },
            dataType: "json",
            beforeSend: function(){
                $("#door-loading").show();
            },
            success: function(data){
                $("#door-loading").hide(1000);
                if (data.error===true) {
                    showErrorMessage('#doors-message',data.msg,5000);
                }else{
                    destroyDataTable(doorsTable);
                    var events = createDoorsEventsResultBody(data.events);
                    $("#doors-result-list-body").html(events);
                    doorsTable = createDataTable(doorsSelector);
                    $("#doors-result-list").show();
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
});
