$(document).ready(function() {
    var user_id_to_search = 0;
    var door_name_to_search = '*';
    var user_items = $(".user-select-search").find('.item');

    var access_items = $(".access-select-search").find('.item');
    /**
     * Serach user via AJAX
     */
    function searchUsersAJAX(){
        $.ajax({
            url: app_url+"doors/doors/getUserAJAX",
            type: "POST",
            dataType: "json",
            success: function(data){
                var user_list = $('.user-select-search');
                if(data.error===false && user_list.length>0){
                    $(".user-select-search").html('');
                    var users = data.users;
                    var options = '';
                    var tam = data.users.length;
                    for(var i = 0; i < tam; i++){
                        options += '<div class="link item user-item" data-id="'+data.users[i].c_id+'" data-guid="'+data.users[i].b_guid+'">'+data.users[i].c_fname+' '+data.users[i].c_lname+'</div>';
                    }
                    $(".user-select-search").append(options);
                    user_items = $(".user-select-search").find('.item');
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }

    /**
     *  User search select (Unused)
     */
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
    if($(".user-select-search").length>0){
        setInterval(searchUsersAJAX, 20000);
    }
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
    function accessItems(result){
        var items = '';
        var tam = result.length;
        for (var i = 0; i < tam; i++) {
            items += '<div class="link item" data-id="'+result[i].tp_term_id+'" data-name="'+result[i].tp_term_name+'" data-guid="'+result[i].tp_guid+'">'+result[i].tp_term_name+'</div>';
        }
        return items;
    }

    /**
     * Search Terminal by User
     */
    $(".user-select-search").on("click", ".user-item", function(){
        var contenido = $(this).html();
        var user = $(this).data('id');
        user_id_to_search = user;
        var guid = $(this).data('guid');
        $(".access-column").hide();
        $(".access-select-search").html('');
        $("#users-result-list").hide();
        $.ajax({
            url: app_url+"doors/doors/getUserTerminalAccess",
            type: "POST",
            data: {'user_id':user,'guid':guid},
            dataType: "json",
            success: function(data){
                if(data.error===false){
                    var items = accessItems(data.access);
                    $(".access-select-search").html(items);
                    $(".access-column").show();
                    access_items = $(".access-select-search").find('.item');
                    $(access_items).click(function(e) {
                        var door_name = $(this).data('name');
                        door_name_to_search = door_name;
                        search_user_moves(user_id_to_search,door_name_to_search);
                    });
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    });

    $(access_items).click(function(e) {
        var door_name = $(this).data('name');
        door_name_to_search = door_name;
        console.log('el nombre de la peuerta es' + door_name_to_search);
        search_user_moves(user_id_to_search,door_name_to_search);
    });
    /**
     * Search user moves by door id (terminal) and user id
     * @param user
     * @param door
     */
    function search_user_moves(user,door){
        $("#users-result-list").hide();
        $("#users-message").hide();
        $.ajax({
            url: app_url + "doors/doors/searchEventByUsersAndAccess",
            type: "POST",
            data: {'user_id': user, 'door_name': door},
            dataType: "json",
            beforeSend: function () {
                $("#users-loading").show();
            },
            success: function (data) {
                $("#users-loading").hide(1000);
                if (data.error === true) {
                    showErrorMessage('#users-message', data.msg, 5000);
                } else {
                    destroyDataTable(usersTable);
                    var events = createDoorsEventsResultBody(data.events);
                    $("#user-result-list-body").html(events);
                    usersTable = createDataTable(usersSelector);
                    $("#users-result-list").show();
                }
            },
            error: function (request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
    }
});
