@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($room) ? 'Editar Sala' : 'Nueva Sala' }}</h2>
        <form action="{{ isset($room) ? route('admin.rooms.update', $room->id) : route('admin.rooms.store') }}" method="POST">
            @csrf
            @if(isset($room))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Nombre de la Sala</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $room->name ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control">{{ $room->description ?? '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($room) ? 'Actualizar' : 'Crear' }}</button>
        </form>
    </div>
@endsection
