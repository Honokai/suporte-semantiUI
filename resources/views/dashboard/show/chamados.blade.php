
<div class="ui relaxed divided list">
    @foreach ($chamados as $chamado)
        <div class="item">
            <i class="large github middle aligned icon"></i>
            <div class="content">
                <a class="header">#{{$chamado->id}}</a>
                <div class="description">Updated 10 mins ago</div>
            </div>
        </div>
    @endforeach
</div>
