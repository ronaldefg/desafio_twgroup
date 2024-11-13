@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Gestión de Reservas</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Sala</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        @if ($reservation->status === 'Pendiente')
                            <a href="{{ route('admin.reservations.updateStatus', [$reservation->id, 'Aceptada']) }}" class="btn btn-success">Aceptar</a>
                            <a href="{{ route('admin.reservations.updateStatus', [$reservation->id, 'Rechazada']) }}" class="btn btn-danger">Rechazar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
