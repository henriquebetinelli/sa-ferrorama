document.addEventListener('DOMContentLoaded', function () {
    const selectCidade = document.getElementById('select-cidade-clima');
    const temperaturaEl = document.getElementById('temperatura-clima');
    const descricaoClimaEl = document.getElementById('descricao-clima');
    const statusClimaEl = document.getElementById('status-clima');
    const erroClimaEl = document.getElementById('erro-clima');
    const iconeClimaEl = document.getElementById('icone-clima');

    if (!selectCidade || !temperaturaEl || !descricaoClimaEl || !statusClimaEl || !erroClimaEl) {
        return;
    }

    function exibirStatus(mensagem) {
        statusClimaEl.textContent = mensagem;
    }

    function exibirErro(mensagem) {
        erroClimaEl.textContent = mensagem;
        erroClimaEl.hidden = false;
    }

    function ocultarErro() {
        erroClimaEl.textContent = '';
        erroClimaEl.hidden = true;
    }

    function atualizarCard(dados) {
        temperaturaEl.textContent = `${dados.temperatura}°C`;
        descricaoClimaEl.textContent = dados.clima || '';

        atualizarIcone(dados.clima || '');
    }

    function atualizarIcone(descricao) {
        const clima = descricao.toLowerCase();

        let icone = 'bi-cloud-sun-fill';

        if (clima.includes('chuva') || clima.includes('garoa')) {
            icone = 'bi-cloud-rain-fill';
        } 
        else if (clima.includes('tempestade') || clima.includes('trovoada')) {
            icone = 'bi-cloud-lightning-rain-fill';
        } 
        else if (clima.includes('nublado')) {
            icone = 'bi-clouds-fill';
        } 
        else if (clima.includes('limpo') || clima.includes('sol')) {
            icone = 'bi-sun-fill';
        } 
        else if (clima.includes('neblina') || clima.includes('nevoeiro')) {
            icone = 'bi-cloud-fog-fill';
        }

        iconeClimaEl.className = `bi ${icone} icone-home`;
    }

    async function buscarClima(cidade) {
        const cidadeSelecionada = cidade || selectCidade.value || 'Joinville';

        exibirStatus('Carregando clima...');
        ocultarErro();
        temperaturaEl.textContent = '';
        descricaoClimaEl.textContent = '';

        try {
            const resposta = await fetch(`../controllers/clima.php?cidade=${encodeURIComponent(cidadeSelecionada)}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            let dadosResposta;

            try {
                dadosResposta = await resposta.json();
            } catch (erro) {
                throw new Error('Resposta inválida do clima.');
            }

            if (!resposta.ok) {
                throw new Error(dadosResposta.erro || 'Não foi possível carregar o clima.');
            }

            if (!dadosResposta || typeof dadosResposta !== 'object' || typeof dadosResposta.temperatura === 'undefined' || !dadosResposta.clima) {
                throw new Error('Dados do clima indisponíveis.');
            }

            atualizarCard(dadosResposta);
            exibirStatus('');
        } catch (erro) {
            temperaturaEl.textContent = '';
            descricaoClimaEl.textContent = '';
            exibirErro(erro.message || 'Erro ao consultar o clima.');
            exibirStatus('Falha na consulta');
        }
    }

    selectCidade.addEventListener('change', function () {
        buscarClima(this.value);
    });

    buscarClima(selectCidade.value);
});
