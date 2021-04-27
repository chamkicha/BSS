<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $comment->id !!}</p>
    <hr>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    <p>{!! $comment->comment !!}</p>
    <hr>
</div>

<!-- Order I D Field -->
<div class="form-group">
    {!! Form::label('order_i_d', 'Order I D:') !!}
    <p>{!! $comment->order_i_d !!}</p>
    <hr>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $comment->user_id !!}</p>
    <hr>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $comment->created_at !!}</p>
    <hr>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{!! $comment->username !!}</p>
    <hr>
</div>

