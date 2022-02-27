async function mostrarChamados(status, setor = '') {
    let xml = new XMLHttpRequest
    xml.open('GET', encodeURI(`/dashboard/chamados?status=${status}&setor=${setor}`))

    xml.send()
    xml.addEventListener('load', () => {
        document.getElementById('chamadosList').innerHTML = xml.responseText
    })
}
