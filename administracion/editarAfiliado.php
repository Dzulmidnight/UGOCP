<div class="modal fade" id="<?php echo 'modalAfiliado'.$registros['folio']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="" id="editar_afiliacion">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Editar Afiliado - Folio: <?php echo '<span style="color:red">'.$folio.'</span>'; ?> </b></h4>
            </div>
            <div class="modal-body">
              <!-- page start-->
              <div class="row">
                    <!--<div id="" style="position:fixed;z-index: 1;right:0">
                      <div class="">
                        <button class="btn btn-warning" type="submit" name="agregar_afiliado" value="1"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <b>Agregar</b></button>
                        <button class="btn btn-default" type="button" name="btn_limpiar" onclick="limpiar()"><i class="fa fa-eraser"></i> <b>Limpiar</b></button> 
                      </div>
                    </div>-->

                    <aside class="profile-nav col-lg-3">
                        <section class="panel">
                          <div class="col-md-12">
                            <img class="img-thumbnail" src="<?php echo $registros['foto']; ?>" alt="">
                            <div class="form-group">
                                <div class="controls col-md-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-white btn-file">
                                      <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Cambiar imagen</span>
                                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                      <input type="file" name="foto_afiliado" class="default" />
                                      </span>
                                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                    </div>
                                </div>
                            </div>

                          </div>


                            <!--<ul class="nav nav-pills nav-stacked">
                                <li><a href="profile.html"> <i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="profile-activity.html"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-danger pull-right r-activity">9</span></a></li>
                                <li  class="active"><a href="profile-edit.html"> <i class="fa fa-edit"></i> Edit profile</a></li>
                            </ul>-->
                            <table class="table">
                              <thead>
                                <tr class="success">
                                  <th>INFORMACIÓN COMPLEMENTARIA</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <p>CURP</p>
                                    <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="curp2" name="curp2" placeholder="CURP" onBlur="ponerMayusculas(this)" value="<?php echo $registros['curp']; ?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>RFC</p>
                                    <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="rfc3" name="rfc3" placeholder="RFC" onBlur="ponerMayusculas2(this)" value="<?php echo $registros['rfc']; ?>">
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <p>CLAVE ELECTOR</p>
                                    <input type="text" class="form-control" id="clave_elector2" name="clave_elector2" placeholder="Clave Elector" onBlur="ponerMayusculas(this)" value="<?php echo $registros['clave_elector']; ?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>No. DE CREDENCIAL DEL INE (PARTE POSTERIOR)</p>
                                    <input type="text" class="form-control" id="num_ine2" name="num_ine2" placeholder="No. Credencial del INE" onBlur="ponerMayusculas(this)" value="<?php echo $registros['num_ine']; ?>">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </section>

                    </aside>
                    <aside class="profile-info col-lg-9">
                        <section class="panel">
                            <div class="panel-body bio-graph-info">
                                <h1>DATOS GENERALES</h1>
                              
                                  <table class="table">
                                    <tr>
                                      <td>
                                          <p>Apellido Paterno</p>
                                          <input type="text" class="form-control" id="ap_paterno2" name="ap_paterno2" placeholder="" onChange="otra_consulta2()" onBlur="ponerMayusculas2(this)" value="<?php echo $registros['ap_paterno']; ?>">
                                      </td>
                                      <td>
                                          <p>Apellido Materno</p>
                                        <input type="text" class="form-control" id="ap_materno2" name="ap_materno2" placeholder="" onChange="otra_consulta2()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ap_materno']; ?>">
                                      </td>
                                      <td>
                                          <p>Nombre(s)</p>
                                        <input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="" onChange="otra_consulta2()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <!-- INICIO NACIMIENTO -->
                                      <td>
                                        <p>Fecha de Nacimiento</p>
                                        <select class="form-control" onChange="otra_consulta2()" onBlur="ponerFecha()" name="dia2" id="dia2">
                                          <option value="">Dia</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '01'){ echo 'selected'; } ?> value="01">01</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '02'){ echo 'selected'; } ?> value="02">02</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '03'){ echo 'selected'; } ?> value="03">03</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '04'){ echo 'selected'; } ?> value="04">04</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '05'){ echo 'selected'; } ?> value="05">05</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '06'){ echo 'selected'; } ?> value="06">06</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '07'){ echo 'selected'; } ?> value="07">07</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '08'){ echo 'selected'; } ?> value="08">08</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '09'){ echo 'selected'; } ?> value="09">09</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '10'){ echo 'selected'; } ?> value="10">10</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '11'){ echo 'selected'; } ?> value="11">11</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '12'){ echo 'selected'; } ?> value="12">12</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '13'){ echo 'selected'; } ?> value="13">13</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '14'){ echo 'selected'; } ?> value="14">14</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '15'){ echo 'selected'; } ?> value="15">15</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '16'){ echo 'selected'; } ?> value="16">16</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '17'){ echo 'selected'; } ?> value="17">17</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '18'){ echo 'selected'; } ?> value="18">18</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '19'){ echo 'selected'; } ?> value="19">19</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '20'){ echo 'selected'; } ?> value="20">20</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '21'){ echo 'selected'; } ?> value="21">21</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '22'){ echo 'selected'; } ?> value="22">22</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '23'){ echo 'selected'; } ?> value="23">23</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '24'){ echo 'selected'; } ?> value="24">24</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '25'){ echo 'selected'; } ?> value="25">25</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '26'){ echo 'selected'; } ?> value="26">26</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '27'){ echo 'selected'; } ?> value="27">27</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '28'){ echo 'selected'; } ?> value="28">28</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '29'){ echo 'selected'; } ?> value="29">29</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '30'){ echo 'selected'; } ?> value="30">30</option>
                                          <option <?php if(isset($registros['dia']) AND $registros['dia'] == '31'){ echo 'selected'; } ?> value="31">31</option>
                                        </select>
                                        <select class="form-control" onChange="otra_consulta2()" onBlur="ponerFecha()" name="mes2" id="mes2">
                                          <option value="">Mes</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '01' ){ echo 'selected'; } ?> value="01">ENE</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '02' ){ echo 'selected'; } ?> value="02">FEB</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '03' ){ echo 'selected'; } ?> value="03">MAR</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '04' ){ echo 'selected'; } ?> value="04">ABR</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '05' ){ echo 'selected'; } ?> value="05">MAY</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '06' ){ echo 'selected'; } ?> value="06">JUN</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '07' ){ echo 'selected'; } ?> value="07">JUL</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '08' ){ echo 'selected'; } ?> value="08">AGO</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '09' ){ echo 'selected'; } ?> value="09">SEP</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '10' ){ echo 'selected'; } ?> value="10">OCT</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '11' ){ echo 'selected'; } ?> value="11">NOV</option>
                                          <option <?php if(isset($registros['mes']) && $registros['mes'] == '12' ){ echo 'selected'; } ?> value="12">DIC</option>
                                        </select>
                                        <input class="form-control" type="text" onChange="otra_consulta2()" id="anio2" name="anio2" placeholder="aaaa" value="<?php echo $registros['anio']; ?>" onchange="calcularEdad()" onBlur="ponerFecha()">
                                        <input type="hidden" class="form-control" id="fecha_nacimiento2" name="fecha_nacimiento2" value="<?php echo $registros['fecha_nacimiento']; ?>">
                                      </td>
                                      <!-- FIN NACIMIENTO -->

                                      <td>
                                        <select class="form-control" name="sexo2" id="sexo2" >
                                          <option value="">Sexo</option>
                                          <option <?php if($registros['sexo'] == 'H'){echo 'selected';} ?> value="H">Hombre</option>
                                          <option <?php if($registros['sexo'] == 'M'){echo 'selected';} ?> value="M">Mujer</option>
                                        </select>
                                      </td>

                                      <td>
                                          <p>Edad</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="edad2" name="edad2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['edad']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <select class="form-control" name="estado_civil2" id="estado_civil2">
                                          <option value="">Estado Civil</option>
                                          <option <?php if($registros['estado_civil'] == 'Soltero'){echo 'selected'; } ?> value="Soltero">Soltero</option>
                                          <option <?php if($registros['estado_civil'] == 'Casado'){echo 'selected'; } ?> value="Casado">Casado</option>
                                          <option <?php if($registros['estado_civil'] == 'Divorciado'){echo 'selected'; } ?> value="Divorciado">Divorciado</option>
                                        </select>
                                      </td>
                                      <td>
                                          <p>Grupo Indigena</p>
                                        <input type="text" class="form-control" id="grupo_indigena2" name="grupo_indigena2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['grupo_indigena']; ?>">
                                      </td>
                                      <td>
                                          <p>Nombre del Grupo, Ejido o Comunidad</p>
                                        <input type="text" class="form-control" id="nombre_comunidad2" name="nombre_comunidad2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre_comunidad']; ?>">
                                      </td>

                                    </tr>
                                      <td>
                                          <p>Código Postal</p>
                                        <input type="text" class="form-control" id="cp2" name="cp2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cp']; ?>">
                                      </td>
                                      <td>
                                          <p>Estado</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="estado2" name="estado2" placeholder="" onChange="otra_consulta2()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['estado']; ?>">
                                      </td>
                                      <td>
                                          <p>Ciudad, Población o Localidad</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="ciudad2" name="ciudad2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ciudad']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <p>Municipio</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="municipio2" name="municipio2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['municipio']; ?>">
                                      </td>
                                      <td colspan="2">
                                        <p>Colonia</p>
                                        <input class="form-control" style="border: 2px solid #2980b9;" type="text" id="colonia2" name="colonia2" value="<?php echo $registros['colonia']; ?>">

                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2">
                                          <p>Calle</p>
                                        <input type="text" class="form-control" id="calle2" name="calle2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['calle']; ?>">
                                      </td>
                                      <td>
                                          <p>Número</p>
                                        <input type="text" class="form-control" id="numero2" name="numero2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['numero']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <p>Correo Electrónico</p>
                                        <input type="email" class="form-control" id="correo2" name="correo2" placeholder="" value="<?php echo $registros['correo']; ?>">
                                      </td>
                                      <td>
                                          <p>Télefono</p>
                                        <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['telefono']; ?>">
                                      </td>
                                      <td>
                                          <p>Celular</p>
                                        <input type="text" class="form-control" id="celular2" name="celular2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['celular']; ?>">
                                      </td>

                                    </tr>
                        
                                  </table>
                                  <table class="table">
                                    <thead>
                                      <tr class="info">
                                        <th colspan="2">INFORMACIÓN PROFESIONAL O LABORAL</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <p>Ocupación</p>
                                          <input type="text" class="form-control" id="ocupacion2" name="ocupacion2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ocupacion']; ?>">
                                        </td>
                                        <td>
                                          <p>Cargo o Puesto que desempeña</p>
                                          <input type="text" class="form-control" id="cargo2" name="cargo2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cargo']; ?>">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>Empresa</p>
                                          <input type="text" class="form-control" id="empresa2" name="empresa2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['empresa']; ?>">
                                        </td>
                                        <td>
                                          <p>Tel. Oficina</p>
                                          <input type="text" class="form-control" id="tel_oficina2" name="tel_oficina2" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['tel_oficina']; ?>">
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </section>
                    </aside>

              </div>
              <!-- page end-->
            </div>
            <div class="modal-footer">
                <input type="hidden" name="foto_actual" value="<?php echo $registros['foto']; ?>">
                <button class="btn btn-warning" type="submit" name="modificar_afiliado" value="<?php echo $registros['folio']; ?>"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <b>Guardar Cambios</b></button>
            </div>              
        </form>
      </div>
  </div>
</div>

<script>
  function ponerFecha(){
    var otroDia = document.getElementById('dia2').value;
    var otroMes = document.getElementById('mes2').value;
    var otroAnio = document.getElementById('anio2').value;
    var fechaVigente = otroDia+'/'+otroMes+'/'+otroAnio;

    document.getElementById('fecha_nacimiento2').value = fechaVigente;

    otra_consulta2();
    calcularEdad2();
  }
</script>