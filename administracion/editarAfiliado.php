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
                                                                        <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="" name="curp" placeholder="CURP" onBlur="ponerMayusculas(this)" value="<?php echo $registros['curp']; ?>">
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>
                                                                        <input type="text" class="form-control" style="border: 2px solid #2980b9;" id="rfc" name="rfc" placeholder="RFC" onBlur="ponerMayusculas(this)" value="<?php echo $registros['rfc']; ?>">
                                                                      </td>
                                                                    </tr>

                                                                    <tr>
                                                                      <td>
                                                                        <input type="text" class="form-control" id="clave_elector" name="clave_elector" placeholder="Clave Elector" onBlur="ponerMayusculas(this)" value="<?php echo $registros['clave_elector']; ?>">
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>
                                                                        <input type="text" class="form-control" id="num_ine" name="num_ine" placeholder="No. Credencial del INE" onBlur="ponerMayusculas(this)" value="<?php echo $registros['num_ine']; ?>">
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
                                                                              <input type="text" class="form-control" id="" name="ap_paterno" placeholder="" onchange="otra_consulta2()" onBlur="ponerMayusculas2(this)" value="<?php echo $registros['ap_paterno']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Apellido Materno</p>
                                                                            <input type="text" class="form-control" id="" name="ap_materno" placeholder="" onchange="otra_consulta()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ap_materno']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Nombre(s)</p>
                                                                            <input type="text" class="form-control" id="" name="nombre" placeholder="" onchange="otra_consulta()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre']; ?>">
                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>
                                                                            <p>Fecha de Nacimiento</p>
                                                                            <input type="text" class="form-control" id="" name="fecha_nacimiento" placeholder="dd/mm/aaaa" onchange="calcularEdad()" onBlur="ponerMayusculas(this)" value="<?php echo $registros['fecha_nacimiento']; ?>">
                                                                          </td>
                                                                          <td>
                                                                            <select class="form-control" name="sexo" id="" >
                                                                              <option value="">Sexo</option>
                                                                              <option <?php if($registros['sexo'] == 'H'){echo 'selected';} ?> value="H">Hombre</option>
                                                                              <option <?php if($registros['sexo'] == 'M'){echo 'selected';} ?> value="M">Mujer</option>
                                                                            </select>
                                                                          </td>

                                                                          <td>
                                                                              <p>Edad</p>
                                                                            <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="" name="edad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['edad']; ?>">
                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>
                                                                            <select class="form-control" name="estado_civil" id="">
                                                                              <option value="">Estado Civil</option>
                                                                              <option <?php if($registros['estado_civil'] == 'Soltero'){echo 'selected'; } ?> value="Soltero">Soltero</option>
                                                                              <option <?php if($registros['estado_civil'] == 'Casado'){echo 'selected'; } ?> value="Casado">Casado</option>
                                                                              <option <?php if($registros['estado_civil'] == 'Divorciado'){echo 'selected'; } ?> value="Divorciado">Divorciado</option>
                                                                            </select>
                                                                          </td>
                                                                          <td>
                                                                              <p>Grupo Indigena</p>
                                                                            <input type="text" class="form-control" id="" name="grupo_indigena" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['grupo_indigena']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Nombre del Grupo, Ejido o Comunidad</p>
                                                                            <input type="text" class="form-control" id="" name="nombre_comunidad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['nombre_comunidad']; ?>">
                                                                          </td>

                                                                        </tr>
                                                                          <td>
                                                                              <p>Código Postal</p>
                                                                            <input type="text" class="form-control" id="" name="cp" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cp']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Estado</p>
                                                                            <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="" name="estado" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['estado']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Ciudad, Población o Localidad</p>
                                                                            <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="" name="ciudad" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ciudad']; ?>">
                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>
                                                                              <p>Municipio</p>
                                                                            <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="" name="municipio" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['municipio']; ?>">
                                                                          </td>
                                                                          <td colspan="2">
                                                                            <p>Colonia</p>
                                                                            <input class="form-control" style="border: 2px solid #2980b9;" type="text" name="colonia" value="<?php echo $registros['colonia']; ?>">

                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td colspan="2">
                                                                              <p>Calle</p>
                                                                            <input type="text" class="form-control" id="" name="calle" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['calle']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Número</p>
                                                                            <input type="text" class="form-control" id="" name="numero" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['numero']; ?>">
                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>
                                                                              <p>Correo Electrónico</p>
                                                                            <input type="email" class="form-control" id="" name="correo" placeholder="" value="<?php echo $registros['correo']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Télefono</p>
                                                                            <input type="text" class="form-control" id="" name="telefono" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['telefono']; ?>">
                                                                          </td>
                                                                          <td>
                                                                              <p>Celular</p>
                                                                            <input type="text" class="form-control" id="" name="celular" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['celular']; ?>">
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
                                                                              <input type="text" class="form-control" id="" name="ocupacion" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['ocupacion']; ?>">
                                                                            </td>
                                                                            <td>
                                                                              <p>Cargo o Puesto que desempeña</p>
                                                                              <input type="text" class="form-control" id="" name="cargo" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['cargo']; ?>">
                                                                            </td>
                                                                          </tr>
                                                                          <tr>
                                                                            <td>
                                                                              <p>Empresa</p>
                                                                              <input type="text" class="form-control" id="" name="empresa" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['empresa']; ?>">
                                                                            </td>
                                                                            <td>
                                                                              <p>Tel. Oficina</p>
                                                                              <input type="text" class="form-control" id="" name="tel_oficina" placeholder="" onBlur="ponerMayusculas(this)" value="<?php echo $registros['tel_oficina']; ?>">
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