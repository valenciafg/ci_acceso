$(document).ready(function(){var e=$("#schedule-result-list-table"),s=createDataTable(e);$("#search-schedule").click(function(){var r=$("#schedule-form").serialize();$.ajax({url:app_url+"doors/doors/searchEventsBySchedule",type:"POST",data:r,dataType:"json",beforeSend:function(){$("#schedule-loading").show()},success:function(r){if($("#schedule-loading").hide(1e3),r.error===!0)showErrorMessage("#schedule-message",r.msg,5e3);else{destroyDataTable(s);var a=createDoorsEventsResultBody(r.events);$("#schedule-result-list-body").html(a),s=createDataTable(e),$("#schedule-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})})}),$(document).ready(function(){function e(e){for(var s="<option>Accesos</option>",r=e.length,a=0;a<r;a++)s+='<option value="'+e[a].tp_term_id+'" data-name="'+e[a].tp_term_name+'" data-guid="'+e[a].tp_guid+'">'+e[a].tp_term_name+"</option>";return s}function s(e){for(var s="",r=e.length,a=0;a<r;a++)s+='<div class="link item" data-id="'+e[a].tp_term_id+'" data-name="'+e[a].tp_term_name+'" data-guid="'+e[a].tp_guid+'">'+e[a].tp_term_name+"</div>";return s}function r(e,s){$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:s},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(t);var s=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(s),t=createDataTable(a),$("#users-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}$("body").on("change","#user-search",function(){var s=$(this).val(),r=$(this).find(":selected").attr("data-guid"),a=$("#access-content").find(".ui.dropdown.selection");$("#user-access").val([]),a.hasClass("disabled")||($("#user-access").html("<option>Accesos</option>"),a.addClass("disabled")),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:s,guid:r},dataType:"json",success:function(s){if(s.error===!1){var r=e(s.access),a=$("#access-content").find(".ui.disabled.dropdown.selection");a.removeClass("disabled"),$("#user-access").html(r)}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})});var a=$("#user-result-list-table"),t=createDataTable(a);$("#search-users").click(function(){var e=$("#user-search").find(":selected").val(),s=$("#user-access").find(":selected"),r=s.attr("data-name");$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:r},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(t);var s=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(s),t=createDataTable(a),$("#users-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})});var o=0,n="*",c=$(".user-select-search").find(".item"),d=$(".access-select-search").find(".item");$(c).click(function(e){var a=$(this).data("id");o=a;var t=$(this).data("guid");$(".access-column").hide(),$(".access-select-search").html(""),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:a,guid:t},dataType:"json",success:function(e){if(e.error===!1){var a=s(e.access);$(".access-select-search").html(a),$(".access-column").show(),d=$(".access-select-search").find(".item"),$(d).click(function(e){var s=$(this).data("name");n=s,r(o,n)})}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})}),$(d).click(function(e){var s=$(this).data("name");n=s,console.log("el nombre de la peuerta es"+n),r(o,n)})}),$(document).ready(function(){var e=$("#doors-result-list-table"),s=createDataTable(e);$("#search-doors").click(function(){var r=$("#doors-search").find(":selected"),a=r.val(),t=r.attr("data-name"),o=r.attr("data-guid"),n=$("#start_date").val(),c=$("#start_time").val(),d=$("#end_date").val(),i=$("#end_time").val();$.ajax({url:app_url+"doors/doors/searchEventByDoorAndSchedule",type:"POST",data:{door_id:a,door_name:t,door_guid:o,start_date:n,start_time:c,end_date:d,end_time:i},dataType:"json",beforeSend:function(){$("#door-loading").show()},success:function(r){if($("#door-loading").hide(1e3),r.error===!0)showErrorMessage("#doors-message",r.msg,5e3);else{destroyDataTable(s);var a=createDoorsEventsResultBody(r.events);$("#doors-result-list-body").html(a),s=createDataTable(e),$("#doors-result-list").show()}},error:function(e,s){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(s))}})})});
//# sourceMappingURL=events.js.map
