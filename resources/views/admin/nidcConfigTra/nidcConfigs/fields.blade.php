<!-- Tin Num Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tin_num', 'Tin Num:') !!}
    {!! Form::text('tin_num', null, ['class' => 'form-control']) !!}
</div>

<!-- Vfd Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vfd', 'Vfd:') !!}
    {!! Form::text('vfd', null, ['class' => 'form-control']) !!}
</div>

<!-- Cert Path Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cert_path', 'Cert Path:') !!}
    {!! Form::text('cert_path', null, ['class' => 'form-control']) !!}
</div>

<!-- Cert Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cert_password', 'Cert Password:') !!}
    {!! Form::text('cert_password', null, ['class' => 'form-control']) !!}
</div>

<!-- Cert Serial Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cert_serial', 'Cert Serial:') !!}
    {!! Form::text('cert_serial', null, ['class' => 'form-control']) !!}
</div>

<!-- Datetime Field -->
<div class="form-group col-sm-12">
    {!! Form::label('datetime', 'Datetime:') !!}
    {!! Form::text('datetime', null, ['class' => 'form-control']) !!}
</div>

<!-- Regid Field -->
<div class="form-group col-sm-12">
    {!! Form::label('regid', 'Regid:') !!}
    {!! Form::text('regid', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-12">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<!-- Recptcode Field -->
<div class="form-group col-sm-12">
    {!! Form::label('recptcode', 'Recptcode:') !!}
    {!! Form::text('recptcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Routekey Field -->
<div class="form-group col-sm-12">
    {!! Form::label('routekey', 'Routekey:') !!}
    {!! Form::text('routekey', null, ['class' => 'form-control']) !!}
</div>

<!-- Access Token Field -->
<div class="form-group col-sm-12">
    {!! Form::label('access_token', 'Access Token:') !!}
    {!! Form::text('access_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.nidcConfigTra.nidcConfigs.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
