<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Room $room)
    {
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $reservationExists = Reservation::where('room_id', $room->id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($reservationExists) {
            return redirect()->back()->withErrors('Ya existe una reserva para esa fecha y hora');
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'Pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservación creada con éxito');
    }

    public function index()
    {
        $reservations = Auth::user()->reservations;
        return view('reservations.index', compact('reservations'));
    }
}
