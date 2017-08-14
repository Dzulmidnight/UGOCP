<?php 
	require_once('mpdf/mpdf.php');
	require('../conexion/conexion.php');
	date_default_timezone_set('America/Mexico_City');
	$fecha_actual = time();
	$formato_fecha = date("d/m/Y:h:i:sa", time());
	if(isset($_POST['formato_afiliacion']) && $_POST['formato_afiliacion'] == 1){ // SE GENERA SOLO EL FORMATO DE EVALUACIÓN
		$folio = $_POST['folio'];

		$query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio WHERE afiliado.folio = $folio";
		$ejecutar = $mysqli->query($query);
		$detalle = $ejecutar->fetch_assoc();
		$num_folio = str_pad($detalle['folio'], 6, '0', STR_PAD_LEFT);
		$fecha_nacimiento = date('d/m/Y', $detalle['fecha_nacimiento']);
		$sexo = '';
		if($detalle['sexo'] = 'H'){
			$sexo = 'HOMBRE';
		}else{
			$sexo = 'MUJER';
		}
		$formato_fecha = date("d/m/Y:h:i:sa", time());
	    /// SE GENERA EL ARCHIVO PDF
	    $html = '

	        <div class="col-xs-12">
	            <table style="font-family: Tahoma, Geneva, sans-serif;font-size:12px;">
	                    <tr>
	                        <td style="text-align:left;padding:10px;" colspan="3"><h3>A).- DATOS GENERALES:</h3></td>
	                    </tr>
	                    <tr>
	                        <td style="text-align:center">
	                            <p>'.$detalle['ap_paterno'].'</p>
	                            <hr>
	                            <p class="pregunta">APELLIDO PARTENO</p>
	                        </td>
	                        <td style="text-align:center">
	                            <p>'.$detalle['ap_materno'].'</p>
	                            <hr>
	                            <p class="pregunta">APELLIDO MATERNO</p>
	                        </td>
	                        <td colspan="2" style="text-align:center">
	                            <p>'.$detalle['nombre'].'</p>
	                            <hr>
	                            <p class="pregunta">NOMBRE</p>
	                        </td>
	                    <tr>
	                    <tr>
							<td style="padding-top:1em;" colspan="2">
								<p><span class="pregunta">DIRECCIÓN</span>: '.$detalle['calle'].'</p>
								<hr>
							</td>
							<td style="padding-top:1em;" colspan="2">
								<p><span class="pregunta">NÚMERO: </span>'.$detalle['numero'].'</p>
								<hr>
							</td>
	                    </tr>
	                    <tr>
							<td style="text-align:center;padding-top:1em;">
								<p>'.$detalle['colonia'].'</p>
								<hr>
								<p class="pregunta">COLONIA</p>
							</td>
							<td style="text-align:center;padding-top:1em;">
								<p>'.$detalle['cp'].'</p>
								<hr>
								<p class="pregunta">CÓDIGO POSTAL</p>
							</td>
							<td colspan="2" style="text-align:center;padding-top:1em;">
								<p>&nbsp;'.$detalle['ciudad'].'</p>
								<hr>
								<p class="pregunta">CIUDAD O POBLACIÓN</p>
							</td>
	                    </tr>

	                    <tr>
							<td style="text-align:center">
								<p>'.$detalle['municipio'].'</p>
								<hr>
								<p class="pregunta">MUNICIPIO</p>
							</td>
							<td style="text-align:center">
								<p>'.$detalle['estado'].'</p>
								<hr>
								<p class="pregunta">ESTADO</p>
							</td>
							<td style="text-align:center">
								<p>'.$detalle['telefono'].'</p>
								<hr>
								<p class="pregunta">TELÉFONO PART.</p>
							</td>
							<td style="text-align:center">
								<p>'.$detalle['celular'].'</p>
								<hr>
								<p class="pregunta">CELULAR</p>
							</td>
	                    </tr>
	                    <tr>
	                    	
							<td colspan="4">
								<p><span class="pregunta">CORREO ELECTRÓNICO</span>: '.$detalle['correo'].'</p>
								<hr>
							</td>
	                    </tr>

	                    <tr>
	                        <td>
	                        	<p><span class="pregunta">EDAD</span>: '.$detalle['edad'].' AÑOS</p>
								<hr>
	                        </td>
	                        <td>
								<p><span class="pregunta">SEXO:</span> '.$sexo.'</p>
								<hr>
	                        </td>
	                        <td colspan="2">
								<p><span class="pregunta">ESTADO CIVIL:</span> '.$detalle['estado_civil'].'</p>
								<hr>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td colspan="2" style="text-align:center">
	                        	<p>'.$detalle['grupo_indigena'].'</p>
								<hr>
								<p class="pregunta">¿PERTENECE A UN GRUPO INDIGENA?</p>
	                        </td>
	                        <td colspan="2" style="text-align:center">
								<p>'.$detalle['nombre_comunidad'].'</p>
								<hr>
								<p class="pregunta">NOMBRE DEL GRUPO INDIGENA</p>
	                        </td>
	                    </tr>

	                    <tr>
	                        <td style="text-align:left;padding:10px;" colspan="3"><h3>B).- INFORMACIÓN PROFESIONAL O LABORAL:</h3></td>
	                    </tr>

	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">OCUPACIÓN:</span> '.$detalle['ocupacion'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">CARGO O PUESTO QUE DESEMPEÑA:</span> '.$detalle['cargo'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">NOMBRE DE LA EMPRESA:</span> '.$detalle['empresa'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">TELS. OFICINA:</span> '.$detalle['tel_oficina'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td style="text-align:left;padding:10px;" colspan="3"><h3>C).- INFORMACIÓN COMPLEMENTARIA:</h3></td>
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">CLAVE ÚNICA DE REGISTRO POBLACIONAL (CURP):</span> '.$detalle['curp'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">CLAVE DE ELECTOR (CREDENCIAL INE):</span> '.$detalle['clave_elector'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="4">
	                        	<p><span class="pregunta">No. DE CREDENCIAL DEL INE (PARTE POSTERIOR):</span> '.$detalle['num_ine'].'</p>
	                        	<hr>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td style="text-align:left;padding:10px;" colspan="3"><h3>D).- DECLARACIÓN:</h3></td>
	                    </tr>


	                    <tr>
	                        <td colspan="4" style="text-align:justify;font-size:11px;">
								POR MEDIO DE LA PRESENTE, SOLICITO LIBRE Y CONCIENTE, Y VOLUNTARIAMENTE MI AFILIACIÓN A LA UNIÓN GENERAL OBRERO, CAMPESINA Y POPULAR -UGOCP- ME OBLIGO A RESPETAR EL ESTATUTO, EL PROGRAMA, LOS PRINCIPIOS Y LAS NORMAS CONSTITUTIVAS QUE LE RIGEN, ASI COMO A OBSERVAR LOS ACUERDOS EMANADOS DE SUS CONGRESOS, PLENOS DE REPRESENTANTES Y ASAMBLEAS GENERALES, IGUALMENTE A CONTRIBUIR AL FORTALECIMIENTO DE SU ESTRUCTURA Y A VELAR POR LA UNIDAD, PROSPERIDAD E INTEGRIDAD DE ESTA ORGANIZACIÓN.						
	                        </td>			
	                    </tr>
	                    <tr style="border:none">
	                        <td colspan="4" style="text-align:center">
								<hr style="width:40%;margin-top:30px;">
								FIRMA					
	                        </td>			
	                    </tr>
	            </table>
	        </div>';


	    //$mpdf = new mPDF('c', 'Letter'); // seleccionamos el tamaño de la hoja
	    $mpdf = new mPDF('c', 'A4');
	    ob_start();

	    $mpdf->setAutoTopMargin = 'pad';
	    $mpdf->keep_table_proportions = TRUE;
	    $mpdf->SetHTMLHeader('
	    <header class="clearfix" style="padding-bottom:-5em;">
	      <div>
	        <table style="border:none">
	          <tr>
	            <td style="width:25%;text-align:center;font-size:12px;">
	                  <div>
	                    <img src="../img/logo_ugocp_pdf.png" >
	                  </div>
	            </td>
	            <td style="text-align:center;">
	                 	<div>
			                <h2>
			                    UNIÓN GENERAL OBRERO, CAMPESINA Y POPULAR A.C.
			                </h2>             
	                	</div>
	                	<div>
							<h2 style="background-color:#7f8c8d;color:#fff;">CEDULA DE AFILIACIÓN</h2>
	                	</div>
	            </td>
	            <td style="width:25%;text-align:center">
	            	<img style="border:2px solid #000000;width:145px;height:170px;" src="'.$detalle['foto'].'">
	            	<h2>FOLIO: <span style="color:#e74c3c">Nº'.$num_folio.'</span></h2>
	            </td>
	          </tr>
	        </table>
	      </div>
	    </header>
	      ');

/*$mpdf = new mPDF('c', 'A4');
		$css = file_get_contents('css/style.css');	
		$mpdf->writeHTML($css,1);
		$mpdf->writeHTML($html);
		$mpdf->Output('reporte.pdf', 'I');*/

	    $css = file_get_contents('reportes/style_reporte.css');  
	    //$mpdf->AddPage('L'); //se cambia la orientacion de la pagina
	    //$mpdf->pagenumPrefix = $formato_fecha.' - Página';
	    $mpdf->pagenumSuffix = ' - ';
	    $mpdf->nbpgPrefix = ' de ';
	    //$mpdf->nbpgSuffix = ' pages';
	    $mpdf->SetHTMLFooter('
			<footer>
				<table>
					<tr style="background:#e74c3c">
						<td style="font-size:10px;text-align:center;color:#ffffff;padding-top:4px;padding-bottom:7px;">
							<p>
								Luis G. Monzón No. 400 esq. con Ramón Guzmán - Col. Sochiloa - C.P: 85150 Ciudad Obregón, Sonora - Tel/Fax (644)416-58-57
							</p>
							<p>
								E-mail: ugocpn@prodigy.net.mx www.ugocp.com.mx
							</p>
						</td>
					</tr>
				</table>
			</footer>
	    	');
	    $mpdf->writeHTML($css,1);

	    ob_end_clean();

	    $mpdf->writeHTML($html);
	    //$pdf_listo = $mpdf->Output('reporte.pdf', 'I');
	    
	    /// CON LA LINEA DE ABAJO GENERAMOS EL PDF Y LO ENVIAMOS POR EMAIL, PERO NO LO GUARDAMOS
	    //28_03_2017 $pdf_listo = $mpdf->Output('reporte_trimestral.pdf', 'S'); //reemplazamos la I por S(regresa el documento como string)
	    /// CON LA LINEA DE ABAJO GENERAMOS EL PDF Y LO GUARDAMOS EN UNA CARPETA
	    //13_07_2017$mpdf->Output(''.$ruta_pdf.''.$nombre_pdf.'', 'F'); //reemplazamos la I por S(regresa el documento como string)
	    $mpdf->Output('Formato_afiliación.pdf', 'I');

	    /// FIN

	}
	if(isset($_POST['credencial']) && $_POST['credencial'] == 2){

		$folio = $_POST['folio'];

		$query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio WHERE afiliado.folio = $folio";
		$ejecutar = $mysqli->query($query);
		$detalle = $ejecutar->fetch_assoc();
		$num_folio = str_pad($detalle['folio'], 6, '0', STR_PAD_LEFT);
		$fecha_nacimiento = date('d/m/Y', $detalle['fecha_nacimiento']);
		$sexo = '';
		if($detalle['sexo'] = 'H'){
			$sexo = 'HOMBRE';
		}else{
			$sexo = 'MUJER';
		}
		$nombre = $detalle['nombre'].' '.$detalle['ap_paterno'].' '.$detalle['ap_materno'];
		$direccion = $detalle['calle'].' #'.$detalle['numero'].', COL. '.$detalle['colonia'].', C.P. '.$detalle['cp'].', MUNICIPIO '.$detalle['municipio'].', '.$detalle['estado'];

		$html = '
			<style>
			table{
				font-family: Arial;
			}
			p{
				font-family: Arial;
				font-size:10px;
			}
			.otro{
				background-image: url("../img/fondo.png");
				background-repeat: no-repeat;
				background-size: cover;
			}
			</style>
				<table  border="0" style="border: 1px dotted black; font-size:8xp;font-family:arial;color:#1a292c">
					<tr>
						<!-- INICIA CARA FRONTAL -->
						<td style="padding-top:-5px;border:6px solid #1a292c;width:9cm;height:6cm;">
							<table class="otro" style="font-size:10px;">
								<tr>
									<td>
										<img src="../img/logo_ugocp_pdf.png" style="width:1.5cm; height:1.5cm;"/>									
									</td>
									<td style="padding-left:5px;color:#ffffff;">
										<div >
											<p>
												<b>UNIÓN GENERAL OBRERO,<br>
												CAMPESINA Y POPULAR, A.C.</b><br>
												<hr style="border:1px solid #2c3e50;width:100%">
													
											</p>
										</div>

									</td>
									<td style="padding-left:20px;" rowspan="2">
										<div>
											<img src="'.$detalle['foto'].'" style="border: 3px solid #1a292c; width:2cm; height:2.5cm;"/>
											<br>
					                		<span style="color:#1a292c;">Folio: <b style="color:#e13737">'.$num_folio.'</b></span>
										</div>

									</td>
								</tr>
								<tr>
									<td style="text-align:center;padding-top:20px;" colspan="2">
										<p>'.$nombre.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;">
										<b style="text-align:center">Nombre</b>	
									</td>
								</tr>
								<tr>
									<td colspan="3" style="padding-top:10px;padding-bottom:10px;">
										<p><b>Cargo:</b> '.$detalle['cargo'].'</p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['telefono'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Teléfono</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['celular'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Celular</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;</p>
										<hr style="border:1px solid #2c3e50;">
										<p>
											<b>Firma Afiliado</b>
										</p>

									</td>
								</tr>
							
							</table>							
						</td>
						<!-- TERMINA CARA FRONTAL -->

						<!-- INICIA CARA TRASERA -->
						<td style="border:3px solid #e13737;width:9cm;height:6cm;">
							<table style="font-size:10px;">
								<tr>
									<td style="width:50%;text-align:center">
										'.$detalle['curp'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>CURP</b>
									</td>
									<td style="width:50%;text-align:center">
										'.$detalle['rfc'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>RFC</b>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['clave_elector'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Clave Elector</b></p>
									</td>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['num_ine'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Nº INE</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;text-align:center" colspan="2">
										<p>'.$direccion.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Domicilio</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center;" colspan="2">
										<p style="">
											<img style="" src="../img/firma_ugocp.jpg"></img>
										</p>
										<p>Lic. Enrique Jacob González Rojas</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p>
											Secretario General
										</p>

									</td>
								</tr>

							</table>
						</td>
						<!-- TERMINA CARA TRASERA -->
					</tr>
				</table>
	           

		';
		$mpdf = new mPDF('c', 'A4');
	    ob_start();
	    $css = file_get_contents('reportes/style_reporte.css');  
	    $mpdf->pagenumPrefix = $formato_fecha.' - Página';
	    $mpdf->pagenumSuffix = ' - ';
	    $mpdf->nbpgPrefix = ' de ';
	    //$mpdf->nbpgSuffix = ' pages';
	    $mpdf->SetFooter('{PAGENO}{nbpg}');

	    ob_end_clean();
	    $mpdf->writeHTML($html);
		$mpdf->Output();
		exit();
	}

    /// INICIA - GENERAMOS EL FORMATO DE AFILIACIÓN Y CREDENCIAL POR PRIMERA VEZ
    if(isset($_POST['folio_primera_vez']) && $_POST['folio_primera_vez'] != 0){

      $folio = $_POST['folio_primera_vez'];

      $query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio WHERE afiliado.folio = $folio";
      $ejecutar = $mysqli->query($query);
      $detalle = $ejecutar->fetch_assoc();
      $num_folio = str_pad($detalle['folio'], 6, '0', STR_PAD_LEFT);
      $fecha_nacimiento = date('d/m/Y', $detalle['fecha_nacimiento']);
      $sexo = '';
      if($detalle['sexo'] = 'H'){
        $sexo = 'HOMBRE';
      }else{
        $sexo = 'MUJER';
      }
      
		$nombre = $detalle['nombre'].' '.$detalle['ap_paterno'].' '.$detalle['ap_materno'];
		$direccion = $detalle['calle'].' #'.$detalle['numero'].', COL. '.$detalle['colonia'].', C.P. '.$detalle['cp'].', MUNICIPIO '.$detalle['municipio'].', '.$detalle['estado'];

        /// SE GENERA EL ARCHIVO PDF

         $html = '
			<style>
				table{
					font-family: Arial;
				}
				p{
					font-family: Arial;
					font-size:10px;
				}
				.otro{
					background-image: url("../img/fondo.png");
					background-repeat: no-repeat;
					background-size: cover;
				}

            </style>
				<table  border="0" style="border: 1px dotted black; font-size:8xp;font-family:arial;color:#1a292c">
					<tr>
						<!-- INICIA CARA FRONTAL -->
						<td style="padding-top:-5px;border:6px solid #1a292c;width:9cm;height:6cm;">
							<table class="otro" style="font-size:10px;">
								<tr>
									<td>
										<img src="../img/logo_ugocp_pdf.png" style="width:1.5cm; height:1.5cm;"/>									
									</td>
									<td style="padding-left:5px;color:#ffffff;">
										<div >
											<p>
												<b>UNIÓN GENERAL OBRERO,<br>
												CAMPESINA Y POPULAR, A.C.</b><br>
												<hr style="border:1px solid #2c3e50;width:100%">
													
											</p>
										</div>

									</td>
									<td style="padding-left:20px;" rowspan="2">
										<div>
											<img src="'.$detalle['foto'].'" style="border: 3px solid #1a292c; width:2cm; height:2.5cm;"/>
											<br>
					                		<span style="color:#1a292c;">Folio: <b style="color:#e13737">'.$num_folio.'</b></span>
										</div>

									</td>
								</tr>
								<tr>
									<td style="text-align:center;padding-top:20px;" colspan="2">
										<p>'.$nombre.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;">
										<b style="text-align:center">Nombre</b>	
									</td>
								</tr>
								<tr>
									<td colspan="3" style="padding-top:10px;padding-bottom:10px;">
										<p><b>Cargo:</b> '.$detalle['cargo'].'</p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['telefono'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Teléfono</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['celular'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Celular</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;</p>
										<hr style="border:1px solid #2c3e50;">
										<p>
											<b>Firma Afiliado</b>
										</p>

									</td>
								</tr>
							
							</table>							
						</td>
						<!-- TERMINA CARA FRONTAL -->

						<!-- INICIA CARA TRASERA -->
						<td style="border:3px solid #e13737;width:9cm;height:6cm;">
							<table style="font-size:10px;">
								<tr>
									<td style="width:50%;text-align:center">
										'.$detalle['curp'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>CURP</b>
									</td>
									<td style="width:50%;text-align:center">
										'.$detalle['rfc'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>RFC</b>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['clave_elector'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Clave Elector</b></p>
									</td>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['num_ine'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Nº INE</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;text-align:center" colspan="2">
										<p>'.$direccion.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Domicilio</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center;" colspan="2">
										<p style="">
											<img style="" src="../img/firma_ugocp.jpg"></img>
										</p>
										<p>Lic. Enrique Jacob González Rojas</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p>
											Secretario General
										</p>

									</td>
								</tr>

							</table>
						</td>
						<!-- TERMINA CARA TRASERA -->
					</tr>
				</table>

                <table style="font-family: Tahoma, Geneva, sans-serif;font-size:12px;">
					<tr>
						<td style="text-align:center;padding:10px;background-color:#bdc3c7;color:#2c3e50;" colspan="4">
							<b>FORMATO DE AFILIACIÓN - FOLIO: <span style="color:#e74c3c">Nº '.$num_folio.'</span></b>
						</td>
					</tr>
                    <tr>
                    	<td style="text-align:left;padding:10px;" colspan="3">
                    		<h3>A).- DATOS GENERALES:</h3>
                    	</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <p>'.$detalle['ap_paterno'].'</p>
                            <hr style="margin-top:0px;margin-bottom:0px;">
                            <p class="pregunta">APELLIDO PARTENO</p>
                        </td>
                        <td style="text-align:center">
                            <p>'.$detalle['ap_materno'].'</p>
                            <hr style="margin-top:0px;margin-bottom:0px;">
                            <p class="pregunta">APELLIDO MATERNO</p>
                        </td>
                    	<td colspan="2" style="text-align:center">
                            <p>'.$detalle['nombre'].'</p>
                            <hr style="margin-top:0px;margin-bottom:0px;">
                            <p class="pregunta">NOMBRE</p>
                    	</td>
                    <tr>
                    <tr>
						<td style="padding-top:1em;" colspan="2">
							<p><span class="pregunta">DIRECCIÓN</span>: '.$detalle['calle'].'</p>
							<hr style="margin-top:0px;">
						</td>
						<td style="padding-top:1em;" colspan="2">
							<p><span class="pregunta">NÚMERO: </span>'.$detalle['numero'].'</p>
							<hr style="margin-top:0px;">
						</td>
                    </tr>
                    <tr>
						<td style="text-align:center;padding-top:1em;">
							<p>'.$detalle['colonia'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">COLONIA</p>
						</td>
						<td style="text-align:center;padding-top:1em;">
							<p>'.$detalle['cp'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">CÓDIGO POSTAL</p>
						</td>
						<td colspan="2" style="text-align:center;padding-top:1em;">
							<p>&nbsp;'.$detalle['ciudad'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">CIUDAD O POBLACIÓN</p>
						</td>
                    </tr>
                    <tr>
						<td style="text-align:center">
							<p>'.$detalle['municipio'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">MUNICIPIO</p>
						</td>
						<td style="text-align:center">
							<p>'.$detalle['estado'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">ESTADO</p>
						</td>
						<td style="text-align:center">
							<p>'.$detalle['telefono'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">TELÉFONO PART.</p>
						</td>
						<td style="text-align:center">
							<p>'.$detalle['celular'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">CELULAR</p>
						</td>
                    </tr>
                    <tr>
                    	
						<td colspan="4">
							<p><span class="pregunta">CORREO ELECTRÓNICO</span>: '.$detalle['correo'].'</p>
							<hr style="margin-top:0px;">
						</td>
                    </tr>
                    <tr>
                        <td>
                        	<p><span class="pregunta">EDAD</span>: '.$detalle['edad'].' AÑOS</p>
							<hr style="margin-top:0px;">
                        </td>
                        <td>
							<p><span class="pregunta">SEXO:</span> '.$sexo.'</p>
							<hr style="margin-top:0px;">
                        </td>
                        <td colspan="2">
							<p><span class="pregunta">ESTADO CIVIL:</span> '.$detalle['estado_civil'].'</p>
							<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                        	<p>'.$detalle['grupo_indigena'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">¿PERTENECE A UN GRUPO INDIGENA?</p>
                        </td>
                        <td colspan="2" style="text-align:center">
							<p>'.$detalle['nombre_comunidad'].'</p>
							<hr style="margin-top:0px;margin-bottom:0px;">
							<p class="pregunta">NOMBRE DEL GRUPO INDIGENA</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left;padding:10px;" colspan="3"><h3>B).- INFORMACIÓN PROFESIONAL O LABORAL:</h3></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">OCUPACIÓN:</span> '.$detalle['ocupacion'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">CARGO O PUESTO QUE DESEMPEÑA:</span> '.$detalle['cargo'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">NOMBRE DE LA EMPRESA:</span> '.$detalle['empresa'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">TELS. OFICINA:</span> '.$detalle['tel_oficina'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>

                    <tr>
                        <td style="text-align:left;padding:10px;" colspan="3">
                        	<h3>C).- INFORMACIÓN COMPLEMENTARIA:</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">CLAVE ÚNICA DE REGISTRO POBLACIONAL (CURP):</span> '.$detalle['curp'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">CLAVE DE ELECTOR (CREDENCIAL INE):</span> '.$detalle['clave_elector'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td colspan="4">
                        	<p><span class="pregunta">No. DE CREDENCIAL DEL INE (PARTE POSTERIOR):</span> '.$detalle['num_ine'].'</p>
                        	<hr style="margin-top:0px;">
                        </td>			
                    </tr>
                    <tr>
                        <td style="text-align:left;padding:10px;" colspan="4">
                        	<h3>D).- DECLARACIÓN:</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:justify;font-size:10px;">
							POR MEDIO DE LA PRESENTE, SOLICITO LIBRE Y CONCIENTE, Y VOLUNTARIAMENTE MI AFILIACIÓN A LA UNIÓN GENERAL OBRERO, CAMPESINA Y POPULAR -UGOCP- ME OBLIGO A RESPETAR EL ESTATUTO, EL PROGRAMA, LOS PRINCIPIOS Y LAS NORMAS CONSTITUTIVAS QUE LE RIGEN, ASI COMO A OBSERVAR LOS ACUERDOS EMANADOS DE SUS CONGRESOS, PLENOS DE REPRESENTANTES Y ASAMBLEAS GENERALES, IGUALMENTE A CONTRIBUIR AL FORTALECIMIENTO DE SU ESTRUCTURA Y A VELAR POR LA UNIDAD, PROSPERIDAD E INTEGRIDAD DE ESTA ORGANIZACIÓN.					
                        </td>			
                    </tr>
                    <tr style="border:none">
                        <td colspan="4" style="text-align:center">
							<hr style="width:40%;margin-top:30px;">
							FIRMA					
                        </td>			
                    </tr>

					<tr style="background:#e74c3c">
						<td colspan="4" style="text-align:center;color:#ffffff;padding-top:2px;padding-bottom:5px;">
							<p>
								Luis G. Monzón No. 400 esq. con Ramón Guzmán - Col. Sochiloa - C.P: 85150 Ciudad Obregón, Sonora - Tel/Fax (644)416-58-57
							</p>
							<p>
								E-mail: ugocpn@prodigy.net.mx www.ugocp.com.mx
							</p>
						</td>
					</tr>

                </table>

        ';


          $mpdf = new mPDF('c','A4','','','15','15','10','10');
          ob_start();
          $css = file_get_contents('reportes/style2_reporte.css');  
          $mpdf->setAutoTopMargin = 'pad';
          $mpdf->keep_table_proportions = TRUE;
          //$mpdf->pagenumPrefix = $formato_fecha.' - Página';
          //$mpdf->pagenumSuffix = ' - ';
          //$mpdf->nbpgPrefix = ' de ';
          //$mpdf->nbpgSuffix = ' pages';
        
          $mpdf->writeHTML($css,1);
          ob_end_clean();
          $mpdf->writeHTML($html);
          $mpdf->Output($fecha_actual.'_formato_afiliacion_credencial.pdf', 'D'); // parametro "D" es para descargar directamente

    }
    /// TERMINA - GENERAMOS EL FORMATO DE AFILIACIÓN Y CREDENCIAL POR PRIMERA VEZ

	if(isset($_GET['lista'])){
		$lista = explode(',', $_GET['lista']);

		foreach ($lista as $value) {
			if(!empty($value)){
				$num_folios[] = $value;
			}
		}
		$num_registros = count($num_folios);
		$contador = 1;

		//echo 'EL NUMERO DE FOLIOS ES: '.$num_registros.'<br>';
		$concatenado = '';

		foreach ($num_folios as $value2) {

			
			if($contador < $num_registros){
				 $concatenado .= 'afiliado.folio = '.$value2.' OR ';
			}else{
				$concatenado .= 'afiliado.folio = '.$value2;
			}
			$contador++;
			
		}
		//echo 'LA VARIABLE ES: '.$concatenado;


		$query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio WHERE $concatenado";

		//echo '<br>'.$query;
		
		$ejecutar = $mysqli->query($query);

		//$detalle = $ejecutar->fetch_assoc();


		$html = '
			<style>
				table{
					font-family: Arial;
				}
				p{
					font-family: Arial;
					font-size:10px;
				}
				.otro{
					background-image: url("../img/fondo.jpg");
					background-repeat: no-repeat;
					background-size: cover;
				}
			</style>';
		while($detalle = $ejecutar -> fetch_assoc()){
			$num_folio = str_pad($detalle['folio'], 6, '0', STR_PAD_LEFT);
			$fecha_nacimiento = date('d/m/Y', $detalle['fecha_nacimiento']);
			$sexo = '';
			if($detalle['sexo'] = 'H'){
				$sexo = 'HOMBRE';
			}else{
				$sexo = 'MUJER';
			}
			$nombre = $detalle['nombre'].' '.$detalle['ap_paterno'].' '.$detalle['ap_materno'];
			$direccion = $detalle['calle'].' #'.$detalle['numero'].', COL. '.$detalle['colonia'].', C.P. '.$detalle['cp'].', MUNICIPIO '.$detalle['municipio'].', '.$detalle['estado'];

			$html .= '
				<table  border="0" style="border: 1px dotted black; font-size:8xp;font-family:arial;color:#1a292c">
					<tr>
						<!-- INICIA CARA FRONTAL -->
						<td style="padding-top:-5px;border:6px solid #1a292c;width:9cm;height:6cm;">
							<table class="otro" style="font-size:10px;">
								<tr>
									<td>
										<img src="../img/logo_ugocp_pdf.png" style="width:1.5cm; height:1.5cm;"/>									
									</td>
									<td style="padding-left:5px;color:#ffffff;">
										<div >
											<p>
												<b>UNIÓN GENERAL OBRERO,<br>
												CAMPESINA Y POPULAR, A.C.</b><br>
												<hr style="border:1px solid #2c3e50;width:100%">
													
											</p>
										</div>

									</td>
									<td style="padding-left:20px;" rowspan="2">
										<div>
											<img src="'.$detalle['foto'].'" style="border: 3px solid #1a292c; width:2cm; height:2.5cm;"/>
											<br>
					                		<span style="color:#1a292c;">Folio: <b style="color:#e13737">'.$num_folio.'</b></span>
										</div>

									</td>
								</tr>
								<tr>
									<td style="text-align:center;padding-top:20px;" colspan="2">
										<p>'.$nombre.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;">
										<b style="text-align:center">Nombre</b>	
									</td>
								</tr>
								<tr>
									<td colspan="3" style="padding-top:10px;padding-bottom:10px;">
										<p><b>Cargo:</b> '.$detalle['cargo'].'</p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['telefono'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Teléfono</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;'.$detalle['celular'].'</p>
										<hr style="border:1px solid #2c3e50;">
										<p><b>Celular</b></p>
									</td>
									<td style="padding-top:5px;text-align:center" >
										<p>&nbsp;</p>
										<hr style="border:1px solid #2c3e50;">
										<p>
											<b>Firma Afiliado</b>
										</p>

									</td>
								</tr>
							
							</table>							
						</td>
						<!-- TERMINA CARA FRONTAL -->

						<!-- INICIA CARA TRASERA -->
						<td style="border:3px solid #e13737;width:9cm;height:6cm;">
							<table style="font-size:10px;">
								<tr>
									<td style="width:50%;text-align:center">
										'.$detalle['curp'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>CURP</b>
									</td>
									<td style="width:50%;text-align:center">
										'.$detalle['rfc'].'
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<b>RFC</b>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['clave_elector'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Clave Elector</b></p>
									</td>
									<td style="padding-top:10px;width:50%;text-align:center">
										<p>'.$detalle['num_ine'].'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Nº INE</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;text-align:center" colspan="2">
										<p>'.$direccion.'</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p><b>Domicilio</b></p>
									</td>
								</tr>
								<tr>
									<td style="padding-top:5px;text-align:center;" colspan="2">
										<p style="">
											<img style="" src="../img/firma_ugocp.jpg"></img>
										</p>
										<p>Lic. Enrique Jacob González Rojas</p>
										<hr style="border:1px solid #2c3e50;width:100%;margin-bottom:0px;margin-top:0px;">
										<p>
											Secretario General
										</p>

									</td>
								</tr>

							</table>
						</td>
						<!-- TERMINA CARA TRASERA -->
					</tr>
				</table>';

		}

$style='<style>@page *{
margin-top: 1cm;
    margin-bottom: 1cm;
    margin-left: 1cm;
    margin-right: 1cm;
}</style>';
		$mpdf = new mPDF('c','A4','','','15','15','10','10'); 
	    ob_start();



	    ob_end_clean();
	    $css = file_get_contents('reportes/style_reporte.css');  
	    $mpdf->writeHTML($html);
	    //$mpdf->WriteHTML($style);
		$mpdf->Output();
		exit();


	}