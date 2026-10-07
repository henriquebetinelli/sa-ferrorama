document.addEventListener('DOMContentLoaded', function () {
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const modalCadastroSensor = document.getElementById('modalCadastroSensor');
    const formularioCadastroSensor = document.getElementById('formularioCadastroSensor');
    const tituloModal = document.getElementById('modalCadastroSensorLabel');
    const botaoSalvarSensor =  document.getElementById('botaoSalvarSensor');
    const inputPesquisa = document.getElementById('inputPesquisa');
    const tabelaSensores = document.querySelector('#listaSensores tbody');
    const acaoSensor = document.getElementById('acaoSensor');

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', function () {
            formularioCadastroSensor.reset();
            document.getElementById('idSensor').value = '';
            acaoSensor.value = 'cadastrar';
            document.getElementById('alertaCamposSensor').hidden = true;

            tituloModal.textContent = 'Cadastrar sensor';
            botaoSalvarSensor.textContent = 'Cadastrar';
            bootstrap.Modal.getOrCreateInstance(modalCadastroSensor).show();
        });
    }

    if (inputPesquisa && tabelaSensores) {
        inputPesquisa.addEventListener('input', function () {
            const pesquisa = inputPesquisa.value.toLowerCase();
            const linhas = tabelaSensores.querySelectorAll('tr');
            linhas.forEach(function (linha) {
                const texto = linha.textContent.toLowerCase();
                linha.style.display = texto.includes(pesquisa) ? '' : 'none';
            });
        });
    }

    if (formularioCadastroSensor) {
        formularioCadastroSensor.addEventListener(
            'submit',
            function (event) {
                const nome = document.getElementById('nomeSensor').value.trim();
                const localizacao = document.getElementById('localizacaoSensor').value.trim();
                const tipo = document.getElementById('tipoSensor').value.trim();
                const trem = document.getElementById('tremSensor').value;
                const alerta = document.getElementById('alertaCamposSensor');

                if (nome === '' || localizacao === '' || tipo === '' || trem === '') {
                    event.preventDefault();
                    alerta.hidden = false;
                    return;
                }
                alerta.hidden = true;
            }
        );
    }
});

function abrirEdicao(sensor) {
    const modalCadastroSensor = document.getElementById('modalCadastroSensor');
    
    document.getElementById('idSensor').value = sensor.id;
    document.getElementById('nomeSensor').value = sensor.nome;
    document.getElementById('tipoSensor').value = sensor.tipo_dado;
    document.getElementById('tremSensor').value = sensor.id_trem;
    document.getElementById('localizacaoSensor').value = sensor.localizacao;
    document.getElementById('descricaoSensor').value = sensor.descricao || '';
    document.getElementById('acaoSensor').value = 'editar';

    document.getElementById('modalCadastroSensorLabel').textContent = 'Editar Sensor';
    document.getElementById('botaoSalvarSensor').textContent = 'Salvar alterações';
    document.getElementById('alertaCamposSensor').hidden = true;

    bootstrap.Modal.getOrCreateInstance(modalCadastroSensor).show();
}

function abrirExclusao(idSensor, nomeSensor) {
    document.getElementById('idSensorExclusao').value = idSensor;
    document.getElementById('nomeExcluirSensor').textContent = nomeSensor;
    const modalExcluirSensor = document.getElementById('modalExcluirSensor');
    bootstrap.Modal.getOrCreateInstance(modalExcluirSensor).show();
}

const tipoSensor = document.getElementById('tipoSensor');
const campoLimite = document.getElementById('campoLimite');
const campoLocalizacao = document.getElementById('campoLocalizacao');
const unidadeSensor = document.getElementById('unidadeSensor');

tipoSensor.addEventListener('change', function () {
    if (this.value === 'velocidade') {
        tituloLimite.textContent = 'Limite máximo';
    }

    if (this.value === 'temperatura') {
        tituloLimite.textContent = 'Limite máximo';
    }

    if (this.value === 'vibração') {
        tituloLimite.textContent = 'Limite máximo';
    }

    if (this.value === 'proximidade') {
        tituloLimite.textContent = 'Distância mínima';
    }

    if (this.value === 'localização') {
        tituloLimite.textContent = 'Posição na rota';
    }
});