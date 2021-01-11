@extends('layouts.admin')
@section('content')
    <a href="{{ route('admin.journals.create') }}">Создать</a>
    <table style="width:100%">
        <tr>
            <th>Название</th>
            <th>Краткое описание</th>
            <th>Дата создание</th>
            <th>Фото</th>
            <th>Actions</th>
        </tr>
        @foreach($journals as $journal)
            <tr>
                <td>{{ $journal->title }}</td>
                <td>{{ $journal->descripton }}</td>
                <td>{{ $journal->created_at }}</td>
                <td><img src="{{ asset('uploads/journals/' . $journal->id . '/' . $journal->image_name) }}" style="width: 100px; height: 100px;" alt=""></td>
                <td>
                    <a href="{{ route('admin.journals.edit', $journal->id) }}">Редактировать</a>
                    <form method="POST" action="{{ route('admin.journals.destroy', $journal->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </td>
                <td>{{ $journal->created_at }}</td>
            </tr>
        @endforeach
    </table>
@endsection
