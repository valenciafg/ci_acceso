$(document).ready(function() {
	var door_items = $(".door-permission-select-search").find('.item');
	$(".door-permission-select-search").on("click", ".door-item", function(){
		var contenido = $(this).html();
        var door_id = $(this).data('id');
        var guid = $(this).data('guid');
        console.log('los datos son',contenido);
        console.log('los datos son',door_id);
        console.log('los datos son',guid);
        $.ajax({
            url: app_url+"doors/doors/getDoorPermissionsAjax",
            type: "POST",
            data: {'id':door_id,'guid':guid},
            dataType: "json",
            success: function(response){
        		console.log(response);
                /*if(data.error===false){
                    var items = accessItems(data.access);
                    $(".access-select-search").html(items);
                    $(".access-column").show();
                    access_items = $(".access-select-search").find('.item');
                    $(access_items).click(function(e) {
                        var door_name = $(this).data('name');
                        door_name_to_search = door_name;
                        search_user_moves(user_id_to_search,door_name_to_search);
                    });
                }*/
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
	});
});