function buscarProduto(){
    var pesquisa = document.getElementById('pesquisa').value.trim();
    if(pesquisa !== ''){
        window.location.href = 'produtos.php?buscar=' + encodeURIComponent(pesquisa);
    }
}

document.addEventListener('DOMContentLoaded', function(){
    var pesquisaInput = document.getElementById('pesquisa');
    if(pesquisaInput){
        pesquisaInput.addEventListener('keypress', function(e){
            if(e.key === 'Enter') buscarProduto();
        });
    }

    var notif = document.querySelector('.notificacao');
    if(notif){
        setTimeout(function(){ notif.style.opacity = '0'; notif.style.transition = '.5s'; }, 3000);
        setTimeout(function(){ notif.remove(); }, 3500);
    }
});