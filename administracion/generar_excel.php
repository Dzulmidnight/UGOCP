<?php
require('../conexion/conexion.php');
require_once 'PHPExcel/PHPExcel.php';


	$query = "SELECT afiliado.*, datos_generales.*, informacion_laboral.* FROM afiliado INNER JOIN datos_generales ON afiliado.folio = datos_generales.folio INNER JOIN informacion_laboral ON afiliado.folio = informacion_laboral.folio";

//    $query = $_POST['query_excel'];
	$row_afiliado = $mysqli->query($query);
    //$row_afiliado = mysql_query($query,$dspp) or die(mysql_error()); 
    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("spp global") //Autor
               ->setLastModifiedBy("spp global") //Ultimo usuario que lo modificó
               ->setTitle("Base de datos - Afiliados UGOCP")
               ->setSubject("Base de datos - Afiliados UGOCP")
               ->setDescription("Base de datos - Afiliados UGOCP")
               ->setKeywords("Base de datos - Afiliados UGOCP")
               ->setCategory("Afiliados UGOCP");

    $tituloReporte = "Base de datos - Afiliados UGOCP";
    //$subtitulos = "Otros";
    $titulosColumnas = array('FOLIO', 'CURP', 'RFC', 'CLAVE ELECTOR', 'Nº DE CREDENCIAL', 'APELLIDO PATERNO', 'APELLIDO MATERNO', 'NOMBRE(S)', 'FECHA DE NACIMIENTO', 'SEXO', 'EDAD', 'ESTADO CIVIL', 'PERTENECE A GRUPO INDIGENA', 'GRUPO INDIGENA', 'CP', 'Nº ESTADO', 'ESTADO', 'CIUDAD o POBLACIÓN', 'Nº MUNICIPIO', 'MUNICIPIO', 'COLONIA', 'CALLE', 'NUMERO', 'CORREO ELECTRONICO', 'TELEFONO', 'CELULAR', 'OCUPACIÓN', 'CARGO o PUESTO', 'EMPRESA', 'TEL OFICINA');

    $subColumnas = array('INFORMACIÓN COMPLEMENTARIA', 'DATOS GENERALES', 'INFORMACIÓN DOMICILIARIA', 'INFORMACION DE CONTACTO', 'INFORMACIÓN PROFESIONAL O LABORAL');
    
    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:AD1');
    $objPHPExcel->setActiveSheetIndex(0)
    	        ->mergeCells('A2:E2');
   	$objPHPExcel->setActiveSheetIndex(0)
    	        ->mergeCells('F2:N2');
   	$objPHPExcel->setActiveSheetIndex(0)
    	        ->mergeCells('O2:W2');
    $objPHPExcel->setActiveSheetIndex(0)
    	        ->mergeCells('X2:Z2');
    $objPHPExcel->setActiveSheetIndex(0)
    	        ->mergeCells('AA2:AD2');
            
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1',$tituloReporte)
          //se agregan los subtitulos de las columnas
          ->setCellValue('A2',  $subColumnas[0])
          ->setCellValue('F2',  $subColumnas[1])
          ->setCellValue('O2',  $subColumnas[2])
          ->setCellValue('X2',  $subColumnas[3])
          ->setCellValue('AA2',  $subColumnas[4])
         // ->setCellValue('A2',$subtitulos)
                ->setCellValue('A3',  $titulosColumnas[0])
                ->setCellValue('B3',  $titulosColumnas[1])
                ->setCellValue('C3',  $titulosColumnas[2])
                ->setCellValue('D3',  $titulosColumnas[3])
                ->setCellValue('E3',  $titulosColumnas[4])
                ->setCellValue('F3',  $titulosColumnas[5])
                ->setCellValue('G3',  $titulosColumnas[6])
                ->setCellValue('H3',  $titulosColumnas[7])
                ->setCellValue('I3',  $titulosColumnas[8])
                ->setCellValue('J3',  $titulosColumnas[9])
                ->setCellValue('K3',  $titulosColumnas[10])
                ->setCellValue('L3',  $titulosColumnas[11])
                ->setCellValue('M3',  $titulosColumnas[12])
                ->setCellValue('N3',  $titulosColumnas[13])
                ->setCellValue('O3',  $titulosColumnas[14])
                ->setCellValue('P3',  $titulosColumnas[15])
                ->setCellValue('Q3',  $titulosColumnas[16])
                ->setCellValue('R3',  $titulosColumnas[17])
                ->setCellValue('S3',  $titulosColumnas[18])
                ->setCellValue('T3',  $titulosColumnas[19])
                ->setCellValue('U3',  $titulosColumnas[20])
                ->setCellValue('V3',  $titulosColumnas[21])
                ->setCellValue('W3',  $titulosColumnas[22])
                ->setCellValue('X3',  $titulosColumnas[23])
                ->setCellValue('Y3',  $titulosColumnas[24])
                ->setCellValue('Z3',  $titulosColumnas[25])
                ->setCellValue('AA3',  $titulosColumnas[26])
                ->setCellValue('AB3',  $titulosColumnas[27])
                ->setCellValue('AC3',  $titulosColumnas[28])
                ->setCellValue('AD3',  $titulosColumnas[29]);
    
    //Se agregan los datos de los alumnos
    $i = 4;
    $contador = 1;
    while ($afiliado = $row_afiliado->fetch_assoc()) {
        if($afiliado['sexo'] == 'H'){
            $sexo = 'Hombre';
        }else{
            $sexo = 'Mujer';
        }
        $folio = str_pad($afiliado['folio'], 6, '0', STR_PAD_LEFT);

      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i,  $folio)
                ->setCellValue('B'.$i,  $afiliado['curp'])
                ->setCellValue('C'.$i,  $afiliado['rfc'])
                ->setCellValue('D'.$i,  $afiliado['clave_elector'])
                ->setCellValue('E'.$i,  $afiliado['num_ine'])
                ->setCellValue('F'.$i,  $afiliado['ap_paterno'])
                ->setCellValue('G'.$i,  $afiliado['ap_materno'])
                ->setCellValue('H'.$i,  $afiliado['nombre'])
                ->setCellValue('I'.$i,  $afiliado['fecha_nacimiento'])
                ->setCellValue('J'.$i,  $sexo)
                ->setCellValue('K'.$i,  $afiliado['edad'])
                ->setCellValue('L'.$i,  $afiliado['estado_civil'])
                ->setCellValue('M'.$i,  $afiliado['grupo_indigena'])
                ->setCellValue('N'.$i,  $afiliado['nombre_comunidad'])
                ->setCellValue('O'.$i,  $afiliado['cp'])
                ->setCellValue('P'.$i,  $afiliado['num_estado'])
                ->setCellValue('Q'.$i,  $afiliado['estado'])
                ->setCellValue('R'.$i,  $afiliado['ciudad'])
                ->setCellValue('S'.$i,  $afiliado['num_municipio'])
                ->setCellValue('T'.$i,  $afiliado['municipio'])
                ->setCellValue('U'.$i,  $afiliado['colonia'])
                ->setCellValue('V'.$i,  $afiliado['calle'])
                ->setCellValue('W'.$i,  $afiliado['numero'])
                ->setCellValue('X'.$i,  $afiliado['correo'])
                ->setCellValue('Y'.$i,  $afiliado['telefono'])
                ->setCellValue('Z'.$i,  $afiliado['celular'])
                ->setCellValue('AA'.$i,  $afiliado['ocupacion'])
                ->setCellValue('AB'.$i,  $afiliado['cargo'])
                ->setCellValue('AC'.$i,  $afiliado['empresa'])
                ->setCellValue('AD'.$i,  $afiliado['tel_oficina']);

          $i++;
          $contador++;
    }
    $estiloTituloReporte = array(
          'font' => array(
            'name'      => 'Verdana',
              'bold'      => true,
              'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => '000000'
                  )
            ),
          'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFFFFF')
      ),
            'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_THICK                    
                )
            ), 
            'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'rotation'   => 0,
              'wrap'          => TRUE
        )
    );

    $estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'ffffff'
                )
            ),
            /*'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFd9b7f4')
      ),*/

            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('rgb' => 'e74c3c')
      ),
            'borders' => array(
              'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
      'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'wrap'          => TRUE
    ));


    $estiloCelda1 = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'ffffff'
                )
            ),
            /*'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFd9b7f4')
      ),*/

            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('rgb' => '34495e') //color de fondo
      ),
            'borders' => array(
              'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '4000ff'
                    )
                )
            ),
      'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'wrap'          => TRUE
    ));

    $estiloCelda2 = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => '34495e' //color de texto
                )
            ),
            /*'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFd9b7f4')
      ),*/

            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('rgb' => 'bdc3c7') //color de fondo 5F9EA0
      ),
            'borders' => array(
              'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '4000ff'
                    )
                )
            ),
      'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'wrap'          => TRUE
    ));






    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray(
      array(
              'font' => array(
                'name'      => 'Arial',               
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            /*'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFd9b7f4')
      ),*/
            'borders' => array(
                'left'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                  'color' => array(
                    'rgb' => '3a2a47'
                    )
                )             
            )
        ));

    $objPHPExcel->getActiveSheet()->getStyle('A1:AD1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:AD3')->applyFromArray($estiloTituloColumnas);   
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:AD".($i-1));

    $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($estiloCelda1);
    $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($estiloCelda2);
    $objPHPExcel->getActiveSheet()->getStyle('O2')->applyFromArray($estiloCelda1);
    $objPHPExcel->getActiveSheet()->getStyle('X2')->applyFromArray($estiloCelda2);
    $objPHPExcel->getActiveSheet()->getStyle('AA2')->applyFromArray($estiloCelda1);
//$objPHPExcel->getActiveSheet()->getStyle('A3:AB3')->getAlignment()->setWrapText(false); 
    //$objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getAlignment()->setWrapText(true);
   
    for($i = 'A'; $i <= 'AD'; $i++){
      $objPHPExcel->setActiveSheetIndex(0)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()
    ->setWidth(20);
     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);

    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Base de datos - Afiliados UGOCP');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles 
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Afiliados_UGOCP.xls"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
  
?>