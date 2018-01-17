
    function consultar_check(){
        var seleccionados = ''
        $('.micheckbox:checked').each(
            function() {
                seleccionados += $(this).val() + ",";
                //alert("El checkbox con valor " + $(this).val() + " está seleccionado");
            }

        );
        if(seleccionados.length == 0){
          alert('Debes seleccionar el folio del afiliado');
        }else{
          function abrirEnPestana(url) {
              var a = document.createElement("a");
              a.target = "_new";
              a.href = url;
              a.click();
          }
          var url="generar_pdf.php?lista="+seleccionados;
          abrirEnPestana(url);
        }
        //return alert("EL ARRAY ES: "+seleccionados);
    }

    function mostrar_colonia(){
      document.getElementById('colonia_diferente').style.display = 'block';
    }
    /// GENERAR LOS DIGITOS DE LA CURP
    /*24_07_2017 function generarCURP(){
      abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      random09a = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
      random09b = Math.floor(Math.random() * (9 - 1 + 1)) + 1;
      randomAZ = Math.floor(Math.random() * (26 - 0 + 1)) + 0;

      //var date= document.getElementById('fecha_nacimiento').value;

      /*var d = new Date(date.split("-").reverse().join("-"));
      var dd=d.getDate();
      var mm=d.getMonth()+1;
      var yy=d.getFullYear();
      var newdate = yy+"/"+mm+"/"+dd;*/

      /*24_07_2017 ano = Number($("#fecha_nacimiento").val().slice(6, 10));

      var CURP = [];
      CURP[0] = $("#ap_paterno").val().charAt(0).toUpperCase();
      CURP[1] = $("#ap_paterno").val().slice(1).replace(/\a\e\i\o\u/gi, "").charAt(0).toUpperCase();
      CURP[2] = $("#ap_materno").val().charAt(0).toUpperCase();
      CURP[3] = $("#nombre").val().charAt(0).toUpperCase();
      CURP[4] = ano.toString().slice(2);
      CURP[5] = $("#fecha_nacimiento").val().slice(3, 5);
      CURP[6] = $("#fecha_nacimiento").val().slice(0, 2);
      CURP[7] = $("#sexo").val().toUpperCase();
      CURP[8] = abreviacion[estados.indexOf($("#estado").val().toLowerCase())];
      CURP[9] = $("#ap_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
      CURP[10] = $("#ap_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
      CURP[11] = $("#nombre").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();;
      CURP[12] = ano < 2000 ? random09a : abc[randomAZ];
      CURP[13] = random09b;
      return CURP.join("");
    }

    var estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
    var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

    /*$("#grupo_indigena").keyup(function(){
      //alert(generarCURP());
      //$("#curp").text('ASDF');
      alert(generarCURP());
    });*/

    /*$(document).ready(function() {
      $("#sexo").change(function() {
        document.getElementById("curp_otra").value = 'asdfasd';
        //alert(generarCURP());
      });
    });*/


  function otra_consulta(){

        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        anio = document.getElementById("anio").value;
        nombre1 = document.getElementById('nombre').value;
        ap_paterno1 = document.getElementById('ap_paterno').value;
        ap_materno1 = document.getElementById('ap_materno').value;
        sexo1 = document.getElementById('select_sexo').value;


        var estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

        prueba_estado = abreviacion[estados.indexOf($("#estado").val().toLowerCase())];

        var curp = generaCurp({
          nombre            : nombre1,
          apellido_paterno  : ap_paterno1,
          apellido_materno  : ap_materno1,
          sexo              : sexo1,
          estado            : prueba_estado,
          fecha_nacimiento  : [dia, mes, anio]
        });
        
        document.getElementById("curp_otra").value = curp;

        calculaRFC();
  }
  function otra_consulta2(){

        dia2 = document.getElementById("dia2").value;
        mes2 = document.getElementById("mes2").value;
        anio2 = document.getElementById("anio2").value;
        nombre2 = document.getElementById('nombre2').value;
        ap_paterno2 = document.getElementById('ap_paterno2').value;
        ap_materno2 = document.getElementById('ap_materno2').value;
        sexo2 = document.getElementById('sexo2').value;


        var estados2 = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
        var abreviacion2 = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];

        prueba_estado2 = abreviacion2[estados2.indexOf($("#estado2").val().toLowerCase())];

        var curp2 = generaCurp({
          nombre            : nombre2,
          apellido_paterno  : ap_paterno2,
          apellido_materno  : ap_materno2,
          sexo              : sexo2,
          estado            : prueba_estado2,
          fecha_nacimiento  : [dia2, mes2, anio2]
        });
        
        document.getElementById("curp2").value = curp2;

        calculaRFC2();
  }



  //FUNCIÓN PARA GENERAR EL RFC
  function consultar_organizacion(){
    var pregunta = document.getElementById('select_sexo').value;
    if(pregunta == 'M'){
      document.getElementById('div_organizacion').style.display = 'block';
      document.getElementById("organizacion").focus();
    }else{
      document.getElementById('div_organizacion').style.display = 'none';
    }
  }


  function consultar_grupo(){
    var pregunta = document.getElementById('grupo_indigena').value;

    if(pregunta == 'SI'){
      document.getElementById('campo_oculto').style.display = 'block';
      document.getElementById("nombre_comunidad").focus();
    }else{
      document.getElementById('campo_oculto').style.display = 'none';
    }
  }

  function calculaRFC() {
    function quitaArticulos(palabra) {
      return palabra.replace("DEL ", "").replace("LAS ", "").replace("DE ",
          "").replace("LA ", "").replace("Y ", "").replace("A ", "");
    }
    function esVocal(letra) {
      if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
          || letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
          || letra == 'o' || letra == 'u')
        return true;
      else
        return false;
    }
    nombre = $("#nombre").val();
    apellidoPaterno = $("#ap_paterno").val();
    apellidoMaterno = $("#ap_materno").val();
    fecha = $("#fecha_nacimiento").val();
    var rfc = "";
    apellidoPaterno = quitaArticulos(apellidoPaterno);
    apellidoMaterno = quitaArticulos(apellidoMaterno);
    rfc += apellidoPaterno.substr(0, 1);
    var l = apellidoPaterno.length;
    var c;
    for (i = 0; i < l; i++) {
      c = apellidoPaterno.charAt(i);
      if (esVocal(c)) {
        rfc += c;
        break;
      }
    }
    rfc += apellidoMaterno.substr(0, 1);
    rfc += nombre.substr(0, 1);
    rfc += fecha.substr(8, 10);
    rfc += fecha.substr(3, 5).substr(0, 2);
    rfc += fecha.substr(0, 2);
    // rfc += "-" + homclave;
    $("#rfc2").val(rfc);
    //alert(rfc);
    //document.getElementById("rfc").value = rfc;
  }

  function calculaRFC2() {
    function quitaArticulos(palabra) {
      return palabra.replace("DEL ", "").replace("LAS ", "").replace("DE ",
          "").replace("LA ", "").replace("Y ", "").replace("A ", "");
    }
    function esVocal(letra) {
      if (letra == 'A' || letra == 'E' || letra == 'I' || letra == 'O'
          || letra == 'U' || letra == 'a' || letra == 'e' || letra == 'i'
          || letra == 'o' || letra == 'u')
        return true;
      else
        return false;
    }
    nombre2 = $("#nombre2").val();
    apellidoPaterno2 = $("#ap_paterno2").val();
    apellidoMaterno2 = $("#ap_materno2").val();
    fecha2 = $("#fecha_nacimiento2").val();
    var rfc2 = "";
    apellidoPaterno2 = quitaArticulos(apellidoPaterno2);
    apellidoMaterno2 = quitaArticulos(apellidoMaterno2);
    rfc2 += apellidoPaterno2.substr(0, 1);
    var l = apellidoPaterno2.length;
    var c;
    for (i = 0; i < l; i++) {
      c = apellidoPaterno2.charAt(i);
      if (esVocal(c)) {
        rfc2 += c;
        break;
      }
    }
    rfc2 += apellidoMaterno2.substr(0, 1);
    rfc2 += nombre2.substr(0, 1);
    rfc2 += fecha2.substr(8, 10);
    rfc2 += fecha2.substr(3, 5).substr(0, 2);
    rfc2 += fecha2.substr(0, 2);
    // rfc += "-" + homclave;
    $("#rfc3").val(rfc2);
    //alert(rfc);
    //document.getElementById("rfc").value = rfc;
  }


    function marcar_desmarcar(){
        var marca = document.getElementById('marcar');
        var cb = document.getElementsByName('folios[]');

        for (i=0; i<cb.length; i++){
            if(marca.checked == true){
              cb[i].checked = true
            }else{
              cb[i].checked = false;
            }
        }
     
    }

    ///OCULTAMOS EL MODAL_DESCARGAR DESPUES DE DAR CLIC EN DESCARGAR
    $(document).ready(function() {
      $("#btn_descargar").click(function() {
        $('#modalDescargar').modal('hide');
      });
    });

    ///funciones de bootstrap para mostrar los tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    //FUNCIÓN PARA LIMPIAR EL FORMUARLIO FRM_AFILIACION
    function limpiar(){
      // borra el formulario (asumiendo que sólo hay uno; si hay más, especifica su Id)
      document.getElementById("frm_afiliacion").reset();
    }

    /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP
    $(document).ready(function(){
      // generamos un evento cada vez que se pulse una tecla
      $("#cp").keyup(function(){
      
        // enviamos una petición al servidor mediante AJAX enviando el id
        // introducido por el usuario mediante POST
        $.post("consultar_cp.php", {"cp":$("#cp").val()}, function(data){
        
          // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          if(data.estado){
            $("#estado").val(data.estado);
            $("#num_estado").val(data.num_estado);
          }
          else{
            $("#estado").val("");
          }
            
          // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
          if(data.municipio){
            $("#municipio").val(data.municipio);
            $("#num_municipio").val(data.num_municipio);
          }
          else{
            $("#municipio").val("");
          }

          if(data.ciudad){
            $("#ciudad").val(data.ciudad);
          }
          else{
            $("#ciudad").val("");
          }

        },"json");
      });
    });

    /// FUNCIÓN PARA CONSULTAR LA INFORMACION RELACIONADA AL CP (FORM-EDITAR)
    $(document).ready(function(){
      // generamos un evento cada vez que se pulse una tecla
      $("#cp2").keyup(function(){
      
        // enviamos una petición al servidor mediante AJAX enviando el id
        // introducido por el usuario mediante POST
        $.post("consultar_cp.php", {"cp2":$("#cp2").val()}, function(data2){
        
          // Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          if(data2.estado){
            $("#estado2").val(data2.estado);
            $("#num_estado2").val(data2.num_estado2);
          }
          else{
            $("#estado2").val("");
          }
            
          // Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
          if(data2.municipio){
            $("#municipio2").val(data2.municipio);
            $("#num_municipio2").val(data2.num_municipio2);
          }
          else{
            $("#municipio2").val("");
          }
          if(data2.ciudad){
            $("#ciudad2").val(data2.ciudad);
          }
          else{
            $("#ciudad2").val("");
          }

        },"json");
      });
    });


    //FUNCIÓN PARA CAMBIAR A MAYUSCULAS EL TEXTO DE UN CAMPO
    function ponerMayusculas(nombre) 
    { 
        nombre.value=nombre.value.toUpperCase(); 
    } 
    function ponerMayusculas2(nombre) 
    { 
        nombre.value=nombre.value.toUpperCase(); 
    } 


    /// FUNCIÓN PARA CALCULAR LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
    function calcularEdad() {
        dia = document.getElementById("dia").value;
        mes = document.getElementById("mes").value;
        anio = document.getElementById("anio").value;
        fecha = anio+'/'+mes+"/"+dia;

        //alert("la fecha es: "+fecha);
      
        //var date= document.getElementById('fecha_nacimiento').value;

        /*var d = new Date(date.split("-").reverse().join("-"));
        var dd=d.getDate();
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();
        var newdate = yy+"/"+mm+"/"+dd;*/

        
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
        if(edad){
          document.getElementById("edad").value = edad;
          document.getElementById("fecha_nacimiento").value = dia+'/'+mes+"/"+anio;
        }else{
          document.getElementById("edad").value = '';
        }
    }

    function calcularEdad2() {
        dia2 = document.getElementById("dia2").value;
        mes2 = document.getElementById("mes2").value;
        anio2 = document.getElementById("anio2").value;
        fecha2 = anio2+'/'+mes2+"/"+dia2;

        //alert("la fecha es: "+fecha);
      
        //var date= document.getElementById('fecha_nacimiento').value;

        /*var d = new Date(date.split("-").reverse().join("-"));
        var dd=d.getDate();
        var mm=d.getMonth()+1;
        var yy=d.getFullYear();
        var newdate = yy+"/"+mm+"/"+dd;*/

        
        var hoy2 = new Date();
        var cumpleanos2 = new Date(fecha2);
        var edad2 = hoy2.getFullYear() - cumpleanos2.getFullYear();
        var m2 = hoy2.getMonth() - cumpleanos2.getMonth();

        if (m2 < 0 || (m2 === 0 && hoy2.getDate() < cumpleanos2.getDate())) {
            edad2--;
        }
        if(edad2){
          document.getElementById("edad2").value = edad2;
          document.getElementById("fecha_nacimiento2").value = dia2+'/'+mes2+"/"+anio2;
        }else{
          document.getElementById("edad2").value = '';
        }
    }


    ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
    $(document).on('ready',function(){

      $('#cp').keyup(function(){
        var url = 'select_colonia.php';                                   

        $.ajax({                        
           type: 'POST',                 
           url: url,                    
           data: $('#frm_afiliacion').serialize(),
           success: function(data)           
           {
             $('#colonia').html(data);          
           }
         });
      });
    });

    ///FUNCIÓN PARA CREAR UN SELECT DE LAS COLONIAS DE UN CP
    $(document).on('ready',function(){

      $('#cp2').keyup(function(){
        var url = 'select_colonia2.php';                                   

        $.ajax({                        
           type: 'POST',                 
           url: url,                    
           data2: $('#editar_afiliacion').serialize(),
           success: function(data2)           
           {
             $('#colonia2').html(data2);          
           }
         });
      });
    });



    /// FUNCIÓN PARA VALIDAR LOS CAMPOS OBLIGATORIOS
    function validar() {
        ap_paterno = document.getElementById("ap_paterno").value;
        if ( ap_paterno == null || ap_paterno.length == 0 || /^\s+$/.test(ap_paterno)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL APELLIDO PATERNO');
            document.getElementById("ap_paterno").focus();
            return false;
        }
        ap_materno = document.getElementById("ap_materno").value;
        if ( ap_materno == null || ap_materno.length == 0 || /^\s+$/.test(ap_materno)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL APELLIDO MATERNO');
            document.getElementById("ap_materno").focus();
            return false;
        }
        nombre = document.getElementById("nombre").value;
        if ( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NOMBRE');
            document.getElementById("nombre").focus();
            return false;
        }
        foto_afiliado = document.getElementById("foto_afiliado").value;
        if ( foto_afiliado == null || foto_afiliado.length == 0 || /^\s+$/.test(foto_afiliado)) {
        // Si no se cumple la condicion...
            alert('DEBES SELECCIONAR UNA FOTO DEL AFILIADO');
            document.getElementById("foto_afiliado").focus();
            return false;
        }

        dia = document.getElementById("dia").selectedIndex;
        if( dia == null || dia == 0 ) {
            alert('DEBES SELECCIONAR EL DÍA DE NACIMIENTO');
            document.getElementById("dia").focus();
            return false;
        }
        mes = document.getElementById("mes").selectedIndex;
        if( mes == null || mes == 0 ) {
            alert('DEBES SELECCIONAR EL MES DE NACIMIENTO');
            document.getElementById("mes").focus();
            return false;
        }

        anio = document.getElementById("anio").value;
        if ( anio == null || anio.length == 0 || /^\s+$/.test(anio)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL AÑO DE NACIMIENTO');
            document.getElementById("anio").focus();
            return false;

        }
        /*fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
        if ( fecha_nacimiento == null || fecha_nacimiento.length == 0 || /^\s+$/.test(fecha_nacimiento)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA FECHA DE NACIMIENTO');
            document.getElementById("fecha_nacimiento").focus();
            return false;
        }*/
        select_sexo = document.getElementById("select_sexo").selectedIndex;
        if( select_sexo == null || select_sexo == 0 ) {
            alert('DEBES SELECCIONAR EL SEXO');
            document.getElementById("select_sexo").focus();
            return false;
        }
        edad = document.getElementById("edad").value;
        if ( edad == null || edad.length == 0 || /^\s+$/.test(edad)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA EDAD');
            document.getElementById("edad").focus();
            return false;

        }
        estado_civil = document.getElementById("estado_civil").selectedIndex;
        if( estado_civil == null || estado_civil == 0 ) {
            alert('DEBES SELECCIONAR EL ESTADO CIVIL');
            document.getElementById("estado_civil").focus();
            return false;
        }
        grupo_indigena = document.getElementById("grupo_indigena").selectedIndex;
        if( grupo_indigena == null || grupo_indigena == 0 ) {
            alert('DEBES SELECCIONAR SI PERTENECE A UN GRUPO INDÍGENA');
            document.getElementById("grupo_indigena").focus();
            return false;
        }
        respuesta_grupo = document.getElementById('grupo_indigena').value;
        nombre_comunidad = document.getElementById('nombre_comunidad').value;
        if(respuesta_grupo == 'SI' && (nombre_comunidad == null || nombre_comunidad.length == 0 || /^\s+$/.test(nombre_comunidad))){
          alert('DEBES ESCRIBIR EL NOMBRE DEL GRUPO INDÍGENA');
          document.getElementById("nombre_comunidad").focus();
          return false;
        }

        cp = document.getElementById("cp").value;
        if ( cp == null || cp.length == 0 || /^\s+$/.test(cp)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL CODIGO POSTAL');
            document.getElementById("cp").focus();
            return false;
        }
        calle = document.getElementById("calle").value;
        if ( calle == null || calle.length == 0 || /^\s+$/.test(calle)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA CALLE');
            document.getElementById("calle").focus();
            return false;
        }
        correo = document.getElementById("correo").value;
        if ( correo == null || correo.length == 0 || /^\s+$/.test(correo)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR UN CORREO ELECTRONICO');
            document.getElementById("correo").focus();
            return false;
        }
        telefono = document.getElementById("telefono").value;
        if ( telefono == null || telefono.length == 0 || /^\s+$/.test(telefono)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR UN TELEFONO');
            document.getElementById("telefono").focus();
            return false;
        }
        curp = document.getElementById("curp").value;
        if ( curp == null || curp.length == 0 || /^\s+$/.test(curp)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NUMERO DE CURP');
            document.getElementById("curp").focus();
            return false;
        }
        rfc = document.getElementById("rfc").value;
        if ( rfc == null || rfc.length == 0 || /^\s+$/.test(rfc)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL RFC');
            document.getElementById("rfc").focus();
            return false;
        }
        clave_elector = document.getElementById("clave_elector").value;
        if ( clave_elector == null || clave_elector.length == 0 || /^\s+$/.test(clave_elector)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR LA CLAVE DE ELECTOR');
            document.getElementById("clave_elector").focus();
            return false;
        }
        num_ine = document.getElementById("num_ine").value;
        if ( num_ine == null || num_ine.length == 0 || /^\s+$/.test(num_ine)) {
        // Si no se cumple la condicion...
            alert('DEBES INGRESAR EL NUMERO DE INE');
            document.getElementById("num_ine").focus();
            return false;
        }
       
        return true;
    }


  </script>

<script type="text/javascript">


      /*$(document).ready(function() {

        $("#agregar_afiliado").click(function() {
          var ruta = 'prueba_ajax.php';    
           var formData = new FormData(('#frm_afiliacion').serialize());                               

          $.ajax({                        
             url: ruta,
                type: "POST",
                data: formData,
              
             success: function(data)           
             {
               $('#desplegar').html(data);
               $('#modal_frm_afiliado').modal('hide');
               document.getElementById("frm_afiliacion").reset();
             }
           });
        });
      });*/

    /*17_07_2017
        $(function(){
            $("#frm_afiliacion").on("submit", function(e){
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("frm_afiliacion"));
                formData.append("dato", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                $.ajax({
                    url: "prueba_ajax.php",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        $('#modal_frm_afiliado').modal('hide');
                        document.getElementById("frm_afiliacion").reset();
                        //$("#desplegar").html("Respuesta: " + res);
                        location.reload(true);
                    });
            });
        });
        17_07_2017*/

