@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Reservas</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Sala</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($reservations as $reservation)
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
