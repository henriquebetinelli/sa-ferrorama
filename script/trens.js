document.addEventListener('DOMContentLoaded', function () {
	const modalCadastroTrem = document.getElementById('modalCadastroTrem');
	const modalExcluirTrem = document.getElementById('modalExcluirTrem');
	const modalIniciarRota = document.getElementById('modalIniciarRota');

	const botaoCadastrar = document.getElementById('botaoCadastrar');
    const botaoSalvarTrem = document.getElementById('botaoSalvarTrem');
	const botaoExcluirTrem = document.getElementById('botaoExcluirTrem');

	const formularioIniciarRota = document.getElementById('formularioIniciarRota');
	const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');

	const tremRota = document.getElementById('tremRota');
	const rotaTrem = document.getElementById('rotaTrem');
    
	const tituloModal = document.getElementById('modalCadastroTremLabel');

	const alertaCamposTrem = document.getElementById('alertaCamposTrem');
    const alertaCamposRota = document.getElementById('alertaCamposRota');

	const nomeTrem = document.getElementById('nomeTrem');
	const modeloTrem = document.getElementById('modeloTrem');

	function esconderAlerta() {
		alertaCamposTrem.hidden = true;
	}

	function abrirModalCadastro() {
		formularioCadastroTrem.reset();
		esconderAlerta();
		tituloModal.textContent = 'Cadastrar trem';
		botaoSalvarTrem.textContent = 'Cadastrar';

		bootstrap.Modal.getOrCreateInstance(modalCadastroTrem).show();
	}

	if (botaoCadastrar) {
		botaoCadastrar.addEventListener('click', abrirModalCadastro);
	}

	if (formularioCadastroTrem) {
		formularioCadastroTrem.addEventListener('submit', function (event) {
			event.preventDefault();

			const nome = nomeTrem.value.trim();
			const modelo = modeloTrem.value.trim();

			if (!nome || !modelo) {
				alertaCamposTrem.hidden = false;
				return;
			}

			esconderAlerta();
			bootstrap.Modal.getInstance(modalCadastroTrem).hide();
		});
	}

	if (botaoExcluirTrem) {
		botaoExcluirTrem.addEventListener('click', function () {
			bootstrap.Modal.getInstance(modalExcluirTrem).hide();
		});
	}

	if (formularioIniciarRota) {
		formularioIniciarRota.addEventListener('submit', function (event) {
			event.preventDefault();

			if (!tremRota.value || !rotaTrem.value) {
				alertaCamposRota.hidden = false;
				return;
			}

			alertaCamposRota.hidden = true;
			bootstrap.Modal.getInstance(modalIniciarRota).hide();
		});
	}

	[nomeTrem, modeloTrem].forEach(function (campo) {
		campo.addEventListener('input', esconderAlerta);
	});

	[tremRota, rotaTrem].forEach(function (campo) {
		campo.addEventListener('change', function () {
			alertaCamposRota.hidden = true;
		});
	});
});

window.iniciarRota = function (tremSelecionado) {
	const modalIniciarRota = document.getElementById('modalIniciarRota');
	const formularioIniciarRota = document.getElementById('formularioIniciarRota');
	const tremRota = document.getElementById('tremRota');
	const alertaCamposRota = document.getElementById('alertaCamposRota');

	if (!modalIniciarRota || !formularioIniciarRota) {
		return;
	}

	formularioIniciarRota.reset();
	alertaCamposRota.hidden = true;
	tremRota.value = tremSelecionado || '';
	bootstrap.Modal.getOrCreateInstance(modalIniciarRota).show();
};

window.abrirEdicao = function (idTrem, nome, modelo) {
	const modalCadastroTrem = document.getElementById('modalCadastroTrem');
	const formularioCadastroTrem = document.getElementById('formularioCadastroTrem');
	const tituloModal = document.getElementById('modalCadastroTremLabel');
	const botaoSalvarTrem = document.getElementById('botaoSalvarTrem');

	if (!modalCadastroTrem || !formularioCadastroTrem) {
		return;
	}

	formularioCadastroTrem.reset();
	document.getElementById('alertaCamposTrem').hidden = true;
	document.getElementById('nomeTrem').value = nome;
	document.getElementById('modeloTrem').value = modelo;
	tituloModal.textContent = `Editar trem ${idTrem}`;
	botaoSalvarTrem.textContent = 'Editar';

	bootstrap.Modal.getOrCreateInstance(modalCadastroTrem).show();
};

window.abrirExclusao = function (nome) {
	const nomeExcluirTrem = document.getElementById('nomeExcluirTrem');
	const modalExcluirTrem = document.getElementById('modalExcluirTrem');

	if (!nomeExcluirTrem || !modalExcluirTrem) {
		return;
	}

	nomeExcluirTrem.textContent = nome;
	bootstrap.Modal.getOrCreateInstance(modalExcluirTrem).show();
};
