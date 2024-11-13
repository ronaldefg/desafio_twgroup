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
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);
        $roomId = $request->room_id;
        $reservationDate = $request->date;
        $startTime = $request->time;
        if (!Reservation::isRoomAvailable($roomId, $reservationDate, $startTime)) {
            return redirect()->back()->withErrors(['error' => 'La sala no está disponible en el horario seleccionado.']);
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $roomId,
            'date' => $reservationDate,
            'time' => $startTime,
            'end_time' => date("H:i", strtotime($startTime) + 3600),
            'status' => 'Pendiente',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reserva creada con éxito');
    }

    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('reservations.index', compact('reservations'));
    }
}
