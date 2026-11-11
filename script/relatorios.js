document.addEventListener('DOMContentLoaded', function () {
	const modalRelatorios = document.getElementById('modalRelatorios');
	const alertaCamposRelatorio = document.getElementById('alertaCamposRelatorio');

	const botaoCadastrar = document.getElementById('botaoCadastrar');
	const formularioCadastro = document.getElementById('formularioRelatorio');
	const relatorioInput = document.getElementById('relatorio');
	const tremInput = document.getElementById('trem');
	const usuarioInput = document.getElementById('usuario');
	const operacaoInput = document.getElementById('operacao');

	function mostrarAlertaRelatorio(mensagem) {
		if (!alertaCamposRelatorio) return;
		alertaCamposRelatorio.textContent = mensagem;
		alertaCamposRelatorio.hidden = false;
	}

	function abrirModalCadastro() {
		if (!modalRelatorios) return;

		if (formularioCadastro) {
			formularioCadastro.reset();
		}

		if (alertaCamposRelatorio) {
			alertaCamposRelatorio.hidden = true;
		}

		bootstrap.Modal.getOrCreateInstance(modalRelatorios).show();
	}

	if (botaoCadastrar) {
		botaoCadastrar.addEventListener('click', abrirModalCadastro);
	}

	if (formularioCadastro) {
		formularioCadastro.addEventListener('submit', function (event) {
			event.preventDefault();

			const relatorio = relatorioInput ? relatorioInput.value.trim() : '';
			const trem = tremInput ? tremInput.value.trim() : '';
			const usuario = usuarioInput ? usuarioInput.value.trim() : '';
			const operacao = operacaoInput ? operacaoInput.value.trim() : '';

			if (!relatorio || !trem || !usuario || !operacao) {
				const mensagem = !operacao
					? 'Não é possível gerar relatório sem uma operação funcional.'
					: 'Preencha todos os campos.';
				mostrarAlertaRelatorio(mensagem);
				return;
			}

			if (alertaCamposRelatorio) {
				alertaCamposRelatorio.hidden = true;
			}

			if (bootstrap.Modal.getInstance(modalRelatorios)) {
				bootstrap.Modal.getInstance(modalRelatorios).hide();
			}

			formularioCadastro.reset();
		});
	}
});

	window.abrirExclusaoRelatorio = function (id, titulo) {
		const modalExcluirRelatorio = document.getElementById('modalExcluirRelatorio');
		const tituloEl = document.getElementById('tituloExcluirRelatorio');
		const botaoExcluirRelatorio = document.getElementById('botaoExcluirRelatorio');
		const idInput = document.getElementById('idRelatorioExcluir');

		if (!modalExcluirRelatorio) return;
		if (tituloEl) tituloEl.textContent = titulo || '';
		if (idInput) idInput.value = id || '';

		if (botaoExcluirRelatorio) {
			botaoExcluirRelatorio.addEventListener('click', function () {
				const formularioExclusao = document.createElement('form');
				const campoIdRelatorio = document.createElement('input');
				formularioExclusao.method = 'POST';
				formularioExclusao.action = '../controllers/relatorio/excluirRelatorio.php';
				campoIdRelatorio.name = 'id_relatorio';
				campoIdRelatorio.value = id;
				formularioExclusao.appendChild(campoIdRelatorio);
				document.body.appendChild(formularioExclusao);
				formularioExclusao.submit();
			});
		}

		bootstrap.Modal.getOrCreateInstance(modalExcluirRelatorio).show();
	};
