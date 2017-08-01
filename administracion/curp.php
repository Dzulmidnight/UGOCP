<?php
/************************************************************************
 *  			Curp.php - Por sarjo
 *
 * Este archivo fue generado el dom dic 19 2010 a las 13:45:59
 * La localización original es /home/sarjo/Documentos/Curp.php
 * 
 * @category   Utilerias
 * @package    Curp
 * @author     Armando Ceballos Vargas <sarjo6@gmail.com>
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Liberado: dom dic 19 2010 13:45:59
 * @link       http://sarjoae.blogspot.com
 * @see        http://consultas.curp.gob.mx
 */

/**
 * Esta clase Permite calcular o consultar el Curp tener en cuenta que el calculo
 * puede no ser exacto, esto dependera de muchos factores pero el principal es la habilidad
 * de la clase para encontrar el nombre de pila, si lo encuentra correctamente el indice de 
 * estar correcto aumenta
 * 
 * class Curp
 * 
 */
class Curp {

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

  /**
   * 
   * @access private
   */
  private $apellidop;

  /**
   * 
   * @access private
   */
  private $apellidom;

  /**
   * 
   * @access private
   */
  private $nombre;

  /**
   * 
   * @access private
   */
  private $entidad;

  /**
   * 
   * @access private
   */
  private $sexo;

  /**
   * 
   * @access private
   */
  private $fechadia;

  /**
   * 
   * @access private
   */
  private $fechames;

  /**
   * 
   * @access private
   */
  private $fechaanio;

  /**
   * 
   * @access private
   */
  private $CURP;


  /**
   * 
   *
   * @param string apellidop 

   * @param string apellidom 

   * @param string nombre 

   * @param string fechadia 

   * @param string fechames 

   * @param string fechaanio 

   * @param char sexo 

   * @param string entidad 

   * @return 
   * @access public
   */
  public function __construct( $apellidop,  $apellidom,  $nombre,  $fechadia,  $fechames,  $fechaanio,  $sexo,  $entidad ) {
  	$this->setApellidop($apellidop);
	$this->setApellidom($apellidom);
	$this->setNombre($nombre);
	$this->setFechadia($fechadia);
	$this->setFechames($fechames);
	$this->setFechaanio($fechaanio);
	$this->setSexo($sexo);
	$this->setEntidad($entidad);
  } // end of member function __construct

  /**
   * 
   *
   * @return 
   * @access public
   */
  public function calcularCURP( ) {
  	if ($this->validarVacio()) {
    	$this->CURP='';
        //inicial del primer apellido
        $this->apellidop=  $this->depurar($this->apellidop);
        $this->CURP[0]=$this->apellidop[0];
        //primera vocal del primer apellido
        $this->CURP[1]=$this->primeraVocalInterna($this->apellidop);
        //inical del segundo apellido
        $this->apellidom=  $this->depurar($this->apellidom);
        $this->CURP[2]=$this->apellidom[0];
        //inicial del nombre de pila
        //@TODO creo que el nombre de pila es el ultimo nombre que tengas
        $nombrePila=  $this->depurar($this->nombre);
        $this->CURP[3]=$nombrePila[0];
        //los siguientes 6 caracteres son la fecha anio,mes,dia
        //@TODO quizas deberia de usar timestamp para pasar toda la fecha junta
        $this->CURP[4]=$this->fechaanio[2];
        $this->CURP[5]=$this->fechaanio[3];
        $this->CURP[6]=$this->fechames[0];
        $this->CURP[7]=$this->fechames[1];
        $this->CURP[8]=$this->fechadia[0];
        $this->CURP[9]=$this->fechadia[1];
        //si es hombre es H si es mujer M
        $this->CURP[10]=$this->sexo;
        //la entidad federativa son dos caracteres dadas por entidad donde nacio
        $this->CURP[11]=$this->entidad[0];
        $this->CURP[12]=$this->entidad[1];
        //la primera consonate de primer apellido,segundo apellido, nombre de pila
        $this->CURP[13]=$this->primeraConsonanteInterna($this->apellidop);
        $this->CURP[14]=$this->primeraConsonanteInterna($this->apellidom);
        $this->CURP[15]=$this->primeraConsonanteInterna($nombrePila);
        $this->CURP[16]='0';
        $this->CURP[17]=$this->calcularDigitoVerificador();
	}else{
    	echo 'colocar todos los datos';
    }
  } // end of member function calcularCURP

  /**
   * 
   *
   * @return string
   * @access public
   */
  public function getCURP( ) {
  	$this->calcularCURP();
    return implode('', $this->CURP);
  } // end of member function getCURP

  /**
   * funcion basada en el codigo de Victor Arturo Hernandez Avila
   *
   * @return string
   * @access public
   */
  public function getCurpFromWeb( ) {
  	$aContext = array( 
		'http' => array( 
	    'header'=>"Accept-language: es-es,es;q=0.8,en-us;q=0.5,en;q=0.3\r\n" . 
	    	"Proxy-Connection: keep-alive\r\n" . 
	        "Host: consultas.curp.gob.mx\r\n" . 
	        "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; es-ES; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 (.NET CLR 3.5.30729)\r\n" . 
	        "Keep-Alive: 300\r\n" . 
	        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n" 
	        //, 'proxy' => 'tcp://proxy:puerto', //Si utilizas algun proxy para salir a internet descomenta esta linea y por la direccion de tu proxy y el puerto 
	        //'request_fulluri' => True //Tambien esta si utilizas algun proxy 
	        ), 
	    ); 
	$cxContext = stream_context_create($aContext);
	$url = "http://consultas.curp.gob.mx/CurpSP/curp1.do?strPrimerApellido=".rawurlencode($this->apellidop)."&strSegundoAplido=".rawurlencode($this->apellidom)."&strNombre=".rawurlencode($this->nombre)."&strdia=$this->fechadia&strmes=$this->fechames&stranio=$this->fechaanio&sSexoA=$this->sexo&sEntidadA=$this->entidad&rdbBD=myoracle&strTipo=A&entfija=DF&depfija=04";
	if ($this->validarVacio()) { 
	    $file = file_get_contents($url, false, $cxContext); 
		preg_match_all("/var strCurp=\"(.*)\"/", $file, $curp); 
		$curp = $curp[1][0]; 
		if($curp){ 
			return $curp; 
		}else{ 
			$curp = "Curp no encontrado."; 
		    return $curp; 
		}
	}else{
    	echo 'colocar todos los datos';
    }
  } // end of member function getCurpFromWeb

  /**
   * 
   *
   * @param string apellidom 

   * @return 
   * @access public
   */
  public function setApellidom( $apellidom ) {
  	$this->apellidom = $this->convertirMayusculas($apellidom);
  } // end of member function setApellidom

  /**
   * 
   *
   * @param string apellidop 

   * @return 
   * @access public
   */
  public function setApellidop( $apellidop ) {
  	$this->apellidop = $this->convertirMayusculas($apellidop);
  } // end of member function setApellidop

  /**
   * 
   *
   * @param string entidad 

   * @return 
   * @access public
   */
  public function setEntidad( $entidad ) {
  	$this->entidad = $this->convertirMayusculas($entidad);
  } // end of member function setEntidad

  /**
   * 
   *
   * @param string fechaanio 

   * @return 
   * @access public
   */
  public function setFechaanio( $fechaanio ) {
	$this->fechaanio = $fechaanio;
  } // end of member function setFechaanio

  /**
   * 
   *
   * @param string fechadia 

   * @return 
   * @access public
   */
  public function setFechadia( $fechadia ) {
  	$this->fechadia = $fechadia;
  } // end of member function setFechadia

  /**
   * 
   *
   * @param string fechames 

   * @return 
   * @access public
   */
  public function setFechames( $fechames ) {
  	$this->fechames = $fechames;
  } // end of member function setFechames

  /**
   * 
   *
   * @param string nombre 

   * @return 
   * @access public
   */
  public function setNombre( $nombre ) {
  	$this->nombre = $this->convertirMayusculas($nombre);
  } // end of member function setNombre

  /**
   * 
   *
   * @param char sexo 

   * @return 
   * @access public
   */
  public function setSexo( $sexo ) {
  	$this->sexo = $this->convertirMayusculas($sexo);
  } // end of member function setSexo

  /**
   * 
   *
   * @param string cadena 

   * @return char
   * @access private
   */
  private function primeraVocalInterna( $cadena ) {
  	for ($index = 1; $index < strlen($cadena); $index++) {
    	if ($this->esVocal($cadena[$index])) { return $cadena[$index]; }
  	}
  } // end of member function primeraVocalInterna

  

  /**
   * 
   *
   * @return 
   * @access private
   */
  private function banObsenas( ) {
  	$obsenas=array('CACA', 'BUEI','CAGA','CAKA','COGE','COJE','COJO','FETO',
    	'JOTO','KACO','KAGO','CAGO','KOJO','KULO','CULO','LOCO','LOKO','MAMO',
        'MEAS','MION','MULA','BUEY','CACO','KOGE','LOCA','LOKA','MAME','MEAR',
        'MEON','MOCO','PEDA','PEDO','PUTA','PUTO','QULO','RUIN','PENE','RATA');
	$palabra=$this->CURP[0].$this->CURP[1].$this->CURP[2].$this->CURP[3];
    foreach ($obsenas as $value) {
    	if ($palabra==$value) {
        	$this->CURP[3]='X';
        }
    }
  } // end of member function banObsenas

  /**
   * 
   *
   * @return int
   * @access private
   */
  private function calcularDigitoVerificador( ) {
	$digito=array(
    	'0'=>0,
        '1'=>1,
        '2'=>2,
        '3'=>3,
        '4'=>4,
        '5'=>5,
        '6'=>6,
        '7'=>7,
        '8'=>8,
        '9'=>9,
        'A'=>10,
        'B'=>11,
        'C'=>12,
        'D'=>13,
        'E'=>14,
        'F'=>15,
        'G'=>16,
        'H'=>17,
        'I'=>18,
        'J'=>19,
        'K'=>20,
        'L'=>21,
        'M'=>22,
        'N'=>23,
        'Ñ'=>24,
        'O'=>25,
        'P'=>26,
        'Q'=>27,
        'R'=>28,
        'S'=>29,
        'T'=>30,
        'U'=>31,
        'V'=>32,
        'W'=>33,
        'X'=>34,
        'Y'=>35,
        'Z'=>36,
    	' '=>37,
	);
    $acumulador=0;
    for ($i = 18; $i >= 2; $i--) {
    	$acumulador+=($digito[$this->CURP[abs($i-18)]]*$i);
    }
    $digitovalidador=(10-($acumulador % 10));
    return ($digitovalidador==10) ? '0' : "$digitovalidador" ;
  } // end of member function calcularDigitoVerificador

  /**
   * STRTOUPPER no pasa palabras acentuadas ni la Ñ. Las palabras acentuadas se
   * desacentuan debido a que no son validas con acento por eso lo hago incluso en el
   * caso de que ya sean mayusculas.
   *
   * @param string cadena 

   * @return string
   * @access private
   */
  private function convertirMayusculas( $cadena ) {
  	$cadena = strtr(strtoupper($cadena),"àèìòùáéíóúçñäëïöü","AEIOUAEIOUÇÑAEIOU");
    $cadena = strtr(strtoupper($cadena),"ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ","AEIOUAEIOUÇÑAEIOU");
    return $cadena;
  } // end of member function convertirMayusculas

  /**
   * en teoria debe limpiar entradas esto incluso debe dar el nombre de pila.
   *
   * @param string cadena 

   * @return string
   * @access private
   */
  private function depurar( $cadena ) {
  	$novalido=array('DEL','LAS','DE','LA','Y','A','LOS','JOSE','MARIA');
    $valores=$nombre=explode(' ', $cadena);
    $valido=true;
    foreach ($valores as $valor1) {
    	foreach ($novalido as $valor2) {
        	if ($valor1==$valor2){
            	$valido=($valido && false);
            }else{
                $valido=$valido && true;
            }
        }
        if ($valido){
        	return $valor1;
        }else{
        	$valido = true;
        }
	}
  } // end of member function depurar

  /**
   * 
   *
   * @param char char 

   * @return bool
   * @access private
   */
  private function esVocal( $char ) {
  	$char=  $this->convertirMayusculas($char);
    return ($char=='A' || $char=='E' || $char=='I' || $char=='O' || $char=='U') ? true : false;
  } // end of member function esVocal

  /**
   * 
   *
   * @param string cadena 

   * @return char
   * @access private
   */
  private function primeraConsonanteInterna( $cadena ) {
  	for ($index = 1; $index < strlen($cadena); $index++) {
  		if (!$this->esVocal($cadena[$index])){ return $cadena[$index]; }
  	}
  } // end of member function primeraConsonanteInterna

  /**
   * 
   *
   * @return bool
   * @access private
   */
  private function validarVacio( ) {
  	return ($this->apellidop!='' && $this->apellidom!='' && $this->nombre!='' && $this->entidad!='' && $this->sexo!='' && $this->fechadia!='' && $this->fechames!='' && $this->fechaanio!='') ? true : false;
  } // end of member function validarVacio
} // end of Curp

echo getCURP();

?>
