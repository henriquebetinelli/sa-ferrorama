document.addEventListener('DOMContentLoaded', function () {
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const modalCadastroTrem = document.getElementById('modalCadastroTrem');
    const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');
    const tituloModal = document.getElementById('modalCadastroTremLabel');
    const botaoSalvarTrem = document.getElementById('botaoSalvarTrem');
    const inputPesquisa = document.getElementById('inputPesquisa');
    const tabelaTrens = document.querySelector('#listaTrens tbody');

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', function () {
            formularioCadastroTrem.reset();

            document.getElementById('idTrem').value = '';
            document.getElementById('alertaCamposTrem').hidden = true;

            tituloModal.textContent = 'Cadastrar trem';
            botaoSalvarTrem.textContent = 'Cadastrar';

            formularioCadastroTrem.action = '../controllers/trens/salvarTrem.php';

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
});

function abrirEdicao(trem) {
    const modalCadastroTrem = document.getElementById('modalCadastroTrem');
    const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');

    document.getElementById('idTrem').value = trem.id;
    document.getElementById('nomeTrem').value = trem.nome;
    document.getElementById('modeloTrem').value = trem.modelo;

    document.getElementById('modalCadastroTremLabel').textContent = 'Editar trem';
    document.getElementById('botaoSalvarTrem').textContent = 'Salvar alterações';

    formularioCadastroTrem.action = '../controllers/trens/atualizarTrem.php';

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

    if (!modalIniciarRota || !tremRota) {
        return;
    }

    tremRota.value = idTrem;

    bootstrap.Modal.getOrCreateInstance(modalIniciarRota).show();
}