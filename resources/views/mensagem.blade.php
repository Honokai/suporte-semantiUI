<div class="content">
    <a class="author">{{$mensagem->remetente->name}}</a>
    <div class="metadata">
    <span class="date">{{$mensagem->created_at}}</span>
    </div>
    <div class="text">
    {{$mensagem->mensagem}}
    </div>
    <div class="actions">
    <a class="reply">Reply</a>
    </div>
</div>