<div class="modal fade"
        id="modalCadastro"
        tabindex="-1"
        aria-labelledby="modalCadastroLabel"
        aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-cadastro">
        <div class="modal-content conteudo-modal">

            <div class="modal-header">
                <h2 id="modalCadastroLabel" class="modal-title fs-4 fw-bold">
                    Cadastrar Sensor
                </h2>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar">
                </button>
            </div>

            <div class="modal-body">
                <form id="formularioCadastro">

                        <div class="mb-3">

                            <label for="nomeSensor"
                                class="form-label">
                                Nome do sensor
                            </label>

                            <input type="text"
                                class="form-control"
                                id="nomeSensor"
                                name="nome_sensor"
                                placeholder="ex. Acelerômetro"
                                required>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label for="tipoSensor"
                                    class="form-label">
                                    Tipo
                                </label>

                                <input type="text"
                                    class="form-control"
                                    id="tipoSensor"
                                    name="tipo_sensor"
                                    placeholder="ex. Movimento"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label for="numeroSerie"
                                    class="form-label">
                                    Número de série
                                </label>

                                <input type="text"
                                    class="form-control"
                                    id="numeroSerie"
                                    name="numero_serie"
                                    placeholder="ex. ACC-001"
                                    required>

                            </div>

                        </div>


                        <div class="mb-3">

                            <label for="descricaoSensor"
                                class="form-label">
                                Descrição
                            </label>

                            <textarea
                                class="form-control"
                                id="descricaoSensor"
                                name="descricao"
                                rows="3"
                                placeholder="Descrição do sensor"></textarea>

                        </div>


                        <button type="submit"
                            class="btn botao-cadastrar w-100"
                            id="botaoSalvarSensor">
                            Cadastrar
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>