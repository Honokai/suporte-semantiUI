@if(session('mensagem.positiva'))
    <div class="ui positive message">
        <i class="close icon"></i>
        <p>{{session('mensagem.positiva')}}</p>
    </div>
@elseif(session('mensagem.negativa'))
    <div class="ui negative message">
        <i class="close icon"></i>
        <p>{{session('mensagem.negativa')}}</p>
    </div>
@endif

<script>
    $('.message .close').on('click', function() {
        $(this).closest('.message')
        .transition('fade');
    });
</script>