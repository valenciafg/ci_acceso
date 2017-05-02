$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/searchEventsBySchedule",type:"POST",data:t,dataType:"json",beforeSend:function(){$("#schedule-loading").show()},success:function(t){if($("#schedule-loading").hide(1e3),t.error===!0)showErrorMessage("#schedule-message",t.msg,5e3);else{destroyDataTable(r);var a=createDoorsEventsResultBody(t.events);$("#schedule-result-list-body").html(a),r=createDataTable(s),$("#schedule-result-list").show(),o<1&&(o=1,setInterval(e,2e4))}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}var s=$("#schedule-result-list-table"),r=createDataTable(s),t="",o=0;$("#search-schedule").click(function(){t=$("#schedule-form").serialize(),e(0)})}),$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/getUserAJAX",type:"POST",dataType:"json",success:function(e){var s=$(".user-select-search");if(e.error===!1&&s.length>0){$(".user-select-search").html("");for(var r=(e.users,""),t=e.users.length,o=0;o<t;o++)r+='<div class="link item user-item" data-id="'+e.users[o].c_id+'" data-guid="'+e.users[o].b_guid+'">'+e.users[o].c_fname+" "+e.users[o].c_lname+"</div>";$(".user-select-search").append(r),i=$(".user-select-search").find(".item")}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}function s(e){for(var s="<option>Accesos</option>",r=e.length,t=0;t<r;t++)s+='<option value="'+e[t].tp_term_id+'" data-name="'+e[t].tp_term_name+'" data-guid="'+e[t].tp_guid+'">'+e[t].tp_term_name+"</option>";return s}function r(e){for(var s="",r=e.length,t=0;t<r;t++)s+='<div class="link item" data-id="'+e[t].tp_term_id+'" data-name="'+e[t].tp_term_name+'" data-guid="'+e[t].tp_guid+'">'+e[t].tp_term_name+"</div>";return s}function t(e,s){$("#users-result-list").hide(),$("#users-message").hide(),$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:s},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(d);var s=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(s),d=createDataTable(c),$("#users-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}function o(){var e=$("#login-form").serialize();$.ajax({url:app_url+"settings/settings/auth_user_ajax",type:"POST",data:e,async:!1,dataType:"json",success:function(e){console.log("respuesta: "+JSON.stringify(e)),e.error?($(".login-message").html('<h4><i class="close icon"></i> Error!</h4><p>'+e.msg+"</p>"),$(".login-message").show(1e3).delay(3e3).fadeOut()):window.location.href=app_url+"main"},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}var a=0,n="*",i=$(".user-select-search").find(".item"),l=$(".access-select-search").find(".item");$("body").on("change","#user-search",function(){var e=$(this).val(),r=$(this).find(":selected").attr("data-guid"),t=$("#access-content").find(".ui.dropdown.selection");$("#user-access").val([]),t.hasClass("disabled")||($("#user-access").html("<option>Accesos</option>"),t.addClass("disabled")),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:e,guid:r},dataType:"json",success:function(e){if(e.error===!1){var r=s(e.access),t=$("#access-content").find(".ui.disabled.dropdown.selection");t.removeClass("disabled"),$("#user-access").html(r)}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}),$(".user-select-search").length>0&&setInterval(e,2e4);var c=$("#user-result-list-table"),d=createDataTable(c);$("#search-users").click(function(){var e=$("#user-search").find(":selected").val(),s=$("#user-access").find(":selected"),r=s.attr("data-name");$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:r},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(d);var s=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(s),d=createDataTable(c),$("#users-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}),$(".user-select-search").on("click",".user-item",function(){var e=($(this).html(),$(this).data("id"));a=e;var s=$(this).data("guid");$(".access-column").hide(),$(".access-select-search").html(""),$("#users-result-list").hide(),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:e,guid:s},dataType:"json",success:function(e){if(e.error===!1){var s=r(e.access);$(".access-select-search").html(s),$(".access-column").show(),l=$(".access-select-search").find(".item"),$(l).click(function(e){var s=$(this).data("name");n=s,t(a,n)})}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}),$(l).click(function(e){var s=$(this).data("name");n=s,console.log("el nombre de la peuerta es"+n),t(a,n)}),$("#login-button").click(function(e){o()}),$("#login-form").submit(function(e){console.log("formulario enviado"),o(),e.preventDefault()})}),$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/searchEventByDoorAndSchedule",type:"POST",data:{door_id:r,door_name:t,door_guid:o,start_date:a,start_time:n,end_date:i,end_time:l},dataType:"json",beforeSend:function(){$("#door-loading").show()},success:function(s){if($("#door-loading").hide(1e3),s.error===!0)showErrorMessage("#doors-message",s.msg,5e3);else{destroyDataTable(d);var r=createDoorsEventsResultBody(s.events);$("#doors-result-list-body").html(r),d=createDataTable(c),$("#doors-result-list").show(),u<1&&(u=1,setInterval(e,2e4))}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}var s,r,t,o,a,n,i,l,c=$("#doors-result-list-table"),d=createDataTable(c),u=0;$("#search-doors").click(function(){s=$("#doors-search").find(":selected"),r=s.val(),t=s.attr("data-name"),o=s.attr("data-guid"),a=$("#start_date").val(),n=$("#start_time").val(),i=$("#end_date").val(),l=$("#end_time").val(),e()})}),$(document).ready(function(){var e=$("#permission-result-list-table"),s=createDataTable(e);$(".door-permission-select-search").on("click",".door-item",function(){var r=($(this).html(),$(this).data("id")),t=$(this).data("guid");$.ajax({url:app_url+"doors/doors/getDoorPermissionsAjax",type:"POST",data:{id:r,guid:t},dataType:"json",beforeSend:function(){$("#permission-result-loading").show()},success:function(r){if($("#permission-result-loading").hide(1e3),r.error===!0)showErrorMessage("#users-message",r.msg,5e3);else{destroyDataTable(s);var t=createPermissionTableBody(r.users);$("#permission-result-list-body").html(t),s=createDataTable(e),$("#permission-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})})});
//# sourceMappingURL=events.js.map
