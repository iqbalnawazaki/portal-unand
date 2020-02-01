<div class="form-group {{ $errors->has('judul') ? 'has-error' : ''}}">
    {!! Form::label('judul', 'Judul', ['class' => 'control-label']) !!}
    {!! Form::text('judul', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('waktu') ? 'has-error' : ''}}">
    {!! Form::label('waktu', 'Waktu', ['class' => 'control-label']) !!}
    {!! Form::date('waktu', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('waktu', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('konten') ? 'has-error' : ''}}">
    {!! Form::label('konten', 'Konten', ['class' => 'control-label']) !!}
    {!! Form::textarea('konten', null, ('' == 'required') ? ['id' => 'mymce','class' => 'form-control', 'required' => 'required'] : ['id' => 'mymce','class' => 'form-control']) !!}
    {!! $errors->first('konten', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-rounded btn-primary']) !!}
</div>
