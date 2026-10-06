document.addEventListener('DOMContentLoaded', function () {
    const modalCadastro = document.getElementById('modalCadastro');
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const formularioCadastro = document.getElementById('formularioCadastro');
    const botaoExcluir = document.getElementById('botaoExcluir');
    const botaoSalvarColaborador = document.getElementById('botaoSalvarColaborador');
    const alertaCamposColaborador = document.getElementById('alertaCamposColaborador');


    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', function () {
            formularioCadastro.reset();
            document.getElementById('idUsuario').value = '';
            document.getElementById('acaoColaborador').value = 'cadastrar';
            document.getElementById('modalCadastroLabel').textContent = 'Cadastrar Colaborador';
            botaoSalvarColaborador.textContent = 'Cadastrar';
            alertaCamposColaborador.hidden = true;

            bootstrap.Modal.getOrCreateInstance(modalCadastro).show();
        });
    }

    if (formularioCadastro) {
        formularioCadastro.addEventListener('submit', function (event) {
            const idUsuario = document.getElementById('idUsuario').value;
            const camposObrigatorios = [
                'nome',
                'cpf',
                'dataNascimento',
                'genero',
                'telefone',
                'email',
                'cargo',
                'cep'
            ];

            let algumCampoVazio = camposObrigatorios.some(function (id) {
                return document.getElementById(id).value.trim() === '';
            });

            if (idUsuario === '' && document.getElementById('senha').value.trim() === '') {
                algumCampoVazio = true;
            }

            if (algumCampoVazio) {
                event.preventDefault();
                alertaCamposColaborador.hidden = false;
                return;
            }

            alertaCamposColaborador.hidden = true;
        });
    }

    if (botaoExcluir) {
        botaoExcluir.addEventListener('click', function () {
            const idUsuario = document.getElementById('idUsuarioExcluir').value;

            const formularioExclusao = document.createElement('form');
            formularioExclusao.method = 'POST';
            formularioExclusao.action = '../controllers/colaboradores.php';

            const campoAcao = document.createElement('input');
            campoAcao.type = 'hidden';
            campoAcao.name = 'acao';
            campoAcao.value = 'excluir';

            const campoIdUsuario = document.createElement('input');
            campoIdUsuario.type = 'hidden';
            campoIdUsuario.name = 'id_usuario';
            campoIdUsuario.value = idUsuario;

            formularioExclusao.appendChild(campoAcao);
            formularioExclusao.appendChild(campoIdUsuario);
            document.body.appendChild(formularioExclusao);
            formularioExclusao.submit();
        });
    }
});

function abrirEdicao(colaborador) {
    document.getElementById('idUsuario').value = colaborador.id;
    document.getElementById('nome').value = colaborador.nome;
    document.getElementById('cpf').value = colaborador.cpf;
    document.getElementById('dataNascimento').value = colaborador.dataNascimento;
    document.getElementById('genero').value = colaborador.genero;
    document.getElementById('telefone').value = colaborador.telefone;
    document.getElementById('email').value = colaborador.email;
    document.getElementById('cargo').value = colaborador.cargo;
    document.getElementById('cep').value = colaborador.cep;
    document.getElementById('senha').value = '';

    document.getElementById('acaoColaborador').value = 'editar';
    document.getElementById('modalCadastroLabel').textContent = 'Editar Colaborador';
    document.getElementById('botaoSalvarColaborador').textContent = 'Salvar alterações';
    document.getElementById('alertaCamposColaborador').hidden = true;
    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalCadastro'));
    modal.show();
}

function abrirExclusao(idUsuario, nomeUsuario) {
    document.getElementById('idUsuarioExcluir').value = idUsuario;
    document.getElementById('nomeColaboradorExcluir').textContent = nomeUsuario;
    const modalExcluir = document.getElementById('modalExcluir');
    bootstrap.Modal.getOrCreateInstance(modalExcluir).show();
}