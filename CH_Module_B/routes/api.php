<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminDepartureCancelController;
use App\Http\Controllers\AdminLineController;
use App\Http\Controllers\AdminLineServiceWindowController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BookingCancelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingLookupController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\LineTimetableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource("admin/login", AdminLoginController::class)->only("store");
Route::resource("lines", LineController::class)->only("index", "show");
Route::resource("lines.timetable", LineTimetableController::class)->only("index");
Route::resource("bookings", BookingController::class)->only("store", "update");
Route::resource("bookings/lookup", BookingLookupController::class)->only("store");
Route::resource("bookings.cancel", BookingCancelController::class)->only("store");

Route::middleware("auth:api")->prefix("admin")->group(function () {
  Route::resource("bookings", AdminBookingController::class)->only("index");
  Route::resource("departures.cancel", AdminDepartureCancelController::class)->only("store");

  Route::middleware("can:admin")->group(function () {
    Route::resource("lines", AdminLineController::class)->only("store", "update");
    Route::resource("lines.service-windows", AdminLineServiceWindowController::class)->only("store");
    Route::delete("lines/{line}/service-windows/{start_time}", [AdminLineServiceWindowController::class, "delete"]);
  });
});
