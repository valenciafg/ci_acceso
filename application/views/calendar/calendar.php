<div class="pusher">
    <?php
    $this->load->view('common/header');
    $this->load->view('common/menu',['item'=>'calendar']);
    ?>

    <div id="calendar-segmentx" class="ui vertical segment first-segment" style="margin: 0;">
        <div class="ui container calendar-container">
<!--            Title-->
            <h1 class="ui dividing center aligned header"><i class="fa fa-calendar" aria-hidden="true"></i> Calendario de Eventos</h1>
            <!-- Calendar -->
            <div id="calendar" class=""></div>
            <!-- Calendar Buttons -->
            <div class="middle aligned content event-button-group">
                <button class="ui button single-event">Eventos Merú</button>
                <button class="ui button event-birthday">Cumpleañeros Merú</button>
                <button class="ui button event-wedding">Plan Noche de Bodas</button>
                <button class="ui button event-executive">Ejecutivos MOD</button>
                <button class="ui button ve-holidays">Festivos Venezolanos</button>
                <button class="ui button christian-holidays">Festivos Cristianos</button>
            </div>
        </div>
        <!-- Event Details Modal -->
        <div id="eventModal" class="ui small modal transition" style="display: none;">
            <h4 class="modal-title header" id="eventTitle">Evento sin título</h4>
            <div class="ui container stackable grid" style="padding: 10px 10px 20px 10px;">
                <!-- Event Description -->
                <div class="row">
                    <div id="eventDescription" class="column" style="display: none;">
                        <blockquote class="blockquote">
                            <p id="descriptionContent"></p>
                        </blockquote>
                    </div>
                </div>
                <!-- Event duration start time -->
                <div id="eventDurationStart" class="eight wide column" style="display: none;">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i><strong> Inicio: </strong>
                    <div id="startDate"></div>
                </div>
                <!-- Event duration end time -->
                <div id="eventDurationEnd" class="eight wide column" style="display: none;">
                    <i class="fa fa-calendar-times-o" aria-hidden="true"></i><strong> Fin: </strong>
                    <div id="endDate"></div>
                </div>
                <!-- Event Date -->
                <div id="eventDate" class="row" style="display: none;">
                    <div class="column">
                        <i class="fa fa-calendar" aria-hidden="true"></i><strong> Fecha: </strong>
                        <div id="singleDate"></div>
                    </div>
                </div>
                <!-- Event Place -->
                <div id="eventLocation" class="row" style="display: none;">
                    <div class="column">
                        <i class="fa fa-compass" aria-hidden="true"></i><strong> Lugar: </strong>
                        <div id="locationContent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script src="dist/scripts/jquery.js" type="text/javascript"></script>
<script src="dist/scripts/libs.js" type="text/javascript"></script>
<script src="dist/scripts/plugins.js" type="text/javascript"></script>
<script src="dist/scripts/main.js" type="text/javascript"></script>
</body>
</html>