<div class="form-group {{ $errors->has('topik') ? 'has-error' : ''}}">
    {!! Form::label('topik', 'Topik', ['class' => 'control-label']) !!}
    {!! Form::text('topik', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('topik', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('semester_id') ? 'has-error' : ''}}">
    {!! Form::hidden('periode_id', $periodes, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('periode_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('semester_id') ? 'has-error' : ''}}">
    {!! Form::hidden('semester_id', $semester, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('semester_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tanggal') ? 'has-error' : ''}}">
    {!! Form::label('tanggal', 'Tanggal', ['class' => 'control-label']) !!}
    {!! Form::date('tanggal', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('tanggal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('catatan') ? 'has-error' : ''}}">
    {!! Form::label('catatan', 'Catatan', ['class' => 'control-label']) !!}
    {!! Form::textarea('catatan', null, ('' == 'required') ? ['id' => 'mymce','class' => 'form-control', 'required' => 'required'] : ['id' => 'mymce','class' => 'form-control']) !!}
    {!! $errors->first('catatan', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-rounded btn-primary']) !!}
</div>
