document.addEventListener('DOMContentLoaded', function () {

    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const formularioRota = document.getElementById('formularioRota');
    const botaoExcluirRota = document.getElementById('botaoExcluirRota');

    if (botaoCadastrar) {

        botaoCadastrar.addEventListener('click', function () {

            formularioRota.reset();

            document.getElementById('acaoRota').value = 'cadastrar';
            document.getElementById('idRota').value = '';

            document.getElementById('modalCadastroRotaLabel').textContent =
                'Cadastrar Rota';

            document.getElementById('botaoSalvarRota').textContent =
                'Cadastrar';

            document.getElementById('alertaCamposRota').hidden = true;

            const modal = bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalCadastroRota')
            );

            modal.show();
        });
    }

    if (formularioRota) {

        formularioRota.addEventListener('submit', function (event) {

            const nome = document
                .getElementById('nomeRota')
                .value
                .trim();

            if (nome === '') {

                event.preventDefault();

                document.getElementById('alertaCamposRota').hidden = false;

                return;
            }

            document.getElementById('alertaCamposRota').hidden = true;
        });
    }

    if (botaoExcluirRota) {

        botaoExcluirRota.addEventListener('click', function () {

            const idRota = document.getElementById('idRotaExcluir').value;

            const formulario = document.createElement('form');

            formulario.method = 'POST';
            formulario.action = '../controllers/rotas.php';

            const campoAcao = document.createElement('input');

            campoAcao.type = 'hidden';
            campoAcao.name = 'acao';
            campoAcao.value = 'excluir';

            const campoId = document.createElement('input');

            campoId.type = 'hidden';
            campoId.name = 'id_rota';
            campoId.value = idRota;

            formulario.appendChild(campoAcao);
            formulario.appendChild(campoId);

            document.body.appendChild(formulario);

            formulario.submit();
        });
    }

    const inputPesquisa = document.getElementById('inputPesquisa');

    if (inputPesquisa) {
        inputPesquisa.addEventListener('input', function () {
            const termo = this.value.trim().toLowerCase();
            const tabela = document.querySelector('#listaRotas table');
            if (!tabela) return;
            const linhas = tabela.querySelectorAll('tbody tr');
            let encontrou = false;

            linhas.forEach(function (linha) {
                const colNome = linha.cells[1];
                if (!colNome) return;
                const texto = colNome.textContent.trim().toLowerCase();
                if (texto.indexOf(termo) !== -1) {
                    linha.style.display = '';
                    encontrou = true;
                } else {
                    linha.style.display = 'none';
                }
            });
            const mensagemVazia = document.getElementById('mensagemVazia');
            if (mensagemVazia) {
                if (termo !== '' && !encontrou) {
                    mensagemVazia.style.display = '';
                } else {
                    mensagemVazia.style.display = 'none';
                }
            }
        });
    }
});


function abrirEdicaoRota(id, nome, descricao) {

    document.getElementById('idRota').value = id;

    document.getElementById('nomeRota').value = nome;

    document.getElementById('descricaoRota').value = descricao;

    document.getElementById('acaoRota').value = 'editar';

    document.getElementById('modalCadastroRotaLabel').textContent =
        'Editar Rota';

    document.getElementById('botaoSalvarRota').textContent =
        'Salvar alterações';

    document.getElementById('alertaCamposRota').hidden = true;

    const modal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalCadastroRota')
    );

    modal.show();
}


function abrirExclusaoRota(id, nome) {

    document.getElementById('idRotaExcluir').value = id;

    document.getElementById('nomeRotaExcluir').textContent = nome;

    const modal = bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalExcluirRota')
    );

    modal.show();
}