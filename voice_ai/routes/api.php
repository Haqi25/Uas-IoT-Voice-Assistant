<?php


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Trigger
Route::post('/esp32/activate', function () {
    Cache::put('esp32_listen_status', true, 30); // expired 30 detik
    return response()->json(['success' => true]);
});

// Status
Route::get('/esp32/status', function () {
    return response()->json(['is_listening' => Cache::has('esp32_listen_status')]);
});

// Reset
Route::post('/esp32/reset', function () {
    Cache::forget('esp32_listen_status');
    return response()->json(['success' => true]);
});
