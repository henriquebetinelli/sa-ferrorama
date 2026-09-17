document.addEventListener('DOMContentLoaded', function () {
	const modalRelatorios = document.getElementById('modalRelatorios');

	const botaoCadastrar = document.getElementById('botaoCadastrar');
	const formularioCadastro = document.getElementById('formularioCadastro');
	const relatorioInput = document.getElementById('relatorio');
	const tremInput = document.getElementById('trem');
	const usuarioInput = document.getElementById('usuario');
	const operacaoInput = document.getElementById('operacao');

	function abrirModalCadastro() {
		if (!modalRelatorios) return;

		if (formularioCadastro) {
			formularioCadastro.reset();
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
				return;
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

		if (!modalExcluirRelatorio) return;
		if (tituloEl) tituloEl.textContent = titulo || '';
		bootstrap.Modal.getOrCreateInstance(modalExcluirRelatorio).show();
	};
