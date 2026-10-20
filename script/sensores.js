function atualizarLabelLimite(tipo) {
    const tituloLimite = document.getElementById('tituloLimite');

    if (!tituloLimite) {
        return;
    }

    if (tipo === 'proximidade') {
        tituloLimite.textContent = 'Distância mínima';
        return;
    }

    if (tipo === 'localização') {
        tituloLimite.textContent = 'Posição na rota';
        return;
    }

    tituloLimite.textContent = 'Limite máximo';
}

function atualizarTituloAnexado(valorSelecionadoPadrao) {
    const localizacaoSensor = document.getElementById('localizacaoSensor');
    const tituloAnexado = document.getElementById('tremSensorLabel');
    const selectAnexado = document.getElementById('tremSensor');

    if (!localizacaoSensor || !tituloAnexado || !selectAnexado) {
        return;
    }

    const ehRota = ['vagao', 'rota'].includes(localizacaoSensor.value);
    tituloAnexado.textContent = ehRota ? 'Rota' : 'Trem';
    selectAnexado.name = ehRota ? 'id_rota' : 'id_trem';

    const opcoes = ehRota ? opcoesRotas : opcoesTrens;
    const valorAtual = valorSelecionadoPadrao || selectAnexado.value || '';

    selectAnexado.innerHTML = '<option value=""></option>' + opcoes
        .map(function (item) {
            return '<option value="' + item.id + '">' + item.nome + '</option>';
        })
        .join('');

    if (valorAtual) {
        const encontrado = opcoes.some(function (item) {
            return String(item.id) === String(valorAtual);
        });

        selectAnexado.value = encontrado ? valorAtual : '';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const modalCadastroSensor = document.getElementById('modalCadastroSensor');
    const formularioCadastroSensor = document.getElementById('formularioCadastroSensor');
    const tituloModal = document.getElementById('modalCadastroSensorLabel');
    const botaoSalvarSensor =  document.getElementById('botaoSalvarSensor');
    const inputPesquisa = document.getElementById('inputPesquisa');
    const tabelaSensores = document.querySelector('#listaSensores tbody');
    const acaoSensor = document.getElementById('acaoSensor');
    const localizacaoSensor = document.getElementById('localizacaoSensor');
    const botoesEditar = document.querySelectorAll('[data-acao="editar"]');

    botoesEditar.forEach(function (botao) {
        botao.addEventListener('click', function () {
            const sensor = {
                id: this.dataset.id,
                nome: this.dataset.nome || '',
                localizacao: this.dataset.localizacao || '',
                tipo_dado: this.dataset.tipoDado || '',
                descricao: this.dataset.descricao || '',
                limite: this.dataset.limite || '',
                id_trem: this.dataset.idTrem || '',
                id_rota: this.dataset.idRota || ''
            };

            abrirEdicao(sensor);
        });
    });

    if (localizacaoSensor) {
        localizacaoSensor.addEventListener('change', function () {
            atualizarTituloAnexado();
        });
        atualizarTituloAnexado();
    }

    if (tipoSensor && tituloLimite) {
        tipoSensor.addEventListener('change', function () {
            atualizarLabelLimite(this.value);
        });
    }

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', function () {
            formularioCadastroSensor.reset();
            document.getElementById('idSensor').value = '';
            acaoSensor.value = 'cadastrar';
            document.getElementById('alertaCamposSensor').hidden = true;

            tituloModal.textContent = 'Cadastrar sensor';
            botaoSalvarSensor.textContent = 'Cadastrar';
            atualizarTituloAnexado();
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

                    const ehRota = ['vagao', 'rota'].includes(localizacao);
                const anexoSelecionado = trem;

                if (nome === '' || localizacao === '' || tipo === '' || anexoSelecionado === '') {
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
    const localizacaoSensor = document.getElementById('localizacaoSensor');
    const tipoSensor = document.getElementById('tipoSensor');
    const valorAnexo = sensor.localizacao === 'vagao' || sensor.localizacao === 'rota'
        ? (sensor.id_rota || '')
        : (sensor.id_trem || '');

    document.getElementById('idSensor').value = sensor.id;
    document.getElementById('nomeSensor').value = sensor.nome || '';
    document.getElementById('descricaoSensor').value = sensor.descricao || '';
    document.getElementById('limiteSensor').value = sensor.limite || '';
    document.getElementById('acaoSensor').value = 'editar';

    if (tipoSensor) {
        tipoSensor.value = sensor.tipo_dado || '';
    }

    if (localizacaoSensor) {
        localizacaoSensor.value = sensor.localizacao || '';
    }

    atualizarLabelLimite(sensor.tipo_dado || '');
    atualizarTituloAnexado(valorAnexo);

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
const tituloLimite = document.getElementById('tituloLimite');
const campoLimite = document.getElementById('campoLimite');
const campoLocalizacao = document.getElementById('campoLocalizacao');
const unidadeSensor = document.getElementById('unidadeSensor');

