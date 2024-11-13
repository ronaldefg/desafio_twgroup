@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Mis Reservas</h1>
            <a href="{{ route('reservations.create') }}" class="btn btn-success">Hacer una Reserva</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Cuarto</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
