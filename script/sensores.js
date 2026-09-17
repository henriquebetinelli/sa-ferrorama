document.addEventListener('DOMContentLoaded', function () {
    const modalCadastro = document.getElementById('modalCadastro');
    const modalExcluir = document.getElementById('modalExcluir');

    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const botaoExcluir = document.getElementById('botaoExcluir');
    const botaoSalvarSensor = document.getElementById('botaoSalvarSensor');

    const formularioCadastro = document.getElementById('formularioCadastro');
    const tituloPadrao = 'Cadastrar Sensor';

    function definirTituloModal(titulo) {
        const tituloElemento = document.querySelector('#modalCadastroLabel');
        if (tituloElemento) {
            tituloElemento.textContent = titulo;
        }
    }

    function definirTextoBotao(texto) {
        if (botaoSalvarSensor) {
            botaoSalvarSensor.textContent = texto;
        }
    }

    function abrirModalCadastro() {
        if (!modalCadastro) return;

        if (formularioCadastro) {
            formularioCadastro.reset();
        }

        definirTituloModal(tituloPadrao);
        definirTextoBotao('Cadastrar');
        bootstrap.Modal.getOrCreateInstance(modalCadastro).show();
    }

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', abrirModalCadastro);
    }

    if (formularioCadastro) {
        formularioCadastro.addEventListener('submit', function (event) {
            event.preventDefault();

            const tituloAtual = document.querySelector('#modalCadastroLabel')?.textContent || '';

            const modal = bootstrap.Modal.getInstance(modalCadastro);
            if (modal) {
                modal.hide();
            }

            formularioCadastro.reset();
            definirTituloModal(tituloPadrao);
            definirTextoBotao('Cadastrar');
        });
    }

    if (botaoExcluir) {
        botaoExcluir.addEventListener('click', function () {
            const modal = bootstrap.Modal.getInstance(modalExcluir);
            if (modal) {
                modal.hide();
            }
        });
    }

    const inputPesquisa = document.getElementById('inputPesquisa');
    const mensagemVazia = document.getElementById('mensagemVazia');

    if (inputPesquisa && mensagemVazia) {
        inputPesquisa.addEventListener('keyup', function () {
            const pesquisa = inputPesquisa.value.toLowerCase();
            const sensores = document.querySelectorAll('#listaSensores tbody tr');
            let encontrados = 0;

            sensores.forEach(function (sensor) {
                const nome = sensor.cells[0]?.textContent.trim().toLowerCase() || '';

                if (nome.includes(pesquisa)) {
                    sensor.style.display = 'table-row';
                    encontrados++;
                } else {
                    sensor.style.display = 'none';
                }
            });

            mensagemVazia.style.display = encontrados === 0 ? 'block' : 'none';
        });
    }
});

window.abrirEdicao = function (idSensor, nome, codigo, tipo) {
    const modalCadastro = document.getElementById('modalCadastro');
    const formularioCadastro = document.getElementById('formularioCadastro');

    if (!modalCadastro || !formularioCadastro) {
        return;
    }

    formularioCadastro.reset();
    document.getElementById('nomeSensor').value = nome;
    document.getElementById('numeroSerie').value = codigo;
    document.getElementById('tipoSensor').value = tipo;

    const tituloElemento = document.querySelector('#modalCadastroLabel');
    if (tituloElemento) {
        tituloElemento.textContent = `Editar Sensor ${idSensor}`;
    }

    const botaoSalvarSensor = document.getElementById('botaoSalvarSensor');
    if (botaoSalvarSensor) {
        botaoSalvarSensor.textContent = 'Editar';
    }

    bootstrap.Modal.getOrCreateInstance(modalCadastro).show();
};

window.abrirExclusao = function (nome) {
    const nomeExcluir = document.getElementById('nomeExcluir');
    const modalExcluir = document.getElementById('modalExcluir');

    if (!nomeExcluir || !modalExcluir) {
        return;
    }

    nomeExcluir.textContent = nome;
    bootstrap.Modal.getOrCreateInstance(modalExcluir).show();
};