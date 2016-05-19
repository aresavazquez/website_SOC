<?php include("_head.php") ?>
<?php include("_menuMicrositios.php") ?>
<div class="content-usuario">
	<div>
		
		<p class="titulo">Micrositios</p>
		<input type="search" placeholder="buscar" class="search">
		<a href="" class="plusUser">+ Agregar micrositio</a>
		<table>
			<thead>
				<tr class="back-white">
					<td>Nombre de usuario</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>J VEGA BROKERS</td>
					<td class="editInput"><a href="">Editar</a></td>
				</tr>
				<tr>
					<td>CRECE ASESORIA HIPOTECARIA Yucatan</td>
					<td class="editInput"><a href="">Editar</a></td>
				</tr>
				<tr>
					<td>UP CREDITS</td>
					<td class="editInput"><a href="">Editar</a></td>
				</tr>
				<tr>
					<td>EXCELENCIA EN ASESORIA HIPOTECARIA</td>
					<td class="editInput"><a href="">Editar</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="agregarUsuario">
	<form class="datosUsuario microsite">
	<a href=""><img src="./img/body/close.png" class="close"></a>
		<label>Encabezado</label>
		<input type="text" placeholder="Nombre del sitio" class="edit_input">
		<label>Imágenes Slider</label>
		<div class="img_slider"></div>
		<input type="text" placeholder="1er título" class="edit_input">
		<textarea placeholder="Descripción" class="edit_input"></textarea>
		<label>Imágenes</label>
		<ul>
			<li>
				<input type="radio">
				<img src="./img/micrositios/img1.jpg">
			</li>
			<li>
				<input type="radio">
				<img src="./img/micrositios/img2.jpg">
			</li>
			<li>
				<input type="radio">
				<img src="./img/micrositios/img3.jpg">
			</li>
		</ul>
		<p>Las fotos deben ser en formato JPG o PNG. Tamaño 320 x 165px</p>
		<br>
		<div class="edit_photo">
			<label class="foto">Foto 1</label>
			<input type="file">
			<textarea placeholder="Descripción foto 1"></textarea>
			<label class="foto">Foto 2</label>
			<input type="file">
			<textarea placeholder="Descripción foto 2"></textarea>
			<label class="foto">Foto 3</label>
			<input type="file">
			<textarea placeholder="Descripción foto 3"></textarea>
		</div>
		<br>
		<label>Scción Simulador</label>
		<input type="text" placeholder="2do título" class="edit_input">
		<textarea placeholder="Descripción" class="edit_input"></textarea>
		<input type="text" placeholder="Ingresa tu widget" class="edit_input">
		<label>Ingresa las coordenadas de tu ubicación</label>
		<input type="text" placeholder="Coordenadas Del Mapa" class="edit_input">
		<label>Localidad</label>
		<input type="text" placeholder="Localidad" class="edit_input">
		<input type="number" placeholder="Teléfono" class="edit_input">
		<input type="text" placeholder="Dirección" class="edit_input">
		<button>Guardar</button>
		<button class="borrar">Borrar</button>
	</form>
</div>
<?php include("_footer.php") ?>