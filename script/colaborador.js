document.addEventListener('DOMContentLoaded', function () {
    const modalCadastro = document.getElementById('modalCadastro');
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const formularioCadastro = document.getElementById('formularioCadastro');
    const botaoExcluir = document.getElementById('botaoExcluir');
    const botaoSalvarColaborador = document.getElementById('botaoSalvarColaborador');
    const alertaCamposColaborador = document.getElementById('alertaCamposColaborador');

    const tituloPadrao = 'Cadastrar Colaborador';

    function definirTituloModal(titulo) {
        const tituloElemento = document.querySelector('#modalCadastroLabel');
        if (tituloElemento) {
            tituloElemento.textContent = titulo;
        }
    }

    function definirTextoBotao(texto) {
        if (botaoSalvarColaborador) {
            botaoSalvarColaborador.textContent = texto;
        }
    }

    function esconderAlerta() {
        alertaCamposColaborador.hidden = true;
    }

    function abrirModalCadastro() {
        if (!modalCadastro) return;

        if (formularioCadastro) {
            formularioCadastro.reset();
        }

        esconderAlerta();
        formularioCadastro.action = '../controllers/usuario/salvarUsuario.php';
        document.getElementById('idUsuario').value = '';
        definirTituloModal(tituloPadrao);
        definirTextoBotao('Cadastrar');

        const modal = bootstrap.Modal.getOrCreateInstance(modalCadastro);
        modal.show();
    }

    if (botaoCadastrar) {
        botaoCadastrar.addEventListener('click', abrirModalCadastro);
    }

    if (formularioCadastro) {
        formularioCadastro.addEventListener('submit', function (event) {
            event.preventDefault();

            const idUsuario = document.getElementById('idUsuario').value;
            const campos = formularioCadastro.querySelectorAll('input:not([type="hidden"])');
            const algumCampoVazio = Array.from(campos).some(function (campo) {
                if (idUsuario !== '' && campo.id === 'senha') {
                    return false;
                }
                return campo.value.trim() === '';
            });

            if (algumCampoVazio) {
                alertaCamposColaborador.hidden = false;
                return;
            }

            esconderAlerta();
            bootstrap.Modal.getOrCreateInstance(modalCadastro).hide();
            formularioCadastro.submit();
        });
    }

    if (botaoExcluir) {
        botaoExcluir.addEventListener('click', function () {
            const idUsuario = document.getElementById('idUsuarioExcluir').value;
            const formularioExclusao = document.createElement('form');
            const campoIdUsuario = document.createElement('input');
            formularioExclusao.method = 'POST';
            formularioExclusao.action = '../controllers/usuario/excluirUsuario.php';
            campoIdUsuario.name = 'id_usuario';
            campoIdUsuario.value = idUsuario;
            formularioExclusao.appendChild(campoIdUsuario);
            document.body.appendChild(formularioExclusao);
            formularioExclusao.submit();
        });
    }

});

window.abrirEdicao = async function (idColaborador) {
    const modalCadastro = document.getElementById('modalCadastro');
    const formularioCadastro = document.getElementById('formularioCadastro');

    if (!modalCadastro || !formularioCadastro) {
        return;
    }

    try {
        const resposta = await fetch(`../controllers/usuario/buscarUsuario.php?id=${encodeURIComponent(idColaborador)}`);
        const colaborador = await resposta.json();

        if (!resposta.ok) {
            throw new Error(colaborador.erro || 'Não foi possível carregar o colaborador.');
        }

        formularioCadastro.reset();
        document.getElementById('alertaCamposColaborador').hidden = true;
        document.getElementById('idUsuario').value = colaborador.id_usuario;
        formularioCadastro.action = '../controllers/usuario/atualizarUsuario.php';

        const campos = {
            nome: colaborador.nome_usuario,
            cpf: colaborador.cpf,
            dataNascimento: colaborador.data_nascimento,
            genero: colaborador.genero,
            telefone: colaborador.telefone,
            email: colaborador.email,
            cargo: colaborador.cargo,
            cep: colaborador.cep
        };

        Object.entries(campos).forEach(function ([campo, valor]) {
            const input = document.getElementById(campo);
            if (input) {
                input.value = valor ?? '';
            }
        });

        const tituloElemento = document.querySelector('#modalCadastroLabel');
        if (tituloElemento) {
            tituloElemento.textContent = `Editar Colaborador ${colaborador.id_usuario}`;
        }

        const botaoSalvarColaborador = document.getElementById('botaoSalvarColaborador');
        if (botaoSalvarColaborador) {
            botaoSalvarColaborador.textContent = 'Editar';
        }

        const modal = bootstrap.Modal.getOrCreateInstance(modalCadastro);
        modal.show();
    } catch (erro) {
        alert(erro.message || 'Não foi possível carregar o colaborador.');
    }

};

window.abrirExclusao = function (idUsuario) {
    document.getElementById('idUsuarioExcluir').value = idUsuario;

    const modalExcluir = document.getElementById('modalExcluir');
    bootstrap.Modal.getOrCreateInstance(modalExcluir).show();
};
