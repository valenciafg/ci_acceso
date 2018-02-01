$(document).ready(function() {
    $("#save_general_settings").click(function () {
        var settings = $('#general-settings-form').serialize();
        // console.log("voy a guardar");
        // console.log(settings);
        $.ajax({
            url: app_url+"settings/settings/saveGeneralAjax",
            type: "POST",
            data: settings,
            dataType: "json",
            success: function(data){
                console.log(data);
                if (data.error===true) {
                    showErrorMessage('#setting-error-msg',data.msg,5000);
                }else{
                    showSuccessMessage('#setting-positive-msg',data.msg,1000);
                }
            },
            error: function(request, error) {
                console.log("Request: " + JSON.stringify(request));
                console.log("Error: " + JSON.stringify(error));
            }
        });
        return false;
    });
});
