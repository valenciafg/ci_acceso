$(document).ready(function() {
    var doorsSelector = $('#doors-result-list-table');
    var doorsTable = createDataTable(doorsSelector);

    var door_selector;
    var door_id;
    var door_name;
    var door_guid;
    var start_date;
    var start_time;
    var end_date;
    var end_time;
    var do_again_doors = 0;

    function searchDoorMovsAJAX(){
        // console.log("estoy buscando");
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
                    if(do_again_doors < 1) {
                        do_again_doors = 1;
                        setInterval(searchDoorMovsAJAX, 20000);
                    }
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
    $("#search-doors").click(function () {
        door_selector = $('#doors-search').find(":selected");
        door_id = door_selector.val();
        door_name = door_selector.attr("data-name");
        door_guid = door_selector.attr("data-guid");
        start_date = $('#start_date').val();
        start_time = $('#start_time').val();
        end_date = $('#end_date').val();
        end_time = $('#end_time').val();
        searchDoorMovsAJAX();
    });
});
