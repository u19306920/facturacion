                            <!-- Modal -->
                            <div class="modal fade" id="form-transportista" tabindex="-1" role="dialog" aria-labelledby="model-8"
                                 aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">

                                <!-- Modal Content -->
                                <div class="modal-content">
                                  <form action="modulos/almacen/transportistas_guardar3.php" method="POST" name="transportista">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="model-8">Nuevo Transportista</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <!-- /modal header -->

                                    <!-- Modal Body -->

                                    <div class="modal-body">
                                      
                                        <div class="form-group">
                                          <label for="ruc2" class="col-form-label">RUC:</label>
                                          <input class="form-control" name="ruc2" id="ruc2" type="text" required>
                                        </div>
                                        <div id="resultado2"></div>
                                      
                                    </div>
                                    <!-- /modal body -->

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                      <input type="button" class="btn btn-primary btn-sm" value="Guardar" href="javascript:;" onclick="Transportista($('#ruc2').val());">
                                    </div>
                                    <!-- /modal footer -->
                                  </form>
                                </div>
                                <!-- /modal content -->

                              </div>
                            </div>
                            <!-- /modal -->
                            <script>
                              function Transportista(ruc) {
                                var parametros = {"ruc2":ruc};
                                $.ajax({
                                  data:parametros,
                                  url:'/modulos/almacen/transportistas_guardar3.php',
                                  type: 'post',
                                  beforeSend: function () {
                                      $("#resultado2").html("Procesando, espere por favor");
                                  },
                                  success: function (response) {
                                      $("#resultado2").html(response);
                                  }
                                });
                              }
                            </script>