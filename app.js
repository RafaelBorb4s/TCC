function cancelar(){
     location.href = "../index.php";
}

function exibeSenha(){
    var senha = document.getElementById("login_input_senha");

    if(senha.type == "password"){
        senha.type = "text";
    }else{
        senha.type = "password";
    }
}

function exibeSenhaCad(){
    var senha = document.getElementById("cadpassword"); 
    var confSenha = document.getElementById("cadconfsenha");
    var cadSenha = document.getElementById("edpassword");

    if(senha.type == "password"){
        senha.type = "text";
        confSenha.type = "text";
        cadSenha.type = "text";
    }else{
        senha.type = "password";
        confSenha.type = "password";
        cadSenha.type = "password";
    }
}

function publicar(){
    let modal = document.querySelector('.Modal');
    let btn = document.querySelector('.botao_publicar_autenticado');
    let btn1 = document.querySelector('.botao_publicar');

    modal.style.display = 'block';
    btn.style.display = 'none';
    btn1.style.display = 'none';
}

function fechar_modal(){
    let modal = document.querySelector('.Modal');
    let btn = document.querySelector('.botao_publicar_autenticado');
    let btn1 = document.querySelector('.botao_publicar');

    modal.style.display = 'none';
    btn.style.display = 'block';
    btn1.style.display = 'block';
}


function erro(){
    alert('Você precisa estar logado para publicar!');
}

function logout(){
    window.location.replace("logout.php");
}

function logout_index(){
    window.location.replace("paginas/logout.php");
}