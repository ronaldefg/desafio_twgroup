@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Hacer una Reserva</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('reservations.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group mb-3">
                <label for="room_id" class="form-label">Cuarto</label>
                <select name="room_id" id="room_id" class="form-select" required>
                    <option value="" disabled selected>Seleccione un cuarto</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" id="date" min="{{ now()->toDateString() }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="time" class="form-label">Hora</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Reservar</button>
        </form>
    </div>
@endsection
