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
            <input maxlength="255" required type="text" name="title" {{ $journal->title }} placeholder="Название" class="form-control">
        </div>
        <div class="form-group">
            <label>Краткое описание</label>
            <textarea class="form-control"  maxlength="1500" name="description">{{ $journal->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Фото</label>
            <img src="{{ asset('uploads/journals/' . $journal->id . '/' . $journal->image_name) }}" style="width: 100px; height: 100px;">
            <input type="file" accept="image/*" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="authors">Выберите авторов *</label>
            <select multiple name="authors[]">
                @foreach($authors as $author)
                    <option @if(in_array($author->id, $journal_authors)) selected @endif value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>
@endsection
