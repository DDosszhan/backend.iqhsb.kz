@extends('admin.layouts.form')

@section('inputs')
    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" name="name" @isset($item) value="{{ $item->name }}" @endisset>
        <p class="help-block"></p>
    </div>

    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="text" class="form-control" id="phone" name="phone" @isset($item) value="{{ $item->phone }}" @endisset>
        <p class="help-block"></p>
    </div>
@endsection
