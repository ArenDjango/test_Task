@extends('layouts.admin')
@section('content')
    <form action="{{ route('admin.journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label>Название *</label>
            <input maxlength="255" required type="text" name="title" {{ old('title') }} placeholder="Название" class="form-control">
        </div>
        <div class="form-group">
            <label>Краткое описание</label>
            <textarea class="form-control" maxlength="1500" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Фото *</label>
            <input type="file" accept="image/*" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="authors">Выберите авторов *</label>
            <select multiple name="authors[]">
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>
@endsection
