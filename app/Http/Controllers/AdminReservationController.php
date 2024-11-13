<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Reservation::query();

        if ($request->has('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        $reservations = $query->get();
        $rooms = Room::all();
        return view('admin.reservations.index', compact('reservations', 'rooms'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:Pendiente,Aceptada,Rechazada',
        ]);

        $reservation->status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Estado de la reservación actualizado');
    }
}
