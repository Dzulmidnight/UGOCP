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
	                        <td style="text-align:left;padding:10px;" colspan="3"><h3>A).- DATOS GENERALES</h3></td>
	                    </tr>
	                    <tr>
	                        <td>
	                            <b>'.$detalle['ap_paterno'].'</b>
	                            <p class="borde">APELLIDO PARTENO</p>
	                        </td>
	                        <td>
	                            <b>'.$detalle['ap_materno'].'</b>
	                            <p class="borde">APELLIDO MATERNO</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['nombre'].'</b>
	                            <p class="borde">NOMBRE</p>
	                        </td>
	                    <tr>
	                    <tr>
	                        <td >
	                            <b>'.$detalle['calle'].'</b>
	                            <p>CALLE</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['numero'].'</b>
	                            <p>NÚMERO</p>
	                        </td>	
	                        <td >
	                            <b>'.$detalle['colonia'].'</b>
	                            <p>COLONIA</p>
	                        </td>

	                    </tr>

	                    <tr>
	                        <td >
	                            <b>'.$detalle['cp'].'</b>
	                            <p>CÓDIGO POSTAL</p>
	                        </td>
	                        <td colspan="2">
	                            <b>'.$detalle['ciudad'].'</b>
	                            <p>CIUDAD, POBLACIÓN O LOCALIDAD</p>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td colspan="2" >
	                            <b>'.$detalle['municipio'].'</b>
	                            <p>MUNICIPIO</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['estado'].'</b>
	                            <p>ESTADO</p>
	                        </td>
	                        			
	                    </tr>

	                    <tr>
	                        <td>
	                            <b>'.$detalle['correo'].'</b>
	                            <p>CORREO ELECTRONICO</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['telefono'].'</b>
	                            <p>TELÉFONO</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['celular'].'</b>
	                            <p>CELULAR</p>
	                        </td>
			
	                    </tr>

	                    <tr>
	                        <td >
	                            <b>'.$detalle['fecha_nacimiento'].'</b>
	                            <p>FECHA DE NACIMIENTO</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['edad'].'</b>
	                            <p>EDAD</p>
	                        </td>
	                        <td >
	                            <b>'.$sexo.'</b>
	                            <p>SEXO</p>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td >
	                            <b>'.$detalle['estado_civil'].'</b>
	                            <p>ESTADO CIVIL</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['grupo_indigena'].'</b>
	                            <p>GRUPO INDIGENA</p>
	                        </td>
	                        <td >
	                            <b>'.$detalle['nombre_comunidad'].'</b>
	                            <p>NOMBRE DEL GRUPO</p>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td style="text-align:left;padding:15px;background-color:#e74c3c;color:#ffffff;" colspan="3">B).- INFORMACIÓN PROFESIONAL O LABORAL</td>
	                    </tr>

	                    <tr>
	                        <td >
	                            OCUPACIÓN:
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['ocupacion'].'</b>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td >
	                            CARGO O PUESTO QUE DESEMPEÑA:
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['cargo'].'</b>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td >
	                            NOMBRE DE LA EMPRESA:
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['empresa'].'</b>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td >
	                            TEL. OFICINA:
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['tel_oficina'].'</b>
	                        </td>			
	                    </tr>

	                    <tr>
	                        <td style="text-align:left;padding:15px;background-color:#e74c3c;color:#ffffff;" colspan="3">C).- INFORMACIÓN COMPLEMENTARIA</td>
	                    </tr>

	                    <tr>
	                        <td >
	                            CLAVE ÚNICA DE REGISTRO POBLACIONAL (CURP):
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['curp'].'</b>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td >
	                            CLAVE DE ELECTOR:
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['clave_elector'].'</b>
	                        </td>			
	                    </tr>
	                    <tr>
	                        <td >
	                            No. DE CREDENCIAL DEL INE (PARTE POSTERIOR):
	                        </td>
	                        <td colspan="2" >
	                            <b>'.$detalle['num_ine'].'</b>
	                        </td>			
	                    </tr>


	                    <tr>
	                        <td style="text-align:left;padding:15px;background-color:#e74c3c;color:#ffffff;" colspan="3">D).- DECLARACIÓN</td>
	                    </tr>

	                    <tr>
	                        <td colspan="3" style="text-align:justify;border: 1px solid #ddd">
								POR MEDIO DE LA PRESENTE SOLICITO LIBRE, CONSCIENTE Y VOLUNTARIAMENTE MI AFILIACIÓN A LA UNIÓN GENERAL, OBRERO, CAMPESINA Y POPULAR A.C. -UGOCP-. ME OBLIGO A RESPETAR EL ESTATUTO. EL PROGRAMA, LOS PRINCIPIOS Y LAS NORMAS CONSTITUTIVAS QUE LA RIGEN, ASÍ COMO A OBSERVAR LOS ACUERDOS EMANADOS DE SUS CONGRESOS, PLENOS DE REPRESENTANTES Y ASAMBLEAS GENERALES. IGUALMENTE A CONTRIBUIR AL FORTALECIMIENTO DE SU ESTRUCTURA Y A VELAR POR LA UNIDAD, PROSPERIDAD E INTEGRIDAD DE ESTA ORGANIZACIÓN.						
	                        </td>			
	                    </tr>
	                    <tr style="border:none">
	                        <td colspan="3" style="text-align:center">
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
	    <header class="clearfix">
	      <div>
	        <table style="border:none">
	          <tr>
	            <td style="width:25%;text-align:center;margin-bottom:0px;font-size:12px;">
	                  <div>
	                    <img src="../img/logo_ugocp_pdf.png" >
	                  </div>
	            </td>
	            <td style="text-align:center;font-size:12px;">
	                 	<div>
			                <h2>
			                    UNIÓN GENERAL OBRERO, CAMPESINA Y POPULAR A.C.
			                </h2>             
	                	</div>
	                	<div>
							<h2 style="background-color:#e74c3c;color:#fff;">CEDULA DE AFILIACIÓN</h2>
	                	</div>
	            </td>
	            <td style="width:25%;text-align:center">
	            	<img style="width:145px;height:170px;" src="'.$detalle['foto'].'">
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
	    $mpdf->pagenumPrefix = $formato_fecha.' - Página';
	    $mpdf->pagenumSuffix = ' - ';
	    $mpdf->nbpgPrefix = ' de ';
	    //$mpdf->nbpgSuffix = ' pages';
	    $mpdf->SetFooter('{PAGENO}{nbpg}');
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
			  .degradado{

 
background: rgba(248,80,50,0.82);
background: -moz-linear-gradient(top, rgba(248,80,50,0.82) 0%, rgba(241,111,92,0.82) 0%, rgba(246,41,12,0.82) 0%, rgba(240,47,23,0.82) 10%, rgba(241,53,29,0.82) 20%, rgba(241,55,31,0.81) 23%, rgba(248,159,148,0.76) 50%, rgba(252,217,213,0.76) 65%, rgba(255,255,255,0.76) 78%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(248,80,50,0.82)), color-stop(0%, rgba(241,111,92,0.82)), color-stop(0%, rgba(246,41,12,0.82)), color-stop(10%, rgba(240,47,23,0.82)), color-stop(20%, rgba(241,53,29,0.82)), color-stop(23%, rgba(241,55,31,0.81)), color-stop(50%, rgba(248,159,148,0.76)), color-stop(65%, rgba(252,217,213,0.76)), color-stop(78%, rgba(255,255,255,0.76)));
background: -webkit-linear-gradient(top, rgba(248,80,50,0.82) 0%, rgba(241,111,92,0.82) 0%, rgba(246,41,12,0.82) 0%, rgba(240,47,23,0.82) 10%, rgba(241,53,29,0.82) 20%, rgba(241,55,31,0.81) 23%, rgba(248,159,148,0.76) 50%, rgba(252,217,213,0.76) 65%, rgba(255,255,255,0.76) 78%);
background: -o-linear-gradient(top, rgba(248,80,50,0.82) 0%, rgba(241,111,92,0.82) 0%, rgba(246,41,12,0.82) 0%, rgba(240,47,23,0.82) 10%, rgba(241,53,29,0.82) 20%, rgba(241,55,31,0.81) 23%, rgba(248,159,148,0.76) 50%, rgba(252,217,213,0.76) 65%, rgba(255,255,255,0.76) 78%);
background: -ms-linear-gradient(top, rgba(248,80,50,0.82) 0%, rgba(241,111,92,0.82) 0%, rgba(246,41,12,0.82) 0%, rgba(240,47,23,0.82) 10%, rgba(241,53,29,0.82) 20%, rgba(241,55,31,0.81) 23%, rgba(248,159,148,0.76) 50%, rgba(252,217,213,0.76) 65%, rgba(255,255,255,0.76) 78%);
background: linear-gradient(to bottom, rgba(248,80,50,0.82) 0%, rgba(241,111,92,0.82) 0%, rgba(246,41,12,0.82) 0%, rgba(240,47,23,0.82) 10%, rgba(241,53,29,0.82) 20%, rgba(241,55,31,0.81) 23%, rgba(248,159,148,0.76) 50%, rgba(252,217,213,0.76) 65%, rgba(255,255,255,0.76) 78%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f85032", endColorstr="#ffffff", GradientType=0 );
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
											<img style="" src="../img/firma_ugocp_2.jpg"></img>
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
											<img style="" src="../img/firma_ugocp_2.jpg"></img>
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
                              <td style="text-align:center;padding:10px;background-color:#bdc3c7;color:#2c3e50;" colspan="3"><b>FORMATO DE AFILIACIÓN - FOLIO: <span style="color:#e74c3c">'.$num_folio.'</span></b></td>
                          </tr>
                          <tr>
                              <td style="text-align:left;padding:10px;background-color:#e74c3c;color:#ffffff;" colspan="3">A).- DATOS GENERALES</td>
                          </tr>
                          <tr>
                              <td >
                                  <b>'.$detalle['ap_paterno'].'</b>
                                  <p>APELLIDO PARTENO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['ap_materno'].'</b>
                                  <p>APELLIDO MATERNO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['nombre'].'</b>
                                  <p>NOMBRE</p>
                              </td>
                          <tr>
                          <tr>
                              <td >
                                  <b>'.$detalle['calle'].'</b>
                                  <p>CALLE</p>
                              </td>
                              <td >
                                  <b>'.$detalle['numero'].'</b>
                                  <p>NÚMERO</p>
                              </td>     
                              <td >
                                  <b>'.$detalle['colonia'].'</b>
                                  <p>COLONIA</p>
                              </td>
                          </tr>

                          <tr>

                              <td >
                                  <b>'.$detalle['cp'].'</b>
                                  <p>CÓDIGO POSTAL</p>
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['ciudad'].'</b>
                                  <p>CIUDAD, POBLACIÓN O LOCALIDAD</p>
                              </td>     
                          </tr>
                          <tr>
                              <td colspan="2" >
                                  <b>'.$detalle['municipio'].'</b>
                                  <p>MUNICIPIO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['estado'].'</b>
                                  <p>ESTADO</p>
                              </td>
                                    
                          </tr>

                          <tr>
                              <td>
                                  <b>'.$detalle['correo'].'</b>
                                  <p>CORREO ELECTRONICO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['telefono'].'</b>
                                  <p>TELÉFONO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['celular'].'</b>
                                  <p>CELULAR</p>
                              </td>
          
                          </tr>

                          <tr>
                              <td >
                                  <b>'.$detalle['fecha_nacimiento'].'</b>
                                  <p>FECHA DE NACIMIENTO</p>
                              </td>
                              <td >
                                  <b>'.$detalle['edad'].'</b>
                                  <p>EDAD</p>
                              </td>
                              <td >
                                  <b>'.$sexo.'</b>
                                  <p>SEXO</p>
                              </td>     
                          </tr>

                          <tr>
                              <td >
                                  <b>'.$detalle['estado_civil'].'</b>
                                  <p>ESTADO CIVIL</p>
                              </td>
                              <td >
                                  <b>'.$detalle['grupo_indigena'].'</b>
                                  <p>GRUPO INDIGENA</p>
                              </td>
                              <td >
                                  <b>'.$detalle['nombre_comunidad'].'</b>
                                  <p>NOMBRE DEL GRUPO</p>
                              </td>     
                          </tr>

                          <tr>
                              <td style="text-align:left;padding:10px;background-color:#e74c3c;color:#ffffff;" colspan="3">B).- INFORMACIÓN PROFESIONAL O LABORAL</td>
                          </tr>

                          <tr>
                              <td >
                                  OCUPACIÓN:
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['ocupacion'].'</b>
                              </td>     
                          </tr>
                          <tr>
                              <td >
                                  CARGO O PUESTO QUE DESEMPEÑA:
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['cargo'].'</b>
                              </td>     
                          </tr>
                          <tr>
                              <td >
                                  NOMBRE DE LA EMPRESA:
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['empresa'].'</b>
                              </td>     
                          </tr>
                          <tr>
                              <td >
                                  TEL. OFICINA:
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['tel_oficina'].'</b>
                              </td>     
                          </tr>

                          <tr>
                              <td style="text-align:left;padding:10px;background-color:#e74c3c;color:#ffffff;" colspan="3">C).- INFORMACIÓN COMPLEMENTARIA</td>
                          </tr>

                          <tr>
                              <td >
                                  CLAVE ÚNICA DE REGISTRO POBLACIONAL (CURP):
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['curp'].'</b>
                              </td>     
                          </tr>
                          <tr>
                              <td >
                                  CLAVE DE ELECTOR:
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['clave_elector'].'</b>
                              </td>     
                          </tr>
                          <tr>
                              <td >
                                  No. DE CREDENCIAL DEL INE (PARTE POSTERIOR):
                              </td>
                              <td colspan="2" >
                                  <b>'.$detalle['num_ine'].'</b>
                              </td>     
                          </tr>


                          <tr>
                              <td style="text-align:left;padding:10px;background-color:#e74c3c;color:#ffffff;" colspan="3">D).- DECLARACIÓN</td>
                          </tr>

                          <tr>
                              <td colspan="3" style="text-align:justify;font-size:10px">
                    POR MEDIO DE LA PRESENTE SOLICITO LIBRE, CONSCIENTE Y VOLUNTARIAMENTE MI AFILIACIÓN A LA UNIÓN GENERAL, OBRERO, CAMPESINA Y POPULAR A.C. -UGOCP-. ME OBLIGO A RESPETAR EL ESTATUTO. EL PROGRAMA, LOS PRINCIPIOS Y LAS NORMAS CONSTITUTIVAS QUE LA RIGEN, ASÍ COMO A OBSERVAR LOS ACUERDOS EMANADOS DE SUS CONGRESOS, PLENOS DE REPRESENTANTES Y ASAMBLEAS GENERALES. IGUALMENTE A CONTRIBUIR AL FORTALECIMIENTO DE SU ESTRUCTURA Y A VELAR POR LA UNIDAD, PROSPERIDAD E INTEGRIDAD DE ESTA ORGANIZACIÓN.            
                              </td>     
                          </tr>
                          <tr style="border:none">
                              <td colspan="3" style="text-align:center">
                    <hr style="width:40%;margin-top:30px;">
                    FIRMA         
                              </td>     
                          </tr>
                  </table>

        ';


          $mpdf = new mPDF('c','A4','','','15','15','10','10');
          ob_start();
          $mpdf->setAutoTopMargin = 'pad';
          $mpdf->keep_table_proportions = TRUE;
          $mpdf->pagenumPrefix = $formato_fecha.' - Página';
          $mpdf->pagenumSuffix = ' - ';
          $mpdf->nbpgPrefix = ' de ';
          //$mpdf->nbpgSuffix = ' pages';
          $mpdf->SetFooter('{PAGENO}{nbpg}');

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
											<img style="" src="../img/firma_ugocp_2.jpg"></img>
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
	    $mpdf->writeHTML($html);
	    //$mpdf->WriteHTML($style);
		$mpdf->Output();
		exit();


	}