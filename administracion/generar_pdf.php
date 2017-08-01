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
		$num_folio = str_pad($detalle['folio'], 4, '0', STR_PAD_LEFT);
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
	                        <td style="text-align:left;padding:15px;background-color:#e74c3c;color:#ffffff;" colspan="3">A).- DATOS GENERALES</td>
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
	                            <p>NOMBRE DEL GRUPO, EJIDO O COMUNIDAD</p>
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
							<h2 style="background-color:red;color:#fff;">CEDULA DE AFILIACIÓN</h2>
	                	</div>
	            </td>
	            <td style="width:25%;text-align:center">
	            	<img style="width:145px;height:170px;" src="'.$detalle['foto'].'">
	            	<h2 style="color:red">'.$num_folio.'</h2>
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
		$num_folio = str_pad($detalle['folio'], 4, '0', STR_PAD_LEFT);
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
			    font-size:12px;
			  }
			  </style>
				<table border="0">
				  <tr>
				    <td width="9.6cm" style="border: 1px dotted black;border-right:none" height="6.4cm" >
				      <table border="0" width="">
				        <tbody>
				          <tr style="padding:0px; margin:0px;">
				            <td align="center" width="40px"> 
				                <img src="../img/logo_ugocp_pdf.png" style="width:60px; height:60px; padding:0px; margin:0px;"/>
				            </td>
				            <td style="color: #FE0000">
				                <p>UNION GENERAL OBRERO,</p><p>CAMPESINA Y POPULAR,A.C.</p>
				                <hr style="border-top: 1px solid #FF2301; color:#FE0000; margin:5px; padding:10px;">
				                <p><small>Comite Ejecutivo Estatal Sonora</small></p>
				            </td>

				            <td colspan="4" rowspan="4" style="text-align:center;color:red">
				                <img src="'.$detalle['foto'].'" style="width:80px; height:120px;"/>
				                <span>'.$num_folio.'</span>
				            </td>
				          </tr>
				          <tr>
				            <td colspan="2" align="left">
				              <h4 style="margin:0px; align:left;">'.$nombre.'</h4>
				              <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				            </td>
				          </tr>
				          <tr>
				            <td colspan="2" align="center">
				              <p><b>Nombre</b></p>
				            </td>
				          </tr>
				          <tr>
				            <td align="right">
				              <p><b>Cargo:</b></p>
				            </td>
				            <td>
				                <p><b>'.$detalle['cargo'].'</b></p>
				            </td>
				          </tr>
				         <tr>
				            <td align="right">
				              <p><b>Dirección:</b></p>
				            </td>
				            <td colspan="4">
				              <p><small>'.$direccion.'</small></p>
				            </td>
				            <td>
				            </td>
				          </tr>
				          <tr>
				            <td colspan="6">
				              <table border="0" width="100%">
				              <tr>
				                <td align="center" border="0" width="32%">
				                  <p><small>'.$detalle['telefono'].'</small></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Teléfono</b></p>
				                </td>
				                <td align="center" border="0" width="32%">
				                  <p><small>'.$detalle['celular'].'</smal></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Celular</b></p>
				                </td>
				                <td align="center" border="0" width="34%">
				                  <p><small>&nbsp;</small></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Firma del Afiliado</b></p>
				                </td>
				              </tr>
				              </table>
				            </td>
				          </tr>
				        </tbody>
				      </table>
				    </td>
				    <td style="width:0.2cm">
				    </td>
				    <td width="9.6cm" height="6.4cm" style="border: 1px dotted black;border-left:none">
				      <table border="0" width="9.6cm">
				        <tbody>
				        <tr height="100px">
				          <td colspan="4" style="padding:40px;">
				              <p style="padding:10px"><b>CURP: </b>'.$detalle['curp'].'</p><br>
				              <p style="padding:10px"><b>RFC: </b>'.$detalle['rfc'].'</p>
				          </td>
				        </tr>
				        <tr width="100%">
				            <td colspan="4" align="center" width="50%" style="padding:0px 40px 0px 50px ;">
				              <p><b>Nombre del Secretario</b></p>
				              <p><b><hr style="color:black; margin:0px;">&nbsp;</b></p>
				              <p><b>Firma:</b></p>
				            </td>
				        </tr>
				          <tr>
				            <td colspan="4" align="center">
				            </td>
				          </tr>
				      </table>
				    </td>    
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
      $num_folio = str_pad($detalle['folio'], 4, '0', STR_PAD_LEFT);
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
              font-size:12px;
            }
            </style>
            <table border="0">
              <tr>
                <td width="9.6cm" style="border: 1px dotted black;border-right:none" height="6.4cm" >
                  <table border="0" width="">
                    <tbody>
                      <tr style="padding:0px; margin:0px;">
                        <td align="center" width="40px"> 
                            <img src="../img/logo_ugocp_pdf.png" style="width:60px; height:60px; padding:0px; margin:0px;"/>
                        </td>
                        <td style="color: #FE0000">
                            <p>UNION GENERAL OBRERO,</p><p>CAMPESINA Y POPULAR,A.C.</p>
                            <hr style="border-top: 1px solid #FF2301; color:#FE0000; margin:5px; padding:10px;">
                            <p><small>Comite Ejecutivo Estatal Sonora</small></p>
                        </td>

                        <td colspan="4" rowspan="4" style="text-align:center;color:red">
                            <img src="'.$detalle['foto'].'" style="width:80px; height:120px;"/>
                            <span>'.$num_folio.'</span>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left">
                          <h4 style="margin:0px; align:left;">'.$nombre.'</h4>
                          <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                          <p><b>Nombre</b></p>
                        </td>
                      </tr>
                      <tr>
                        <td align="right">
                          <p><b>Cargo:</b></p>
                        </td>
                        <td>
                            <p><b>'.$detalle['cargo'].'</b></p>
                        </td>
                      </tr>
                     <tr>
                        <td align="right">
                          <p><b>Dirección:</b></p>
                        </td>
                        <td colspan="4">
                          <p><small>'.$direccion.'</small></p>
                        </td>
                        <td>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6">
                          <table border="0" width="100%">
                          <tr>
                            <td align="center" border="0" width="32%">
                              <p><small>'.$detalle['telefono'].'</small></p>
                              <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
                              <p><b>Teléfono</b></p>
                            </td>
                            <td align="center" border="0" width="32%">
                              <p><small>'.$detalle['celular'].'</smal></p>
                              <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
                              <p><b>Celular</b></p>
                            </td>
                            <td align="center" border="0" width="34%">
                              <p><small>&nbsp;</small></p>
                              <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
                              <p><b>Firma del Afiliado</b></p>
                            </td>
                          </tr>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td style="width:0.2cm">
                </td>
                <td width="9.6cm" height="6.4cm" style="border: 1px dotted black;border-left:none">
                  <table border="0" width="9.6cm">
                    <tbody>
                    <tr height="100px">
                      <td colspan="4" style="padding:40px;">
                          <p style="padding:10px"><b>CURP: </b>'.$detalle['curp'].'</p><br>
                          <p style="padding:10px"><b>RFC: </b>'.$detalle['rfc'].'</p>
                      </td>
                    </tr>
                    <tr width="100%">
                        <td colspan="4" align="center" width="50%" style="padding:0px 40px 0px 50px ;">
                          <p><b>Nombre del Secretario</b></p>
                          <p><b><hr style="color:black; margin:0px;">&nbsp;</b></p>
                          <p><b>Firma:</b></p>
                        </td>
                    </tr>
                      <tr>
                        <td colspan="4" align="center">
                        </td>
                      </tr>
                  </table>
                </td>    
              </tr>

              <!-- INICIA LINEA DE SEPARACIÓN ENTRE CREDENCIALES -->
              <tr>
                <td height="0.5cm">
                </td>
              </tr>
              <!-- TERMINA LINEA DE SEPARACIÓN ENTRE CREDENCIALES -->

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
                                  <p>NOMBRE DEL GRUPO, EJIDO O COMUNIDAD</p>
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


          $mpdf = new mPDF('c', 'A4');
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
			    font-size:12px;
			  }
			  </style>';
		while($detalle = $ejecutar -> fetch_assoc()){
			$num_folio = str_pad($detalle['folio'], 4, '0', STR_PAD_LEFT);
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
				<table border="0" style="margin-top:-5px;">
				  <tr>
				    <td width="9.6cm" style="border: 1px dotted black;border-right:none" height="6.4cm" >
				      <table border="0" width="">
				        <tbody>
				          <tr style="padding:0px; margin:0px;">
				            <td align="center" width="40px"> 
				                <img src="../img/logo_ugocp_pdf.png" style="width:60px; height:60px; padding:0px; margin:0px;"/>
				            </td>
				            <td style="color: #FE0000">
				                <p>UNION GENERAL OBRERO,</p><p>CAMPESINA Y POPULAR,A.C.</p>
				                <hr style="border-top: 1px solid #FF2301; color:#FE0000; margin:5px; padding:10px;">
				                <p><small>Comite Ejecutivo Estatal Sonora</small></p>
				            </td>

				            <td colspan="4" rowspan="4" style="text-align:center;color:red">
				                <img src="'.$detalle['foto'].'" style="width:80px; height:120px;"/>
				                <span>'.$num_folio.'</span>
				            </td>
				          </tr>
				          <tr>
				            <td colspan="2" align="left">
				              <h4 style="margin:0px; align:left;">'.$nombre.'</h4>
				              <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				            </td>
				          </tr>
				          <tr>
				            <td colspan="2" align="center">
				              <p><b>Nombre</b></p>
				            </td>
				          </tr>
				          <tr>
				            <td align="right">
				              <p><b>Cargo:</b></p>
				            </td>
				            <td>
				                <p><b>'.$detalle['cargo'].'</b></p>
				            </td>
				          </tr>
				         <tr>
				            <td align="right">
				              <p><b>Dirección:</b></p>
				            </td>
				            <td colspan="4">
				              <p><small>'.$direccion.'</small></p>
				            </td>
				            <td>
				            </td>
				          </tr>
				          <tr>
				            <td colspan="6">
				              <table border="0" width="100%">
				              <tr>
				                <td align="center" border="0" width="32%">
				                  <p><small>'.$detalle['telefono'].'</small></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Teléfono</b></p>
				                </td>
				                <td align="center" border="0" width="32%">
				                  <p><small>'.$detalle['celular'].'</smal></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Celular</b></p>
				                </td>
				                <td align="center" border="0" width="34%">
				                  <p><small>&nbsp;</small></p>
				                  <hr style="border-top: 1px solid #FF2301; color:black; margin:0px; padding:0px;">
				                  <p><b>Firma del Afiliado</b></p>
				                </td>
				              </tr>
				              </table>
				            </td>
				          </tr>
				        </tbody>
				      </table>
				    </td>
				    <td style="width:0.2cm">
				    </td>
				    <td width="9.6cm" height="6.4cm" style="border: 1px dotted black;border-left:none">
				      <table border="0" width="9.6cm">
				        <tbody>
				        <tr height="100px">
				          <td colspan="4" style="padding:40px;">
				              <p style="padding:10px"><b>CURP: </b>'.$detalle['curp'].'</p><br>
				              <p style="padding:10px"><b>RFC: </b>'.$detalle['rfc'].'</p>
				          </td>
				        </tr>
				        <tr width="100%">
				            <td colspan="4" align="center" width="50%" style="padding:0px 40px 0px 50px ;">
				              <p><b>Nombre del Secretario</b></p>
				              <p><b><hr style="color:black; margin:0px;">&nbsp;</b></p>
				              <p><b>Firma:</b></p>
				            </td>
				        </tr>
				          <tr>
				            <td colspan="4" align="center">
				            </td>
				          </tr>
				      </table>
				    </td>    
				  </tr>



				</table>

	           

		';

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