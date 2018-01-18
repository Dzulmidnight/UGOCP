<div class="modal fade" id="<?php echo 'modalAfiliado'.$registros['folio']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="" id="frm_editar_afiliado<?php echo $registros['folio']; ?>">
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
                                    <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="curp<?php echo $registros['folio']; ?>" name="curp" placeholder="CURP" onBlur="ponerMayusculas(this)" value="<?php echo $registros['curp']; ?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>RFC</p>
                                    <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="rfc<?php echo $registros['folio']; ?>" name="rfc" placeholder="RFC" onBlur="ponerMayusculas(this)" value="<?php echo $registros['rfc']; ?>">
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <p>CLAVE ELECTOR</p>
                                    <input type="text" class="form-control" id="clave_elector2" name="clave_elector" placeholder="Clave Elector" onBlur="ponerMayusculas(this)" value="<?php echo $registros['clave_elector']; ?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p>No. DE CREDENCIAL DEL INE (PARTE POSTERIOR)</p>
                                    <input type="text" class="form-control" id="num_ine2" name="num_ine" placeholder="No. Credencial del INE" onBlur="ponerMayusculas(this)" value="<?php echo $registros['num_ine']; ?>">
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
                                          <input type="text" class="form-control" id="ap_paterno<?php echo $registros['folio']; ?>" name="ap_paterno" placeholder="" onChange="editarFolio('<?php echo $registros['folio']; ?>')" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ap_paterno']; ?>">
                                      </td>
                                      <td>
                                          <p>Apellido Materno</p>
                                        <input type="text" class="form-control" id="ap_materno<?php echo $registros['folio']; ?>" name="ap_materno" placeholder="" onChange="editarFolio('<?php echo $registros['folio']; ?>')" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ap_materno']; ?>">
                                      </td>
                                      <td>
                                          <p>Nombre(s)</p>
                                        <input type="text" class="form-control" id="nombre<?php echo $registros['folio']; ?>" name="nombre" placeholder="" onChange="editarFolio('<?php echo $registros['folio']; ?>')" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <!-- INICIO NACIMIENTO -->
                                      <td>
                                        <p>Fecha de Nacimiento</p>
                                        <select class="form-control" onChange="editarFolio('<?php echo $registros['folio']; ?>')"  id="dia<?php echo $registros['folio']; ?>" name="dia">
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
                                        <select class="form-control" onChange="editarFolio('<?php echo $registros['folio']; ?>')" id="mes<?php echo $registros['folio']; ?>" name="mes">
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
                                        <input class="form-control" type="text" onChange="editarFolio('<?php echo $registros['folio']; ?>')" id="anio<?php echo $registros['folio']; ?>" name="anio" placeholder="aaaa" value="<?php echo $registros['anio']; ?>" >
                                        <input type="hidden" id="fecha_nacimiento<?php echo $registros['folio']; ?>" name="fecha_nacimiento" value="">
                                      </td>
                                      <!-- FIN NACIMIENTO -->

                                      <td>
                                        <select class="form-control" name="select_sexo" id="select_sexo<?php echo $registros['folio']; ?>" >
                                          <option value="">Sexo</option>
                                          <option <?php if($registros['sexo'] == 'H'){echo 'selected';} ?> value="H">Hombre</option>
                                          <option <?php if($registros['sexo'] == 'M'){echo 'selected';} ?> value="M">Mujer</option>
                                        </select>
                                      </td>

                                      <td>
                                          <p>Edad</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="edad<?php echo $registros['folio']?>" name="edad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['edad']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <select class="form-control" name="estado_civil" id="estado_civil<?php echo $registros['folio']; ?>">
                                          <option value="">Estado Civil</option>
                                          <option <?php if($registros['estado_civil'] == 'Soltero'){echo 'selected'; } ?> value="Soltero">Soltero</option>
                                          <option <?php if($registros['estado_civil'] == 'Casado'){echo 'selected'; } ?> value="Casado">Casado</option>
                                          <option <?php if($registros['estado_civil'] == 'Divorciado'){echo 'selected'; } ?> value="Divorciado">Divorciado</option>
                                        </select>
                                      </td>
                                      <td>
                                          <p>Grupo Indigena</p>
                                        <input type="text" class="form-control" id="grupo_indigena<?php echo $registros['folio']; ?>" name="grupo_indigena" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['grupo_indigena']; ?>">
                                      </td>
                                      <td>
                                          <p>Nombre del Grupo, Ejido o Comunidad</p>
                                        <input type="text" class="form-control" id="nombre_comunidad<?php echo $registros['folio']; ?>" name="nombre_comunidad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre_comunidad']; ?>">
                                      </td>

                                    </tr>
                                      <td>
                                          <p>Código Postal</p>
                                        <input type="text" class="form-control" id="cp<?php echo $registros['folio']; ?>" name="cp" placeholder="" onChange="editarFolio('<?php echo $registros['folio']; ?>')" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cp']; ?>">
                                      </td>
                                      <td>
                                          <p>Estado</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="estado<?php echo $registros['folio']; ?>" name="estado" placeholder="" onChange="editarFolio('<?php echo $registros['folio']; ?>')" onBlur="ponerMayusculas(this)" value="<?php echo $registros['estado']; ?>">
                                        <input type="hidden" id="num_estado<?php echo $registros['folio']; ?>" name="num_estado_add" value="<?php echo $registros['num_estado']; ?>">
                                      </td>
                                      <td>
                                          <p>Ciudad, Población o Localidad</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="ciudad<?php echo $registros['folio']; ?>" name="ciudad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ciudad']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <p>Municipio</p>
                                        <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="municipio<?php echo $registros['folio']; ?>" name="municipio" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['municipio']; ?>">
                                        <input type="hidden" id="num_municipio<?php echo $registros['folio']; ?>" name="num_municipio" value="<?php echo $registros['num_municipio']; ?>">
                                      </td>
                                      <td colspan="2">
                                        <p>Colonia</p>
                                        <input class="form-control" style="border: 2px solid #2980b9;" type="text" id="colonia<?php echo $registros['folio']; ?>" name="colonia" value="<?php echo $registros['colonia']; ?>">

                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2">
                                          <p>Calle</p>
                                        <input type="text" class="form-control" id="calle<?php echo $registros['folio']; ?>" name="calle" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['calle']; ?>">
                                      </td>
                                      <td>
                                          <p>Número</p>
                                        <input type="text" class="form-control" id="numero<?php echo $registros['folio']; ?>" name="numero" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['numero']; ?>">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <p>Correo Electrónico</p>
                                        <input type="email" class="form-control" id="correo<?php echo $registros['folio']; ?>" name="correo" placeholder="" value="<?php echo $registros['correo']; ?>">
                                      </td>
                                      <td>
                                          <p>Télefono</p>
                                        <input type="text" class="form-control" id="telefono<?php echo $registros['folio']; ?>" name="telefono" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['telefono']; ?>">
                                      </td>
                                      <td>
                                          <p>Celular</p>
                                        <input type="text" class="form-control" id="celular<?php echo $registros['folio']; ?>" name="celular" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['celular']; ?>">
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
                                          <input type="text" class="form-control" id="ocupacion<?php echo $registros['folio']; ?>" name="ocupacion" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ocupacion']; ?>">
                                        </td>
                                        <td>
                                          <p>Cargo o Puesto que desempeña</p>
                                          <input type="text" class="form-control" id="cargo<?php echo $registros['folio']; ?>" name="cargo" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cargo']; ?>">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>Empresa</p>
                                          <input type="text" class="form-control" id="empresa<?php echo $registros['folio']; ?>" name="empresa" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['empresa']; ?>">
                                        </td>
                                        <td>
                                          <p>Tel. Oficina</p>
                                          <input type="text" class="form-control" id="tel_oficina<?php echo $registros['folio']; ?>" name="tel_oficina" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['tel_oficina']; ?>">
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
                <button class="btn btn-warning" type="submit" name="modificar_afiliado" value="<?php echo $folio; ?>"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <b>Guardar Cambios</b></button>
            </div>
        </form>
      </div>
  </div>
</div>
