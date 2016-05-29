<?php include("_head.php") ?>
<?php include("_menu.php") ?>
<div class="directorios">
    <div>
        <p class="title_section">Directorio</p>
        <div></div>
        <p>Encuentra un asesor SOC</p>
    </div>
</div>
<div class="container_directorio">
    <div class="container-fluid top-line" id="content">
        <div class="container container-reflow">
            <div class="row content-form content-form-  directorio">
                <h3>Encuentra un asesor</h3>
    
                <div class="form-group">
                    <label for="nombre">Selecciona tu estado</label>
                    <select name="ddlEstados" onchange="    javascript:setTimeout(&#39;__doPostBack(\&#39;ddlEstados\&#39;,\&#39;\&#39;)&#39;, 0)   " id="ddlEstados" class="selectpicker">
                        <option selected="selected" value="0">SELECCIONE                UN     ESTADO</option>
                        <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                        <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option >
                        <option value="BAJA CALIFORNIA SUR">BAJA                CALIFORNIA SUR </option>
                        <option value="CAMPECHE">CAMPECHE</option>
                        <option value="COAHUILA">COAHUILA</option>
                        <option value="COLIMA">COLIMA</option>
                        <option value="CHIAPAS">CHIAPAS</option>
                        <option value="CHIHUAHUA">CHIHUAHUA</option>
                        <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                        <option value="DURANGO">DURANGO</option>
                        <option value="GUANAJUATO">GUANAJUATO</option>
                        <option value="GUERRERO">GUERRERO</option>
                        <option value="HIDALGO">HIDALGO</option>
                        <option value="JALISCO">JALISCO</option>
                        <option value="MÉXICO">M&#201;XICO</option>
                        <option value="MICHOACÁN">MICHOAC&#193;N</option>
                        <option value="MORELOS">MORELOS</option>
                        <option value="NAYARIT">NAYARIT</option>
                        <option value="NUEVO LEÓN">NUEVO LE&#211;N</option>
                        <option value="OAXACA">OAXACA</option>
                        <option value="PUEBLA">PUEBLA</option>
                        <option value="QUERÉTARO DE ARTEAGA">QUER&#201;             TARO DE  ARTEAGA</option>
                        <option value="QUINTANA ROO">QUINTANA ROO</option>
                        <option value="SAN LUÍS POTOSÍ">SAN LU&#205;S POTOS &#205;</option>
                        <option value="SINALOA">SINALOA</option>
                        <option value="SONORA">SONORA</option>
                        <option value="TABASCO">TABASCO</option>
                        <option value="TAMAULIPAS">TAMAULIPAS</option>
                        <option value="TLAXCALA">TLAXCALA</option>
                        <option value="VERACRUZ">VERACRUZ</option>
                        <option value="YUCATÁN">YUCAT&#193;N</option>
                        <option value="ZACATECAS">ZACATECAS</option>
                    </select>
                        &nbsp;<br />
                </div>
            </div>
        </div>
    </div>

</div>
<?php include("_footer.php") ?>