document.addEventListener('DOMContentLoaded', function () {
    const modalCadastro = document.getElementById('modalCadastro');
    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const formularioCadastro = document.getElementById('formularioCadastro');
    const botaoExcluir = document.getElementById('botaoExcluir');
    const botaoSalvarColaborador = document.getElementById('botaoSalvarColaborador');

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

    function abrirModalCadastro() {
        if (!modalCadastro) return;

        if (formularioCadastro) {
            formularioCadastro.reset();
        }

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

            const tituloAtual = document.querySelector('#modalCadastroLabel')?.textContent || '';
            const modo = tituloAtual.includes('Editar') ? 'edicao' : 'cadastro';

            if (modo === 'cadastro') {
                alert('Colaborador cadastrado!');
            } else {
                alert('Colaborador atualizado!');
            }

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
            alert('Colaborador excluído.');

            const modalExcluir = document.getElementById('modalExcluir');
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
            const colaboradores = document.querySelectorAll('.colaborador');
            let encontrados = 0;

            colaboradores.forEach(function (colaborador) {
                const nome = colaborador.querySelector('.colaborador-nome')?.textContent.toLowerCase() || '';

                if (nome.includes(pesquisa)) {
                    colaborador.style.display = 'flex';
                    encontrados++;
                } else {
                    colaborador.style.display = 'none';
                }
            });

            mensagemVazia.style.display = encontrados === 0 ? 'block' : 'none';
        });
    }
});

window.abrirEdicao = function (idColaborador, nome, cpf, data, genero, telefone, email, cargo, cep) {
    const modalCadastro = document.getElementById('modalCadastro');
    const formularioCadastro = document.getElementById('formularioCadastro');

    if (!modalCadastro || !formularioCadastro) {
        return;
    }

    formularioCadastro.reset();

    const campos = {
        nome: nome,
        cpf: cpf,
        dataNascimento: data,
        genero: genero,
        telefone: telefone,
        email: email,
        cargo: cargo,
        cep: cep
    };

    Object.entries(campos).forEach(function ([campo, valor]) {
        const input = document.getElementById(campo);
        if (input) {
            input.value = valor;
        }
    });

    const tituloElemento = document.querySelector('#modalCadastroLabel');
    if (tituloElemento) {
        tituloElemento.textContent = `Editar Colaborador ${idColaborador}`;
    }

    if (botaoSalvarColaborador) {
        botaoSalvarColaborador.textContent = 'Editar';
    }

    const modal = bootstrap.Modal.getOrCreateInstance(modalCadastro);
    modal.show();
};

window.abrirExclusao = function (nome) {
    const nomeExcluir = document.getElementById('nomeExcluir');
    if (nomeExcluir) {
        nomeExcluir.textContent = nome;
    }

    const modalExcluir = document.getElementById('modalExcluir');
    if (modalExcluir) {
        const modal = bootstrap.Modal.getOrCreateInstance(modalExcluir);
        modal.show();
    }
};
