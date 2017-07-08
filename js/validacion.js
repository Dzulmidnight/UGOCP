jQuery(document).on('submit','#form-login', function(event){
	event.preventDefault();

	jQuery.ajax({
		url: 'conexion/validar.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		beforeSend: function(){
			$('.botonlg').val('Validando...');
		}
	})
	.done(function(respuesta) {
		console.log(respuesta);
		if(!respuesta.error){
			if(respuesta.tipo == 'administrador'){
				location.href = 'administracion/index.php';
			}else if(respuesta.tipo == 'usuario'){
				location.href = 'index.php';
			}
		}else{
			$('.error').slideDown('slow');
			setTimeout(function(){
				$('.error').slideUp('slow');
			},3000);
			$('.botonlg').val('Ingresar');
		}
	})
	.fail(function(resp) {
		console.log(resp.responseText);
	})
	.always(function() {
		console.log("complete");
	});
});