@extends('admin.layouts.form')

@section('inputs')
    <div class="form-group">
        <label for="last_name">Фамилия</label>
        <input type="text" class="form-control" id="last_name" name="last_name" @isset($item) value="{{ $item->last_name }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="first_name">Имя</label>
        <input type="text" class="form-control" id="first_name" name="first_name" @isset($item) value="{{ $item->first_name }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="date_of_birth">Дата рождения</label>
        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" @isset($item) value="{{ $item->date_of_birth }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="grade">Класс</label>
        <input type="text" class="form-control" id="grade" name="grade" @isset($item) value="{{ $item->grade }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="school">Школа</label>
        <input type="text" class="form-control" id="school" name="school" @isset($item) value="{{ $item->school }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="language">Язык</label>
        <input type="text" class="form-control" id="language" name="language" @isset($item) value="{{ $item->language }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="text" class="form-control" id="phone" name="phone" @isset($item) value="{{ $item->phone }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" @isset($item) value="{{ $item->email }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="source">Источник</label>
        <input type="text" class="form-control" id="source" name="source" @isset($item) value="{{ $item->source }}" @endisset>
        <p class="help-block"></p>
    </div>
    <div class="form-group">
        <label for="parent_name">ФИО родителя / законного представителя</label>
        <input type="text" class="form-control" id="parent_name" name="parent_name" @isset($item) value="{{ $item->parent_name }}" @endisset>
        <p class="help-block"></p>
    </div>
@endsection
