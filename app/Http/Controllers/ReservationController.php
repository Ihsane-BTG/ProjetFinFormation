<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'seats' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $table = Table::where('available', true)->first();

        if (!$table) {
            return response()->json(['error' => 'No tables available at the moment. Please try again later.'], 400);
        }

        $validatedData['table_id'] = $table->id;

        $table->available = false;
        $table->save();

        $reservation = Reservation::create($validatedData);

        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::with('table')->findOrFail($id);
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'email',
            'phone' => 'string',
            'date' => 'date',
            'time' => 'date_format:H:i',
            'seats' => 'integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($validatedData);

        return response()->json($reservation, 200);
    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        $table = Table::find($reservation->table_id);
        $table->available = true;
        $table->save();

        $reservation->delete();
        return response()->json(null, 204);
    }
}
