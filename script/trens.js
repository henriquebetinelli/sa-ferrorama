document.addEventListener('DOMContentLoaded', function () {
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const modalCadastroTrem = document.getElementById('modalCadastroTrem');
    const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');
    const tituloModal = document.getElementById('modalCadastroTremLabel');
    const botaoSalvarTrem = document.getElementById('botaoSalvarTrem');
    const inputPesquisa = document.getElementById('inputPesquisa');
    const tabelaTrens = document.querySelector('#listaTrens tbody');
    const acaoTrem = document.getElementById('acaoTrem');
    const formularioIniciarRota = document.getElementById('formularioIniciarRota');
    const tremRota = document.getElementById('tremRota');
    const rotaTrem = document.getElementById('rotaTrem');

    const atualizarInicioPrevisto = () => {
        const campo = document.getElementById('inicioPrevistoRota');
        if (!campo) return;

        const agora = new Date();
        const data = agora.toLocaleDateString('pt-BR');
        const horario = agora.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        campo.textContent = `${data} às ${horario}`;
    };

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', function () {
            formularioCadastroTrem.reset();

            document.getElementById('idTrem').value = '';
            acaoTrem.value = 'cadastrar';
            document.getElementById('alertaCamposTrem').hidden = true;
            tituloModal.textContent = 'Cadastrar trem';
            botaoSalvarTrem.textContent = 'Cadastrar';

            bootstrap.Modal.getOrCreateInstance(modalCadastroTrem).show();
        });
    }

    if (inputPesquisa && tabelaTrens) {
        inputPesquisa.addEventListener('input', function () {
            const pesquisa = inputPesquisa.value.toLowerCase();
            const linhas = tabelaTrens.querySelectorAll('tr');

            linhas.forEach(function (linha) {
                const texto = linha.textContent.toLowerCase();

                linha.style.display = texto.includes(pesquisa) ? '' : 'none';
            });
        });
    }

    if (formularioCadastroTrem) {
        formularioCadastroTrem.addEventListener('submit', function (event) {
            const nome = document.getElementById('nomeTrem').value.trim();
            const modelo = document.getElementById('modeloTrem').value.trim();
            const alerta = document.getElementById('alertaCamposTrem');

            if (nome === '' || modelo === '') {
                event.preventDefault();
                alerta.hidden = false;
            } else {
                alerta.hidden = true;
            }
        });
    }

    if (formularioIniciarRota) {
        formularioIniciarRota.addEventListener('submit', function (event) {
            const alerta = document.getElementById('alertaCamposRota');
            const tremSelecionado = tremRota ? tremRota.value : '';
            const rotaSelecionada = rotaTrem ? rotaTrem.value : '';

            if (!tremSelecionado || !rotaSelecionada) {
                event.preventDefault();
                alerta.hidden = false;
                return;
            }

            alerta.hidden = true;
        });
    }

    atualizarInicioPrevisto();
});

function abrirEdicao(trem) {
    const modalCadastroTrem = document.getElementById('modalCadastroTrem');
    const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');

    document.getElementById('idTrem').value = trem.id;
    document.getElementById('nomeTrem').value = trem.nome;
    document.getElementById('modeloTrem').value = trem.modelo;
    document.getElementById('operadorResponsavel').value = trem.id_operador;

    document.getElementById('acaoTrem').value = 'editar';
    document.getElementById('modalCadastroTremLabel').textContent = 'Editar trem';
    document.getElementById('botaoSalvarTrem').textContent = 'Salvar alterações';

    bootstrap.Modal.getOrCreateInstance(modalCadastroTrem).show();
}

function abrirExclusao(idTrem, nomeTrem) {
    document.getElementById('idTremExclusao').value = idTrem;
    document.getElementById('nomeExcluirTrem').textContent = nomeTrem;

    const modalExcluirTrem = document.getElementById('modalExcluirTrem');

    bootstrap.Modal.getOrCreateInstance(modalExcluirTrem).show();
}

function iniciarRota(idTrem) {
    const modalIniciarRota = document.getElementById('modalIniciarRota');
    const tremRota = document.getElementById('tremRota');
    const rotaTrem = document.getElementById('rotaTrem');
    const alerta = document.getElementById('alertaCamposRota');
    const campoInicio = document.getElementById('inicioPrevistoRota');

    if (!modalIniciarRota || !tremRota || !rotaTrem) {
        return;
    }

    tremRota.value = String(idTrem || '');
    rotaTrem.value = '';

    if (alerta) {
        alerta.hidden = true;
    }

    if (campoInicio) {
        const agora = new Date();
        const data = agora.toLocaleDateString('pt-BR');
        const horario = agora.toLocaleTimeString('pt-BR', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        campoInicio.textContent = `${data} às ${horario}`;
    }

    bootstrap.Modal.getOrCreateInstance(modalIniciarRota).show();
}