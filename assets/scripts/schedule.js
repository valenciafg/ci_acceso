$(document).ready(function() {
    var scheduleSelector = $('#schedule-result-list-table');
    var scheduleTable = createDataTable(scheduleSelector);
    $("#search-schedule").click(function () {
        var schedule_form = $('#schedule-form').serialize();
        $.ajax({
            url: app_url+"doors/doors/searchEventsBySchedule",
            type: "POST",
            data: schedule_form,
            dataType: "json",
            beforeSend: function(){
                $("#schedule-loading").show();
            },
            success: function(data){
                $("#schedule-loading").hide(1000);
                if (data.error===true) {
                    showErrorMessage('#schedule-message',data.msg,5000);
                }else{
                    destroyDataTable(scheduleTable);
                    var events = createDoorsEventsResultBody(data.events);
                    $("#schedule-result-list-body").html(events);
                    scheduleTable = createDataTable(scheduleSelector);
                    $("#schedule-result-list").show();
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
});
