document.addEventListener('DOMContentLoaded', function () {
    const modalCadastro = document.getElementById('modalCadastro');
    const modalExcluir = document.getElementById('modalExcluir');

    const botaoCadastrar = document.getElementById('botaoCadastrar');
    const botaoExcluir = document.getElementById('botaoExcluir');
    const botaoSalvarRota = document.getElementById('botaoSalvarRota');
    const alertaCamposRota = document.getElementById('alertaCamposRota');

    const formularioCadastro = document.getElementById('formularioCadastro');
    const nomeRota = document.getElementById('nomeRota');
    const codigoRota = document.getElementById('codigoRota');
    const descricaoRota = document.getElementById('descricaoRota');
    const tituloPadrao = 'Cadastrar Rota';

    function esconderAlerta() {
        if (alertaCamposRota) {
            alertaCamposRota.hidden = true;
        }
    }

    function definirTituloModal(titulo) {
        const tituloElemento = document.querySelector('#modalCadastroLabel');
        if (tituloElemento) {
            tituloElemento.textContent = titulo;
        }
    }

    function definirTextoBotao(texto) {
        if (botaoSalvarRota) {
            botaoSalvarRota.textContent = texto;
        }
    }

    function abrirModalCadastro() {
        if (!modalCadastro) return;

        if (formularioCadastro) {
            formularioCadastro.reset();
        }

        esconderAlerta();
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

            const nome = nomeRota.value.trim();
            const codigo = codigoRota.value.trim();
            const descricao = descricaoRota.value.trim();

            if (!nome || !codigo || !descricao) {
                if (alertaCamposRota) {
                    alertaCamposRota.hidden = false;
                }
                return;
            }

            esconderAlerta();
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

    [nomeRota, codigoRota, descricaoRota].forEach(function (campo) {
        if (campo) {
            campo.addEventListener('input', esconderAlerta);
        }
    });

    const inputPesquisa = document.getElementById('inputPesquisa');
    const mensagemVazia = document.getElementById('mensagemVazia');

    if (inputPesquisa && mensagemVazia) {
        inputPesquisa.addEventListener('keyup', function () {
            const pesquisa = inputPesquisa.value.toLowerCase();
            const rotas = document.querySelectorAll('#listaRotas tbody tr');
            let encontrados = 0;

            rotas.forEach(function (rota) {
                const nome = rota.cells[1]?.textContent.trim().toLowerCase() || '';

                if (nome.includes(pesquisa)) {
                    rota.style.display = 'table-row';
                    encontrados++;
                } else {
                    rota.style.display = 'none';
                }
            });

            mensagemVazia.style.display = encontrados === 0 ? 'block' : 'none';
        });
    }
});

window.abrirEdicao = function (idRota, nome, codigo, descricao) {
    const modalCadastro = document.getElementById('modalCadastro');
    const formularioCadastro = document.getElementById('formularioCadastro');

    if (!modalCadastro || !formularioCadastro) {
        return;
    }

    formularioCadastro.reset();
    document.getElementById('nomeRota').value = nome;
    document.getElementById('codigoRota').value = codigo;
    document.getElementById('descricaoRota').value = descricao;

    const tituloElemento = document.querySelector('#modalCadastroLabel');
    if (tituloElemento) {
        tituloElemento.textContent = `Editar Rota ${idRota}`;
    }

    const botaoSalvarRota = document.getElementById('botaoSalvarRota');
    if (botaoSalvarRota) {
        botaoSalvarRota.textContent = 'Editar';
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