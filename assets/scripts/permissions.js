$(document).ready(function() {
	// var door_items = $(".door-permission-select-search").find('.item');
    var permissionSelector = $('#permission-result-list-table');
    var permissionTable = createDataTable(permissionSelector);

	$(".door-permission-select-search").on("click", ".door-item", function(){
		var contenido = $(this).html();
        var door_id = $(this).data('id');
        var guid = $(this).data('guid');
        // console.log('los datos son',contenido);
        // console.log('los datos son',door_id);
        // console.log('los datos son',guid);
        $.ajax({
            url: app_url+"doors/doors/getDoorPermissionsAjax",
            type: "POST",
            data: {'id':door_id,'guid':guid},
            dataType: "json",
             beforeSend: function () {
                $("#permission-result-loading").show();
            },
            success: function(response){
                $("#permission-result-loading").hide(1000);
                if (response.error === true) {
                    showErrorMessage('#users-message', response.msg, 5000);
                } else {
                    destroyDataTable(permissionTable);
                    var usersBody = createPermissionTableBody(response.users);
                    $("#permission-result-list-body").html(usersBody);
                    permissionTable = createDataTable(permissionSelector);
                    $("#permission-result-list").show();
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
	});
});