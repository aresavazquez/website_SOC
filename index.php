<?php include("_head.php") ?>
<div class="home">
	<?php include("_menu.php") ?>
	<!--div class="head">
	    <div class="imagenes">
	    	<p class="texto uno">"Sólo tienes que<br>hacer clic, mamá"</p>
	    	<img src="./img/head/img_1.png" class="img1">
	    </div>
	    <div class="imagenes">
	    	<p class="texto dos">"Toma miel con<br> limón"</p>
	    	<img src="./img/head/img_2.png" class="img2">
	    </div>
	    <div class="imagenes">
	    	<p class="texto tres">"En el semáforo dé<br>vuelta a la derecha"</p>
	    	<img src="./img/head/img_3.png" class="img3">
	    </div>
	    <a href="" class="simular">Simula tu crédito ahora</a>
	</div-->

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  	<!-- Indicators -->
  		<ol class="carousel-indicators">
    		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
    		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
  		</ol>
  		<div class="carousel-inner" role="listbox">
    		<div class="item active">
    			<p>"Sólo tienes que<br>hacer clic, mamá"</p>
      			<img src="./img/head/img_1.png" alt="...">
    		</div>
    		<div class="item">
    			<p>"Toma miel<br>con limón"</p>
      			<img src="./img/head/img_2.png" alt="...">
    		</div>
    		<div class="item">
    			<p>En el semáforo dé<br>vuelta a la derecha</p>
      			<img src="./img/head/img_3.png" alt="...">
    		</div>
    		<a href="" class="simular">Simula tu crédito ahora</a>
  		</div>
  		<!-- Controls -->
  		<!--a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    		<span class="sr-only">Previous</span>
  		</a>
  		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    		<span class="sr-only">Next</span>
  		</a-->
	</div>
	<div class="sub-menu">
		<a href="asesores.php">
			<div class="asesor">
				<p>Asesores<br>
					<span>Accede a tu micositio</span>
				</p>
			</div>
		</a>
		<a href="">
			<div class="inmobiliarias">
				<p>Inmobiliarias<br>
					<span>Hagamos equipo</span>
				</p>
			</div>
		</a>
		<a href="">
			<div class="franquicia">
				<p>Franquicia<br>
					<span>Vende más con SOC</span>
				</p>
			</div>
		</a>
		<a href="">
			<div class="prensa">
				<p>Prensa<br>
					<span>SOC en los medios</span>
				</p>
			</div>
		</a>
	</div>
</div>
<div class="info">
	<div class="borde">
		<h1>Asesoría hipotecaria integral</h1>
		<p>Recibirás asesoría de especialistas en los productos, procesos, políticas y requisitos de las opciones financieras más importantes del mercado. Analizaremos para ti las alternativas de crédito hipotecario disponibles en el mercado y te ayudaremos a elegir la que mejor se ajuste a tus características y necesidades.</p>
	</div>
	<div>
		<h1>Servicio sin costo.</h1>
		<p>Los mejores asesores hipotecarios trabajando para ti de manera gratuita.<br>En ningún momento del proceso pagarás por su servicio..</p>
	</div>
</div>
<div class="simulador">
	<div class="box">
		<div>
			<h1 class="title">Simulador</h1>
			<p class="texto">Nuestro simulador te mostrará el panorama con tus diferentes opciones de crédito.<br>Para calcular tu crédito hipotecario ingresa la información solicitada en los siguientes campos.</p>
		</div>
		<div class="form">
			<form action="" method="">
				<input type="text" placeholder="Nombre" id="name">
				<input type="number" placeholder="Número" id="number">
				<input type="text" placeholder="Correo" id="mail">
				<label>Estados</label>
				<select>
					<option>Aguascalientes</option>
					<option>Baja California</option>
					<option>Baja California Sur</option>
					<option>Campeche</option>
					<option>Coahuila</option>
					<option>Colima</option>
					<option>Chiapas</option>
					<option>Chihuahua</option>
					<option>Distrito Federal</option>
					<option>Durango</option>
					<option>Guanajuato</option>
					<option>Guerrero</option>
					<option>Hidalgo</option>
					<option>Jalisco</option>
					<option>México</option>
					<option>Michoacan</option>
					<option>Morelos</option>
					<option>Nayarit</option>
					<option>Nuevo León</option>
					<option>Oaxaca</option>
					<option>Puebla</option>
					<option>Queretaro</option>
					<option>Quintana Roo</option>
					<option>San Luis Potosí</option>
					<option>Sinaloa</option>
					<option>Sonora</option>
					<option>Tabasco</option>
					<option>Tamaulipas</option>
					<option>Tlaxcala</option>
					<option>Veracruz</option>
					<option>Yucatan</option>
					<option>Zacatecas</option>
				</select>
			</form>
			<form action="" method="">
				<input type="number" placeholder="Valor del Inmueble" id="value">
				<input type="number" placeholder="Enganche" id="">
				<label>Tipo de Mensualidad</label>
				<select>
					<option>Seleccione una opción</option>
					<option>Fija</option>
					<option>Creciente</option>
				</select>
				<label>Plazo</label>
				<select>
					<option>20 años</option>
					<option>15 años</option>
				</select>
				<input type="submit" class="send">
			</form>
		</div>
		<p class="aviso">Respecto al manejo de sus datos personales favor de revisar el Aviso de Privacidad, así como los Términos y Condiciones incluidos en la presente página.</p>
		<p class="aviso check"><span><input type="checkbox" class="aviso"></span>Acepto Términos y Condiciones , así como el Aviso de Privacidad.</p>
	</div>
</div>
<div class="comments">
	<div class="contenido-comments">
		<div class="content">
			<p class="title">Testimonios</p>
			<ul>
				<li>
					<img src="./img/body/avatar.png" class="imgav1">
				</li>
				<li>
					<img src="./img/body/avatar2.png" class="imgav2">
				</li>
				<li>
					<img src="./img/body/avatar3.png" class="imgav3">
				</li>
			</ul>
			<div class="comentarios avuno">
				<p class="name">Alma Mejía</p>
				<p><span>"</span>Recomiendo el servicio, mi experiencia fue muy buena, la atención es muy profesional.</p>
			</div>
			<div class="comentarios avdos">
				<p class="name">Fidel Ruiz Chico</p>
				<p><span>"</span>Empresa con gente extraordinaria haciendo cosas excepcionales para que concretes tus sueños</p>
			</div>
			<div class="comentarios avtres">
				<p class="name">Ricardo Velázquez</p>
				<p><span>"</span>Muy bien Albas...solo recomendar a tus seguidores y amigos que Banorte entiende a las familias mexicanas y ofrece excelentes condiciones para que cambie su hipoteca con nosotros.</p>
			</div>
		</div>
	</div>
	<div class="contenido-comments iphone">
		<div class="content celular">
			<img src="./img/body/cel.png" class="cel">
			<img src="./img/body/cel2.png" class="cel two">
		</div>
	</div>
</div>
<?php include("_footer.php") ?>
