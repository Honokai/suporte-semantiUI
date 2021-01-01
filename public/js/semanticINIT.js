window.addEventListener('load', () => {
    $('.ui.dropdown').dropdown();
})

function abrirModal(id) {

    let xml = new XMLHttpRequest
    xml.open('GET', `/chamados/${id}`)
    xml.send()
    xml.addEventListener('load', () => {
        if(xml.status == 200) {
            document.getElementById('modal').innerHTML = xml.responseText
            $('.longer.modal').modal('show');
        } else {
            document.getElementById('modal').innerHTML = "Algo deu errado"
        }
    })   
}

function enviarMensagem(informacao = {remetente, ...demais}) {
    let xml = new XMLHttpRequest
    let formulario = new FormData;
    formulario.append('_token', document.querySelector('#modal > div:nth-child(4) > div:nth-child(2) > div.ui.form > div > form > input[type=hidden]').value)
    formulario.append('remetente_id', informacao.remetente_id)
    formulario.append('chamado_id', informacao.chamado_id)
    formulario.append('mensagem', document.getElementById('mensagem').value)
    xml.open('POST', '/mensagens')
    xml.setRequestHeader("X-CSRF-TOKEN", document.querySelector('#modal > div:nth-child(4) > div:nth-child(2) > div.ui.form > div > form > input[type=hidden]').value);
    xml.send(formulario)
    xml.addEventListener('load', () => {
        if(xml.status == 200) {
            document.getElementById('conversa').append(xml.responseText)
        } else {
            console.log(xml.responseText)
        }
    })
}