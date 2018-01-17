<div class="modal fade" id="modal_frm_afiliado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="" id="frm_afiliacion">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      
                      <h4 class="modal-title"><b>Formato de Afiliación </b></h4>
                  </div>
                  <div class="modal-body">
                    <!-- page start-->
                      <div class="row">

                            <aside class="profile-nav col-lg-3">
                                <section class="panel">
                                    <div class="user-heading round">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: 145px; height: 170px;">
                                              <img src="http://www.placehold.it/145x170" alt="" />
                                          </div>
                                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 145px; max-height: 170px; line-height: 20px;"></div>
                                          <div>
                                           <span class="btn btn-white btn-file">
                                           <span class="fileupload-new" style="color:#000"><i class="fa fa-paper-clip"></i> Agregar Foto</span>
                                           <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                           <input type="file" id="foto_afiliado" name="foto_afiliado" class="default" />
                                           </span>
                                              <!--<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>-->
                                          </div>
                                      </div>

                                    </div>

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
                                            <input type="text" style="border: 2px solid #2980b9;width:200px;height:30px;" class="" id="curp_otra" name="curp" placeholder="" onBlur="ponerMayusculas(this)">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <p>RFC</p>
                                            <input type="text" style="border: 2px solid #2980b9;width:200px;height:30px;" class="" id="rfc2" name="rfc" placeholder="" onBlur="ponerMayusculas(this)">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <p>Clave Elector</p>
                                            <input type="text" class="form-control" id="clave_elector" name="clave_elector" placeholder="" onBlur="ponerMayusculas(this)">
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <p>No. DE CREDENCIAL DEL INE (PARTE POSTERIOR)</p>
                                            <input type="text" class="form-control" id="num_ine" name="num_ine" placeholder="" onBlur="ponerMayusculas(this)">
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
                                                    <input type="text" class="form-control" id="ap_paterno_add" name="ap_paterno" placeholder=""  onBlur="ponerMayusculas(this)" required>
                                                </td>
                                                <td>
                                                    <p>Apellido Materno</p>
                                                  <input type="text" class="form-control" id="ap_materno_add" name="ap_materno" placeholder=""  onBlur="ponerMayusculas(this)" required>
                                                </td>
                                                <td>
                                                    <p>Nombre(s)</p>
                                                  <input type="text" class="form-control" id="nombre_add" name="nombre" placeholder=""  onBlur="ponerMayusculas(this)" required>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <p>Fecha de Nacimiento</p>
                                                  <!--<input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="dd/mm/aaaa" onchange="calcularEdad()" onBlur="ponerMayusculas(this)">-->
                                                  <select class="form-control" onChange="consultarFolio('_add')" name="dia" id="dia_add">
                                                    <option value="">Dia</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                  </select>
                                                  <select class="form-control" onChange="consultarFolio('_add')" name="mes" id="mes_add">
                                                    <option value="">Mes</option>
                                                    <option value="01">ENE</option>
                                                    <option value="02">FEB</option>
                                                    <option value="03">MAR</option>
                                                    <option value="04">ABR</option>
                                                    <option value="05">MAY</option>
                                                    <option value="06">JUN</option>
                                                    <option value="07">JUL</option>
                                                    <option value="08">AGO</option>
                                                    <option value="09">SEP</option>
                                                    <option value="10">OCT</option>
                                                    <option value="11">NOV</option>
                                                    <option value="12">DIC</option>
                                                  </select>
                                                  <input class="form-control" type="text" id="anio_add" name="anio" placeholder="aaaa" value="" onChange="consultarFolio('_add')">
                                                  <input type="text" name="fecha_nacimiento" id="fecha_nacimiento_add" onChange="consultarFolio('_add')" value="">
                                                </td>
                                                <td>
                                                  <select class="form-control" name="select_sexo" id="select_sexo_add" onchange="consultar_organizacion()">
                                                    <option value="">Sexo</option>
                                                    <option value="H">Hombre</option>
                                                    <option value="M">Mujer</option>
                                                  </select>
                                                  <div id="div_organizacion" style="display:none">
                                                    <label style="background:#e74c3c;color:#ecf0f1;margin-top:1.5em;" for="organizacion"><b>Selecciona la organización a la que pertenece</b></label>
                                                    <select style="border: 2px solid #2980b9;" class="form-control" name="organizacion" id="organizacion_add">
                                                      <option value="FENAM">FENAM</option>
                                                      <option value="UGOCP">UGOCP</option>
                                                    </select>
                                                  </div>
                                                </td>

                                                <td>
                                                    <p>Edad</p>
                                                  <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="edad_add" name="edad" placeholder="" onChange="consultarFolio('_add')" onBlur="ponerMayusculas(this)">
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <select class="form-control" name="estado_civil" id="estado_civil_add" onChange="consultarFolio('_add')">
                                                    <option value="">Estado Civil</option>
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                  </select>
                                                </td>
                                                <td>
                                                    <p>¿Pertenece a un grupo indígena?</p>
                                                    <select name="grupo_indigena" id="grupo_indigena_add" onchange="consultar_grupo()">
                                                      <option value="">Seleccione una opción</option>
                                                      <option value="SI">SI</option>
                                                      <option value="NO">NO</option>
                                                    </select>
                                                </td>
                                                <td id="campo_oculto" style="display:none">
                                                    <p>Nombre del Grupo</p>
                                                  <input style="border: 2px solid red;" type="text" class="form-control" id="nombre_comunidad_add" name="nombre_comunidad" placeholder="" onBlur="ponerMayusculas(this)">
                                                </td>
                                              
                                              </tr>
                                              <tr class="info">
                                                  <th colspan="3">INFORMACIÓN DOMICILIARIA</th>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <p>Código Postal</p>
                                                  <input type="text" class="form-control" id="cp_add" name="cp" placeholder="" onChange="otra_consulta('_add')" onBlur="ponerMayusculas(this)">
                                                </td>
                                                <td>
                                                    <p>Estado</p>
                                                  <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="estado_add" name="estado" placeholder="" onchange="consultarFolio('_add')" onBlur="ponerMayusculas(this)">
                                                  <input type="hidden" id="num_estado_add" name="num_estado" value="">
                                                </td>
                                                <td>
                                                    <p>Ciudad, Población o Localidad</p>
                                                  <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="ciudad_add" name="ciudad" placeholder="" onBlur="ponerMayusculas(this)">
                                                </td>
                                              </tr>

                                              <tr>
                                                <td>
                                                    <p>Municipio</p>
                                                  <input type="text" style="border: 2px solid #2980b9;" class="form-control" id="municipio_add" name="municipio" placeholder="" onBlur="ponerMayusculas(this)">
                                                  <input type="hidden" id="num_municipio" name="num_municipio">
                                                </td>
                                                <td colspan="2">
                                                  <p>Colonia</p>
                                                  <select style="border: 2px solid #2980b9;" class="form-control" name="colonia" id="colonia_add" onchange="otra_consulta()">
                                                    <option value="">Colonia</option>
                                                  </select>
                                                  <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" id="checkbox_colonia_add" onclick="mostrar_colonia()"> Colonia diferente
                                                      </label>
                                                  </div>
                                                  <input type="text" style="display:none;border: 2px solid red;" class="form-control" id="colonia_diferente_add" name="colonia_diferente" placeholder="Colonia">
                                                </td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">
                                                    <p>Calle</p>
                                                  <input type="text" class="form-control" id="calle_add" name="calle" placeholder="" onchange="otra_consulta()" onBlur="ponerMayusculas(this)">
                                                </td>
                                                <td>
                                                    <p>Número</p>
                                                  <input type="text" class="form-control" id="numero_add" name="numero" placeholder="" onBlur="ponerMayusculas(this)">
                                                </td>
                                              </tr>
                                              <tr class="info">
                                                  <th colspan="3">INFORMACIÓN DE CONTACTO</th>
                                              </tr>
                                              <tr>
                                                <td>
                                                    <p>Correo Electrónico</p>
                                                  <input type="email" class="form-control" id="correo_add" name="correo" placeholder="">
                                                </td>
                                                <td>
                                                    <p>Télefono</p>
                                                  <input type="text" class="form-control" id="telefono_add" name="telefono" placeholder="" onBlur="ponerMayusculas(this)">
                                                </td>
                                                <td>
                                                    <p>Celular</p>
                                                  <input type="text" class="form-control" id="celular_add" name="celular" placeholder="" onBlur="ponerMayusculas(this)">
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
                                                    <input type="text" class="form-control" id="ocupacion_add" name="ocupacion" placeholder="" onBlur="ponerMayusculas(this)">
                                                  </td>
                                                  <td>
                                                    <p>Cargo o Puesto que desempeña</p>
                                                    <input type="text" class="form-control" id="cargo_add" name="cargo" placeholder="" onBlur="ponerMayusculas(this)">
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <p>Empresa</p>
                                                    <input type="text" class="form-control" id="empresa_add" name="empresa" placeholder="" onBlur="ponerMayusculas(this)">
                                                  </td>
                                                  <td>
                                                    <p>Tel. Oficina</p>
                                                    <input type="text" class="form-control" id="tel_oficina_add" name="tel_oficina" placeholder="" onBlur="ponerMayusculas(this)">
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
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="button" name="btn_limpiar" onclick="limpiar()"><i class="fa fa-eraser"></i> <b>Limpiar</b></button>
                        <button class="btn btn-warning" type="submit" id="agregar_afiliado"  name="agregar_afiliado" value="1" onclick="return validar()"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> <b>Agregar</b></button>
                  </div>              
              </form>
            </div>
        </div>
    </div>