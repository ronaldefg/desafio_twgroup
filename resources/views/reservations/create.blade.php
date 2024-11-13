@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Reserva</h2>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="room">Sala</label>
                <select name="room_id" id="room" class="form-control">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Fecha</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="time">Hora</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    </div>
@endsection
