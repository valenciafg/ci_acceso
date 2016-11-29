$(document).ready(function() {
    function updateDefaultTable(){
        console.log("voy actualizar la tabla");
    }
    if($("#lastDoorMov").length>1){
        console.log("existe");
        setInterval(updateDefaultTable, 40000);
    }else{
        console.log("no existe");
    }
});
