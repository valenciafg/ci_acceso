<h2 class="ui header up-header">
    Búsquedas de Servicios
</h2>
<div class="ui top attached tabular menu services-menu">
  <a class="item active" data-tab="one">CNE</a>
  <a class="item" data-tab="two">IVSS</a>
  <a class="item" data-tab="three">SENIAT</a>
  <a class="item" data-tab="four">CANTV</a>
  <a class="item" data-tab="five">CORPOELEC</a>
  <a class="item" data-tab="six">ZOOM</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="one">
    <form id="cne-form" class="ui form">
        <div class="fields">
            <div class="field">
                <select class="ui search dropdown" id="cne-nac" name="cne-nac">
                    <option value="V" selected>Venezolano</option>
                    <option value="E">Extranjero</option>
                </select>
            </div>
            <div class="field">
                <div class="ui input">
                    <input type="text" placeholder="Cedula" name="cne-ci" id="cne-ci">
                </div>
            </div>
            <div class="field">
                <div id="cne-search" class="ui vertical blue animated button" tabindex="0">
                    <div class="hidden content">Buscar</div>
                    <div class="visible content">
                        <i class="search icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="ui card cne-card" style="width:400px!important; display:none;">
        <div class="content">
            <div class="header cne-res-name"></div>
            <div class="meta cne-res-ci"></div>
        </div>
        <div class="content">
            <div class="description">
                <label for="">Estado:</label>
                <p class="cne-res-estado"></p>
                <label for="">Municipio:</label>
                <p class="cne-res-municipio"></p>
                <label for="">Parroquia:</label>
                <p class="cne-res-parroquia"></p>
                <label for="">Centro:</label>
                <p class="cne-res-centro"></p>
                <label for="">Direccion:</label>
                <p class="cne-res-direccion"></p>
            </div>
        </div>
    </div>
</div>
<div class="ui bottom attached tab segment" data-tab="two">
    <form id="ivss-form" class="ui form">
        <div class="fields">
            <div class="field">
                <select class="ui search dropdown" id="ivss-nac" name="ivss-nac">
                    <option value="V" selected>Venezolano</option>
                    <option value="E">Extranjero</option>
                </select>
            </div>
            <div class="field">
                <div class="ui input">
                    <input type="text" placeholder="Cedula" name="ivss-ci" id="ivss-ci">
                </div>
            </div>
            <div class="field">
                <div class="ui calendar start-date">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input id="ivss-birth-date" name="ivss-birth-date" type="text" placeholder="Fecha Nacimiento" value="<?= date('d-m-Y');?>">
                    </div>
                </div>
            </div>
            <div class="field">
                <div id="ivss-search" class="ui vertical blue animated button" tabindex="0">
                    <div class="hidden content">Buscar</div>
                    <div class="visible content">
                        <i class="search icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="ui card ivss-card" style="width:400px!important; display:none;">
        <div class="content">
            <div class="header ivss-res-name"></div>
            <div class="meta ivss-res-ci"></div>
            <div class="meta ivss-res-sexo"></div>
            <div class="meta ivss-res-nacimiento"></div>
        </div>
        <div class="content">
            <div class="description">
                <label for="">Semanas cotizadas:</label>
                <p class="ivss-res-semanas"></p>
                <label for="">Total salarios cotizados:</label>
                <p class="ivss-res-salarios"></p>
                <label for="">Fecha afiliacion:</label>
                <p class="ivss-res-afiliacion"></p>
                <label for="">Estatus:</label>
                <p class="ivss-res-estatus"></p>
                <label for="">Fecha de contingencia:</label>
                <p class="ivss-res-contingencia"></p>
                <label for="">Nro. Patronal:</label>
                <p class="ivss-res-numeropatronal"></p>
                <label for="">Fecha de Ingreso:</label>
                <p class="ivss-res-ingreso"></p>
                <label for="">Empresa:</label>
                <p class="ivss-res-empresa"></p>
            </div>
        </div>
    </div>
</div>
<div class="ui bottom attached tab segment" data-tab="three">
  En construccion
</div>
<div class="ui bottom attached tab segment" data-tab="four">
    <form id="cantv-form" class="ui form">
        <div class="fields">
            <div class="field">
                <div class="ui input">
                    <input type="text" placeholder="Area" name="cantv-area" id="cantv-area" value="286">
                </div>
            </div>
            <div class="field">
                <div class="ui input">
                    <input type="text" placeholder="Telefono" name="cantv-tlf" id="cantv-tlf">
                </div>
            </div>
            <div class="field">
                <div id="cantv-search" class="ui vertical blue animated button" tabindex="0">
                    <div class="hidden content">Buscar</div>
                    <div class="visible content">
                        <i class="search icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="ui card cantv-card" style="width:400px!important; display:none;">
        <div class="content">
            <div class="description">
                <label for="">Saldo actual:</label>
                <p class="cantv-res-saldoactual"></p>
                <label for="">Fecha de vencimiento:</label>
                <p class="cantv-res-fechavencimiento"></p>
                <label for="">Fecha corte:</label>
                <p class="cantv-res-fechacorte"></p>
                <label for="">Ultima facturacion:</label>
                <p class="cantv-res-ultimafacturacion"></p>
                <label for="">Monto ultimo pago:</label>
                <p class="cantv-res-ultimopago"></p>
                <label for="">Saldo vencido:</label>
                <p class="cantv-res-saldovencido"></p>
            </div>
        </div>
    </div>
</div>
<div class="ui bottom attached tab segment" data-tab="five">
En construccion
</div>
<div class="ui bottom attached tab segment" data-tab="six">
En construccion
</div>