$(document).ready(function() {
    $('.ui.dropdown').dropdown();
    $('#lastDoorMov').DataTable({
        "order": [[ 3, "desc" ]],
        "language": {
            "url": "extras/SpanishDatatable.json"
        }
    });
    var now = moment();
    console.log('hoy es '+now);
    console.log('mejor es '+now.format('DD-MM-YYYY'));
    $(".start-date").calendar({
        // initialDate: now.format('DD-MM-YYYY'),
        // monthFirst: false,
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return day + '-' + month + '-' + year;
            }
        },
        type: 'date'
    });
    $(".start-time").calendar({
        ampm: false,
        type: 'time'
    });
    $(".end-date").calendar({
        monthFirst: false,
        formatter: {
            date: function (date, settings) {
                if (!date) return '';
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                return day + '-' + month + '-' + year;
            }
        },
        type: 'date'
    });
    $(".end-time").calendar({
        ampm: false,
        type: 'time'
    });

});