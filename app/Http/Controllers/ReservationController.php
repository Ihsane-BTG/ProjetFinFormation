<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        

        // $table = Table::where('available', 1)->first();

        // if (!$table) {
        //     return response()->json(['error' => 'No tables available at the moment. Please try again later.'], 400);
        // }

        $validatedData = $request->all();

        $reservation = Reservation::create($validatedData);

        // $table->available = false;
        // $table->save();

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
