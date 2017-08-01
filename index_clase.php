<?php
$prueva=1;
include "curp.php";
$Curp=new B_CURP();//creamos el objeto de la curp
if($prueva==1)// prueva1 
  $Curp->SetCURP("HEAP60909HMSRVD03");//introduce una curp a buscar
else// prueva2 
   $Curp->SetDatos("Pedro", "Hernandez", "Aviles" , "h", 9, 9, 1966, 16);//se meten datos para que calcule una posible curp
echo $Curp->CURP."<br />\r\n";//se obtiene una curp no verificada al leer los datos obtiene la curp ya validad y registrada
ob_start();
if($Curp->LeerDatos())//lee cual es la curp si hay algun problema envia error
	print_r($Curp);//muestra el objeto completo
else{
	print_r($Curp->errores);//muestra solo los errores
	print_r($Curp->GetNumberErrors);//muestra los numeros de los errores
}
$buf=ob_get_clean();
ob_end_clean();
echo str_replace("    ","&nbsp;&nbsp;&nbsp;",str_replace("\n","<br />\n",$buf));
?>