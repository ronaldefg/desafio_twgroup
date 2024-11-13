@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Gestión de Reservaciones</h1>

        <form method="GET" class="mb-4">
            <div class="form-group">
                <label for="room_id">Filtrar por Sala</label>
                <select name="room_id" id="room_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Todas las Salas</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Cuarto</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="Pendiente" {{ $reservation->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Aceptada" {{ $reservation->status == 'Aceptada' ? 'selected' : '' }}>Aceptada</option>
                                <option value="Rechazada" {{ $reservation->status == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
