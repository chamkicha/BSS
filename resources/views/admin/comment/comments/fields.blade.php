<!-- Comment Field -->
<div class="form-group col-sm-12">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Order I D Field -->
<div class="form-group col-sm-12">
    {!! Form::label('order_i_d', 'Order I D:') !!}
    {!! Form::text('order_i_d', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-12">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.comment.comments.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
