import _ from 'lodash';
import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window._ = _;

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "7mKbukJYNo9lSwcxVhgNmA9ud7RNh4fR",
    wsHost: "suporte.localhost.com",
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: true,
    disableStats: true,
});

window.Echo.channel(document.getElementById('channel').value).listen('.ChamadoRespondido', (e) => {
    if(Notification.permission == 'default') {
        Notification.requestPermission().then(permissao => {
            permissao == 'granted' ? new Notification(e.titulo, {body: e.mensagem}) : ""
            
        })
    } else if(Notification.permission == 'granted') {
        new Notification(e.titulo, {body: e.mensagem})
    }
}).listen('.t', (e) => {
    if(Notification.permission == 'default') {
        Notification.requestPermission().then(permissao => {
            permissao == 'granted' ? new Notification(e.titulo, {body: e.mensagem}) : ""

        })
    } else if(Notification.permission == 'granted') {
        new Notification(e.titulo, {body: e.mensagem})
    }
})
