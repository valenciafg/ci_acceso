$(document).ready(function() {
    $('body').on('change', '#user-search', function() {
        var user = $(this).val();
        var guid = $(this).find(':selected').attr('data-guid');
        var default_select = $("#access-content").find('.ui.dropdown.selection');
        $("#user-access").val([]);
        if(!default_select.hasClass("disabled")){
            $("#user-access").html('<option>Accesos</option>');
            default_select.addClass('disabled');
        }
        $.ajax({
            url: app_url+"doors/doors/getUserTerminalAccess",
            type: "POST",
            data: {'user_id':user,'guid':guid},
            dataType: "json",
            success: function(data){
                if(data.error===false){
                    var options = accessOptions(data.access);
                    var select = $("#access-content").find('.ui.disabled.dropdown.selection');
                    select.removeClass('disabled');
                    $("#user-access").html(options);
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
    function accessOptions(result){
        var options = '<option>Accesos</option>';
        var tam = result.length;
        for (var i = 0; i < tam; i++) {
            options += '<option value="'+result[i].tp_term_id+'" data-name="'+result[i].tp_term_name+'" data-guid="'+result[i].tp_guid+'">'+result[i].tp_term_name+'</option>';
        }
        return options;
    }
    var usersSelector = $('#user-result-list-table');
    var usersTable = createDataTable(usersSelector);
    $("#search-users").click(function () {
        var user_id = $('#user-search').find(":selected").val();
        var access_selector = $('#user-access').find(":selected");
        var door_name = access_selector.attr("data-name");
        $.ajax({
            url: app_url+"doors/doors/searchEventByUsersAndAccess",
            type: "POST",
            data: {'user_id':user_id,'door_name':door_name},
            dataType: "json",
            beforeSend: function(){
                $("#users-loading").show();
            },
            success: function(data){
                $("#users-loading").hide(1000);
                if (data.error===true) {
                    showErrorMessage('#users-message',data.msg,5000);
                }else{
                    destroyDataTable(usersTable);
                    var events = createDoorsEventsResultBody(data.events);
                    $("#user-result-list-body").html(events);
                    usersTable = createDataTable(usersSelector);
                    $("#users-result-list").show();
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });
});
