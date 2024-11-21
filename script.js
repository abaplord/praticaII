document.addEventListener("DOMContentLoaded", function() {
    function carregarSolicitacoes() {
        fetch("main.php?acao=listar_solicitacoes")
            .then(response => response.json())
            .then(data => {
                let solicitacoesHtml = "<ul>";
                data.forEach(solicitacao => {
                    solicitacoesHtml += `<li>
                        <strong>${solicitacao.cliente}</strong>: ${solicitacao.descricao} 
                        (Urgência: ${solicitacao.urgencia}, Status: ${solicitacao.status})
                    </li>`;
                });
                solicitacoesHtml += "</ul>";
                document.getElementById("solicitacoes").innerHTML = solicitacoesHtml;
            });
    }

    carregarSolicitacoes();
});
