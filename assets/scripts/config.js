$(document).ready(function() {
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    //Tab init
    $('.ui.tabular.menu.settings .item').tab();
    //Vegas Slider Init

    $(".start-date").calendar({
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
    //Calendar init
    $('#calendar').fullCalendar({
        locale: 'es',
        contentHeight: 700,
        aspectRatio: 2,
        googleCalendarApiKey: 'AIzaSyDrzlzwx-cXpWGkvdTA9A4Y_RCAlr7yMe0',
        eventSources: [
            {
                //Actividades Plaza Merú
                googleCalendarId: 'hotelplazameru.com_7vjklt6bgoahjqcdjj46dkr97k@group.calendar.google.com',
                className: 'single-event'
            },
            {
                //Festivos Venezolanos
                googleCalendarId: 'es.ve#holiday@group.v.calendar.google.com',
                className: 've-holidays'
            },
            {
                //Festivos Cristianos
                googleCalendarId: 'es.christian#holiday@group.v.calendar.google.com',
                className: 'christian-holidays'
            },
            {
                //Lunes Bancarios
                googleCalendarId: 'hotelplazameru.com_73u3a4jbirr6eh6b4nvlve7sro@group.calendar.google.com',
                className: 'christian-holidays'
            },
            {
                //Cumpleaños Plaza Marú
                googleCalendarId: 'hotelplazameru.com_fp4rlsjstr7casv20044pabd6k@group.calendar.google.com',
                className: 'event-birthday'
            },
            {
                //Bodas
                googleCalendarId: 'hotelplazameru.com_cuqdhkssdm7e8u02ccnmun6vf0@group.calendar.google.com',
                className: 'event-wedding'
            },
            {
                //Ejecutivos MOD
                googleCalendarId: 'hotelplazameru.com_vpv203etpdor4n9mu8po5o6lto@group.calendar.google.com',
                className: 'event-executive'
            }
        ],
        eventClick: function(calEvent, jsEvent, view) {
            // console.log(calEvent);
            // console.log(jsEvent);
            // console.log(view);
            jsEvent.preventDefault();
            showEventDetailsModal(calEvent);
            if (calEvent.url) {
                return false;
            }
        }
    });
    $("#calendar-segment").vegas({
        slides: [
            { src: "dist/images/banner.jpg" },
            { src: "dist/images/hotels-desktop.jpg" },
            { src: "dist/images/restaurant.jpg" },
            { src: "dist/images/town.jpg" }
        ],
        overlay: 'bower_components/vegas/dist/overlays/06.png'
    });
});
