                            <!-- Modal -->
                            <div class="modal fade" id="form-cliente" tabindex="-1" role="dialog" aria-labelledby="model-8"
                                 aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">

                                <!-- Modal Content -->
                                <div class="modal-content">
                                  <form action="modulos/ventas/clientes_guardar3.php" method="POST" name="cliente">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="model-8">Nuevo Cliente</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <!-- /modal header -->

                                    <!-- Modal Body -->

                                    <div class="modal-body">
                                      
                                        <div class="form-group">
                                          <label for="ruc" class="col-form-label">RUC:</label>
                                          <input class="form-control" name="ruc" id="ruc" type="text" required>
                                        </div>
                                        <div id="resultado"></div>
                                      
                                    </div>
                                    <!-- /modal body -->

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                      <input type="button" class="btn btn-primary btn-sm" value="Guardar" href="javascript:;" onclick="Cliente($('#ruc').val());">
                                    </div>
                                    <!-- /modal footer -->
                                  </form>
                                </div>
                                <!-- /modal content -->

                              </div>
                            </div>
                            <!-- /modal -->
                            <script>
                              function Cliente(ruc) {
                                var parametros = {"ruc":ruc};
                                $.ajax({
                                  data:parametros,
                                  url:'/modulos/ventas/clientes_guardar3.php',
                                  type: 'post',
                                  beforeSend: function () {
                                      $("#resultado").html("Procesando, espere por favor");
                                  },
                                  success: function (response) {
                                      $("#resultado").html(response);
                                  }
                                });
                              }
                            </script>