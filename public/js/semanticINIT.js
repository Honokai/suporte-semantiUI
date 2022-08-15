window.addEventListener('load', () => {
    $('.ui.dropdown').dropdown(
        {
            fullTextSearch: true
        }
    );
    /*
    $('.browse.item').popup({
        popup: '.menu.popup',
        distanceAway: -5,
        hoverable: true
    });
    */
})

function abrirModal(route) {
    if(route){
        let iframe = document.getElementById('iframe')
        iframe.src = `${route}`
        $('.longer.modal').modal({
            centered: false,
            onApprove : function() {
              return false;
            }
        }).modal('show');
    } else {
        let iframe = document.getElementById('iframe')
        iframe.src = '/chamados/create'
        $('.longer.modal').modal({
            onApprove : function() {
              return false;
            }
          }).modal('show');
    }

}

function enviarMensagem(informacao = {remetente, ...demais}) {
    let xml = new XMLHttpRequest
    let formulario = new FormData;
    let arquivos = document.getElementById('file').files;
    formulario.append('_token', document.querySelector('#modal > div:nth-child(4) > div:nth-child(2) > div.ui.form > div > form > input[type=hidden]').value)
    formulario.append('remetente_id', informacao.remetente_id)
    formulario.append('chamado_id', informacao.chamado_id)
    formulario.append('mensagem', document.getElementById('mensagem').value)
    for (let i = 0; i < arquivos.length; i++) {
        let arquivo = arquivos[i]
        formulario.append('anexos[]', arquivo)
    }
    xml.open('POST', '/mensagens')
    xml.setRequestHeader("X-CSRF-TOKEN", document.querySelector('#modal > div:nth-child(4) > div:nth-child(2) > div.ui.form > div > form > input[type=hidden]').value);
    xml.send(formulario)
    xml.addEventListener('load', () => {
        if(xml.status == 200) {
            document.getElementById('conversa').innerHTML += xml.responseText
            document.getElementById('conversa').lastChild.style.transition = '1s'
            document.getElementById('conversa').lastChild.style.backgroundColor = 'yellow'
            document.getElementById('conversa').lastChild.style.padding = '10px'
            setTimeout(function(){
                document.getElementById('conversa').lastChild.style.backgroundColor = 'white'
                document.getElementById('conversa').lastChild.style.padding = '0'
            }, 5000)
            document.getElementById('mensagem').value = ""
        } else {
            console.log(xml.responseText)
        }
    })
}

function enviarFormularioAbertura() {
    let form = new FormData;
    let xml = new XMLHttpRequest;
    let arquivos = document.getElementById('file').files;
    form.append('solicitante_id', document.getElementById('solicitante_id').value);
    form.append('categoria_id', document.getElementById('categoria_id').value);
    form.append('setor_id', document.getElementById('setor_id').value);
    form.append('localizacao_id', document.getElementById('localizacao_id').value);
    form.append('mensagem', document.getElementById('mensagem').value);
    for (let i = 0; i < arquivos.length; i++) {
        let arquivo = arquivos[i]
        form.append('anexos[]', arquivo)
    }
    xml.open('POST', '/chamados');
    xml.setRequestHeader("X-CSRF-TOKEN", document.querySelector('#modal > div:nth-child(4) > div.ui.medium.image > div > div:nth-child(1) > input[type=hidden]:nth-child(4)').value)
    xml.setRequestHeader('Accept', 'application/json')
    xml.send(form);
    xml.addEventListener('load', () => {
        if(xml.status === 200) {
            window.location.reload()
        } else {
            console.log(xml.responseText)
        }
    })
}

function ativarDropdown()
{
    $('.ui.selection.dropdown').dropdown({
        showOnFocus: false,
        fullTextSearch: true
    });
}
