<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Create a booking. Only validation implemented.
     */
    public function store(Request $request)
    {
        $request->validate([
            "departure_code" => "required|regex:/^[A-Z]{2,4}-\d{8}-\d{4}-[A-Z]{3}$/",
            "first_name" => "required|max:60",
            "last_name" => "required|max:60",
            "email" => "required|email",
            "phone" => "nullable",
            "seats" => "required|integer|between:1,16",
        ]);
    }

    public function update(Request $request, Booking $booking)
    {

    }
}
