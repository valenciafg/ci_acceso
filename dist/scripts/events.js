$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/searchEventsBySchedule",type:"POST",data:a,dataType:"json",beforeSend:function(){$("#schedule-loading").show()},success:function(e){if($("#schedule-loading").hide(1e3),e.error===!0)showErrorMessage("#schedule-message",e.msg,5e3);else{destroyDataTable(o);var a=createDoorsEventsResultBody(e.events);$("#schedule-result-list-body").html(a),o=createDataTable(t),$("#schedule-result-list").show()}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}var t=$("#schedule-result-list-table"),o=createDataTable(t),a="";$("#search-schedule").click(function(){a=$("#schedule-form").serialize(),e(0)})}),$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/getUserAJAX",type:"POST",dataType:"json",success:function(e){var t=$(".user-select-search");if(e.error===!1&&t.length>0){$(".user-select-search").html("");for(var o=(e.users,""),a=e.users.length,s=0;s<a;s++)o+='<div class="link item user-item" data-id="'+e.users[s].c_id+'" data-guid="'+e.users[s].b_guid+'">'+e.users[s].c_fname+" "+e.users[s].c_lname+"</div>";$(".user-select-search").append(o),i=$(".user-select-search").find(".item")}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function t(e){for(var t="<option>Accesos</option>",o=e.length,a=0;a<o;a++)t+='<option value="'+e[a].tp_term_id+'" data-name="'+e[a].tp_term_name+'" data-guid="'+e[a].tp_guid+'">'+e[a].tp_term_name+"</option>";return t}function o(e){for(var t="",o=e.length,a=0;a<o;a++)t+='<div class="link item" data-id="'+e[a].tp_term_id+'" data-name="'+e[a].tp_term_name+'" data-guid="'+e[a].tp_guid+'">'+e[a].tp_term_name+"</div>";return t}function a(e,t){$("#users-result-list").hide(),$("#users-message").hide(),$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:t},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(u);var t=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(t),u=createDataTable(c),$("#users-result-list").show()}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function s(){var e=$("#login-form").serialize();$.ajax({url:app_url+"settings/settings/auth_user_ajax",type:"POST",data:e,async:!1,dataType:"json",success:function(e){console.log("respuesta: "+JSON.stringify(e)),e.error?($(".login-message").html('<h4><i class="close icon"></i> Error!</h4><p>'+e.msg+"</p>"),$(".login-message").show(1e3).delay(3e3).fadeOut()):window.location.href=app_url+"main"},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}var r=0,n="*",i=$(".user-select-search").find(".item"),l=$(".access-select-search").find(".item");$("body").on("change","#user-search",function(){var e=$(this).val(),o=$(this).find(":selected").attr("data-guid"),a=$("#access-content").find(".ui.dropdown.selection");$("#user-access").val([]),a.hasClass("disabled")||($("#user-access").html("<option>Accesos</option>"),a.addClass("disabled")),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:e,guid:o},dataType:"json",success:function(e){if(e.error===!1){var o=t(e.access),a=$("#access-content").find(".ui.disabled.dropdown.selection");a.removeClass("disabled"),$("#user-access").html(o)}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}),$(".user-select-search").length>0&&setInterval(e,2e4);var c=$("#user-result-list-table"),u=createDataTable(c);$("#search-users").click(function(){var e=$("#user-search").find(":selected").val(),t=$("#user-access").find(":selected"),o=t.attr("data-name");$.ajax({url:app_url+"doors/doors/searchEventByUsersAndAccess",type:"POST",data:{user_id:e,door_name:o},dataType:"json",beforeSend:function(){$("#users-loading").show()},success:function(e){if($("#users-loading").hide(1e3),e.error===!0)showErrorMessage("#users-message",e.msg,5e3);else{destroyDataTable(u);var t=createDoorsEventsResultBody(e.events);$("#user-result-list-body").html(t),u=createDataTable(c),$("#users-result-list").show()}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}),$(".user-select-search").on("click",".user-item",function(){var e=($(this).html(),$(this).data("id"));r=e;var t=$(this).data("guid");$(".access-column").hide(),$(".access-select-search").html(""),$("#users-result-list").hide(),$.ajax({url:app_url+"doors/doors/getUserTerminalAccess",type:"POST",data:{user_id:e,guid:t},dataType:"json",success:function(e){if(e.error===!1){var t=o(e.access);$(".access-select-search").html(t),$(".access-column").show(),l=$(".access-select-search").find(".item"),$(l).click(function(e){var t=$(this).data("name");n=t,a(r,n)})}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}),$(l).click(function(e){var t=$(this).data("name");n=t,console.log("el nombre de la peuerta es"+n),a(r,n)}),$("#login-button").click(function(e){s()}),$("#login-form").submit(function(e){console.log("formulario enviado"),s(),e.preventDefault()})}),$(document).ready(function(){function e(){$.ajax({url:app_url+"doors/doors/searchEventByDoorAndSchedule",type:"POST",data:{door_id:o,door_name:a,door_guid:s,start_date:r,start_time:n,end_date:i,end_time:l},dataType:"json",beforeSend:function(){$("#door-loading").show()},success:function(t){if($("#door-loading").hide(1e3),t.error===!0)showErrorMessage("#doors-message",t.msg,5e3);else{destroyDataTable(u);var o=createDoorsEventsResultBody(t.events);$("#doors-result-list-body").html(o),u=createDataTable(c),$("#doors-result-list").show(),d<1&&(d=1,setInterval(e,2e4))}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}var t,o,a,s,r,n,i,l,c=$("#doors-result-list-table"),u=createDataTable(c),d=0;$("#search-doors").click(function(){t=$("#doors-search").find(":selected"),o=t.val(),a=t.attr("data-name"),s=t.attr("data-guid"),r=$("#start_date").val(),n=$("#start_time").val(),i=$("#end_date").val(),l=$("#end_time").val(),e()})}),$(document).ready(function(){var e=$("#permission-result-list-table"),t=createDataTable(e);$(".door-permission-select-search").on("click",".door-item",function(){var o=($(this).html(),$(this).data("id")),a=$(this).data("guid");$.ajax({url:app_url+"doors/doors/getDoorPermissionsAjax",type:"POST",data:{id:o,guid:a},dataType:"json",beforeSend:function(){$("#permission-result-loading").show()},success:function(o){if($("#permission-result-loading").hide(1e3),o.error===!0)showErrorMessage("#users-message",o.msg,5e3);else{destroyDataTable(t);var a=createPermissionTableBody(o.users);$("#permission-result-list-body").html(a),t=createDataTable(e),$("#permission-result-list").show()}},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})})}),$(document).ready(function(){function e(e){$.ajax({url:app_url+"footprint/footprint/searchFootprint",type:"POST",data:e,dataType:"json",success:function(e){console.log(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function t(e,t){$.ajax({url:app_url+"footprint/footprint/searchEmployees",type:"POST",data:{department:e,returnAjax:!0},dataType:"json",success:function(e){console.log(e),t(e)},error:function(e,t,o){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t)),console.log("Error: ",o)}})}$("#search-footprint").click(function(){start_date=$("#start_date").val(),start_time=$("#start_time").val(),end_date=$("#end_date").val(),end_time=$("#end_time").val(),department=$("#sfootprint-department").find(":selected").val(),employee=$("#sfootprint-employee").find(":selected").val(),console.log(start_date,start_time,end_date,end_time,department,employee);var t={start_date:start_date,start_time:start_time,end_date:end_date,end_time:end_time,department:department,employee:employee};""===employee?alert("Debe seleccionar un empleado"):e(t)}),$("#sfootprint-department").change(function(){var e=$(this).val();t(e,function(e){var t='<option value="">- Empleados -</option>';e.length>0&&e.forEach(function(e,o){t+='<option value="'+e.USER_ID+'">'+e.FIRST_NAME+" "+e.LAST_NAME+"</option>"}),$("#sfootprint-employee").html(t)})})}),$(document).ready(function(){function e(e){if(e.length>0){var t=e.DataTable({order:[[0,"asc"]],pageLength:50,language:{url:"extras/SpanishDatatable.json"},lengthChange:!1,buttons:["copy","excel","pdf","colvis"],bDestroy:!0});return t}return!1}function t(e,t){$.ajax({url:app_url+"rooms/rooms/searchOperators",type:"POST",data:e,dataType:"json",success:function(e){t(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function o(e){var t=null;"undefined"!=typeof arguments[2]&&(t=arguments[2]),$.ajax({url:app_url+"footprint/footprint/searchDepartment",type:"POST",data:arguments[1],dataType:"json",success:function(o){e(o,t)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function a(e,t){$.ajax({url:app_url+"rooms/rooms/searchStatus",type:"POST",data:e,dataType:"json",success:function(e){t(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function s(e,t){$.ajax({url:app_url+"rooms/rooms/searchAvailability",type:"POST",data:e,dataType:"json",success:function(e){t(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function r(e,t){var o='<option value="">[Seleccione]</option>',a=!1;e.forEach(function(e,a){t===e.DEPARTMENT_CODE?(o+='<option value="'+e.DEPARTMENT_CODE+'" selected>'+e.DEPARTMENT_NAME+"</option>",$sw=!0):o+='<option value="'+e.DEPARTMENT_CODE+'">'+e.DEPARTMENT_NAME+"</option>"}),$("select[name=departamento]").html(o),a||$("select[name=departamento]").val("03")}function n(e){$.ajax({url:app_url+"rooms/rooms/saveOperatorData",type:"POST",data:e,dataType:"json",success:function(e){e?(alert("Operador modificado con exito"),location.reload()):alert("Error al editar operador")},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t)),alert("Error al editar operador")}})}function i(e){if(e.length>0){var t=e.DataTable({order:[[0,"asc"]],pageLength:50,language:{url:"extras/SpanishDatatable.json"},bDestroy:!0});return t}return!1}function l(){var e=$("input[name=aet_codigo]").val(),t=$("input[name=aet_description]").val(),o=!0,a="";return 3!==e.length?(o=!1,a+="Debe ingresar solo numero. "):e.match(/^[0-9]+$/)||(o=!1,a+="La longitud del codigo debe ser tres (3). "),t.length<1&&(o=!1,a+="Debe ingresar una descripcion. "),o||alert(a),o}function c(e){$.ajax({url:app_url+"rooms/rooms/saveEventTypeData",type:"POST",data:e,dataType:"json",success:function(e){console.log("reps",e),e?(alert("Tipo de evento agregado con exito"),location.reload()):alert("Error al agregar tipo de evento")},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t)),alert("Error al agregar tipo de evento")}})}function u(e,t){$.ajax({url:app_url+"rooms/rooms/getEvenTypeData",type:"POST",data:e,dataType:"json",success:function(e){t(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function d(e,t){var o='<option value="">[Seleccione]</option>',a=!1;e.forEach(function(e,a){t===e.DEPARTMENT_CODE?(o+='<option value="'+e.DEPARTMENT_CODE+'" selected>'+e.DEPARTMENT_NAME+"</option>",$sw=!0):o+='<option value="'+e.DEPARTMENT_CODE+'">'+e.DEPARTMENT_NAME+"</option>"}),$("select[name=eet_departament]").html(o),a||$("select[name=eet_departament]").val("03")}function m(e){$.ajax({url:app_url+"rooms/rooms/saveEditEventTypeData",type:"POST",data:e,dataType:"json",success:function(e){console.log("reps",e),e?(alert("Tipo de evento modificado con exito"),location.reload()):alert("Error al editar tipo de evento")},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t)),alert("Error al editar tipo de evento")}})}function p(e){var t=[];return e.forEach(function(e,o){var a=[],s=moment(e.regDate),r=s.unix();s=s.format("DD/MM/YYYY HH:mm:ss"),a.push(o+1),a.push(e.roomExtension),a.push(e.roomName),a.push(e.Type),a.push(e.clasification),a.push(e.DEPARTMENT_NAME),a.push(e.alias),a.push(e.name),a.push(r),a.push(s),t.push(a)}),t}function f(e,t){dTableFootprint=$(e).DataTable({data:t,order:[[9,"desc"]],pageLength:50,columns:[{title:"#"},{title:"Ext."},{title:"Habitacion"},{title:"Eventos"},{title:"Clasificacion"},{title:"Departamento"},{title:"Personal"},{title:"Nombre Pers."},{title:"Fecha UNIX"},{title:"Fecha"}],columnDefs:[{visible:!1,targets:[8]}],language:{url:"extras/SpanishDatatable.json"},bDestroy:!0})}function v(){var e=$("#sevent_start_date").val(),t=$("#sevent_start_time").val(),o=$("#sevent_end_date").val(),a=$("#sevent_end_time").val(),s=$("#sevent-room").val(),r=$("#sevent-operators").val(),n=e+" "+t+":00";n=moment(n,"D-M-YYYY H:mm:ss").format("YYYY-MM-DD HH:mm:ss");var i=o+" "+a+":59";i=moment(i,"D-M-YYYY H:mm:ss").format("YYYY-MM-DD HH:mm:ss");var l={returnAjax:!0,start:n,end:i,room:s,operator:r};$.ajax({url:app_url+"rooms/rooms/searchroomevents",type:"POST",data:l,dataType:"json",beforeSend:function(){$("#room-event-loading").css("display","block"),$("#room-event-message").css("display","none"),$("#room-event-message").html(""),$("#room-event-list").css("display","none")},success:function(e){$("#room-event-loading").css("display","none"),e.length>0?(dataSet=p(e),f("#roomEventsTable",dataSet),$("#room-event-list").css("display","block")):($("#room-event-message").css("display","block"),$("#room-event-message").html("Busqueda sin resultados"))},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function g(e){$.ajax({url:app_url+"settings/settings/getRoomStatusUpdateTimeAjax",type:"POST",dataType:"json",async:!1,success:function(t){e(t.time)},error:function(t,o){e(30)}})}function h(){$.ajax({url:app_url+"rooms/rooms/getRoomStatus",type:"POST",data:{returnAjax:!0},dataType:"json",success:function(e){console.log(e),e.length>0&&y(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}function y(e){for(var t=e.length,o=0,a="",s="",r="",n=0;n<t;n++){s=e[n].Location;var i="negro";if(null!==e[n].availabilityCode)switch(availabilityCode=e[n].availabilityCode,availabilityCode){case 1:i="negro";break;case 2:i="verde";break;case 3:i="rojo";break;case 4:i="naranja";break;case 5:i="amarillo";break;default:i="negro"}var l="negro";if(null!==e[n].statusCode)switch(statusCode=e[n].statusCode,statusCode){case 1:l="verde";break;case 2:l="amarillo";break;case 3:l="azul";break;case 4:l="rojo";break;case 5:l="negro";break;case 6:l="naranja";break;case 7:l="morado";break;default:l="negro"}var c="fa-bed";"304"==e[n].PhoneNumber&&(c="fa-wheelchair-alt");var u="";s===a&&0!==o||(u=s.toLowerCase(),u=u.replace(/ /g,"-"),0!==o?r+="</div>":u="piso-0",r+='<div id="'+u+'" class="ui cards">'),r+="<div class='card'>",r+='<div class="content">',r+='<i class="ui left floated fa '+c+" fa-2x fa-border "+i+'" aria-hidden="true"></i>',r+='<div class="header borde-negro '+l+'">',r+=e[n].roomName,r+="</div>",r+='<div class="meta">',r+=e[n].Location+". Ext.: "+e[n].PhoneNumber,r+="</div>",r+='<div class="meta">',null!==e[n].statusCode&&(r+="<br/>"+e[n].statusName),r+="</div>",r+='<div class="description">',r+=null!==e[n].eventDescription?e[n].eventDescription:"",null!==e[n].availabilityCode&&(r+='<br/><br/><div style="text-align:center;">'+e[n].availabilityName+"</div>"),r+="</div>",r+="</div>",r+="</div>",a=e[n].Location,o++}$("#room-status-card-list").html(r)}var _=$("#operatorsTable");e(_);$("body").on("click",".edit-operator-btn",function(e){var a=$(this).attr("data-id"),s={id:a};t(s,function(e){e=e[0];var t=e.department;$("input[name=codigo]").val(e.code),$("input[name=nombre]").val(e.name),$("input[name=id]").val(e.id),$("input[name=estatus][value="+e.status+"]").prop("checked",!0);var a={returnAjax:!0};o(r,a,t)}),$("#operators-edit-modal").modal("show")}),$("body").on("click",".guardar-edit-operator-btn",function(e){var t=$("#edit-operator-form").serialize(),o={returnAjax:!0};t=t+"&"+$.param(o),n(t)});var b=$("#eventTypesTable");i(b);$("body").on("click",".add-event-type-btn",function(e){$("#event-type-add-modal").modal("show");var t={returnAjax:!0};o(function(e){var t='<option value="">[Seleccione]</option>';e.forEach(function(e,o){t+='<option value="'+e.DEPARTMENT_CODE+'">'+e.DEPARTMENT_NAME+"</option>"}),$("select[name=aet_departament]").html(t)},t)}),$("body").on("keypress","#aet_description",function(){return!(this.value.length>160)&&void $("#add-counter-value").html(38-this.value.length)}),$("body").on("click",".guardar-add-event-type-btn",function(e){if(l()){var t=$("#add-event-type-form").serialize(),o={returnAjax:!0};t=t+"&"+$.param(o),c(t)}}),$("body").on("click",".edit-event-type-btn",function(e){var t=$(this).attr("data-id");$(this).attr("data-dp");$("input[name=eet_id]").val(t);var r={event:t,returnAjax:!0};u(r,function(e){if(e.length>0){e=e[0],$("input[name=eet_codigo]").val(e.eventCode),$("input[name=eet_description]").val(e.description),$("#counter-value").html(38-e.description.length);var t={returnAjax:!0};o(d,t,e.department),null!==e.clasification&&$("select[name=eet_clasification]").val(e.clasification),a(t,function(e){var t='<option value="">[Seleccione]</option>';e.forEach(function(e,o){t+='<option value="'+e.id+'">'+e.Name+"</option>"}),$("select[name=eet_status]").html(t)}),null!==e.status&&$("select[name=eet_status]").val(e.status),s(t,function(e){var t='<option value="">[Seleccione]</option>';e.forEach(function(e,o){t+='<option value="'+e.id+'">'+e.name+"</option>"}),$("select[name=eet_availability]").html(t)}),null!==e.availability&&$("select[name=eet_availability]").val(e.availability)}}),$("#event-type-edit-modal").modal("show")}),$("body").on("keypress","#eet_description",function(){return!(this.value.length>160)&&void $("#counter-value").html(38-this.value.length)}),$("body").on("click",".guardar-edit-event-type-btn",function(e){var t=$("#edit-event-type-form").serialize(),o={returnAjax:!0};t=t+"&"+$.param(o),console.log(t),m(t)});var T=$("#roomEventsTable");T.length>0&&v(),$("#search-room-event").click(function(){v()});var E=$("#room-status-card-list");if(E.length>0){var S=3e4;g(function(e){S=1e3*e}),h(),setInterval(h,S)}}),$(document).ready(function(){var e=$(".services-menu");e.length>0&&$(".services-menu .item").tab(),$("#cne-search").click(function(){$.ajax({url:app_url+"services/services/searchPeopleCNE",type:"POST",data:{returnAjax:!0,nacionalidad:$("#cne-nac").val(),cedula:$("#cne-ci").val()},dataType:"json",success:function(e){e.error||($(".cne-res-name").html(e.nombre),$(".cne-res-ci").html(e.cedula),$(".cne-res-estado").html(e.estado),$(".cne-res-municipio").html(e.municipio),$(".cne-res-parroquia").html(e.parroquia),$(".cne-res-centro").html(e.centro),$(".cne-res-direccion").html(e.direccion),$(".cne-card").css("display","block")),console.log(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}),$("#ivss-search").click(function(){var e=$("#ivss-birth-date").val(),t=moment(e,"D-M-YYYY").format("DD"),o=moment(e,"D-M-YYYY").format("MM"),a=moment(e,"D-M-YYYY").format("YYYY");$.ajax({url:app_url+"services/services/searchIVSS",type:"POST",data:{returnAjax:!0,nacionalidad:$("#ivss-nac").val(),cedula:$("#ivss-ci").val(),dia:t,mes:o,anho:a},dataType:"json",success:function(e){e.error||($(".ivss-res-name").html(e.nombre),$(".ivss-res-ci").html(e.cedula),$(".ivss-res-sexo").html(e.sexo),$(".ivss-res-nacimiento").html(e.nacimiento),$(".ivss-res-semanas").html(e.semanas),$(".ivss-res-salarios").html(e.salarios),$(".ivss-res-afiliacion").html(e.afiliacion),$(".ivss-res-estatus").html(e.estatus),$(".ivss-res-contingencia").html(e.contingencia),$(".ivss-res-numeropatronal").html(e.numeropatronal),$(".ivss-res-ingreso").html(e.ingreso),$(".ivss-res-empresa").html(e.empresa),$(".ivss-card").css("display","block")),console.log(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})}),$("#cantv-search").click(function(){$.ajax({url:app_url+"services/services/searchDebtCANTV",type:"POST",data:{returnAjax:!0,area:$("#cantv-area").val(),tlf:$("#cantv-tlf").val()},dataType:"json",success:function(e){e.error||($(".cantv-res-saldoactual").html(e.saldoactual),$(".cantv-res-fechavencimiento").html(e.fechavencimiento),$(".cantv-res-fechacorte").html(e.fechacorte),$(".cantv-res-ultimafacturacion").html(e.ultimafacturacion),$(".cantv-res-ultimopago").html(e.ultimopago),$(".cantv-res-saldovencido").html(e.saldovencido),$(".cantv-card").css("display","block")),console.log(e)},error:function(e,t){console.log("Request: "+JSON.stringify(e)),console.log("Error: "+JSON.stringify(t))}})})});
//# sourceMappingURL=events.js.map
