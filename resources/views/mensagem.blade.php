<div class="comment">
    <a class="avatar">
        <img src="https://semantic-ui.com/images/avatar/small/elliot.jpg">
    </a>
    <div class="content">
        <a class="author">{{$mensagem->remetente->name}}</a>
        <div class="metadata">
        <span class="date">{{date('Y-m-d', strtotime($mensagem->created_at))}}</span>
        </div>
        <div class="text">
        {{$mensagem->mensagem}}
        </div>
        <div class="actions">
        <a class="reply">Reply</a>
        </div>
    </div>
</div>