document.addEventListener('DOMContentLoaded', function(){
    var notif = document.querySelector('.notificacao');
    if(notif){
        setTimeout(function(){ notif.style.opacity = '0'; notif.style.transition = '.5s'; }, 3000);
        setTimeout(function(){ notif.remove(); }, 3500);
    }
});
