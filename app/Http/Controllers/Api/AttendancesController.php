<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendancesController extends Controller
{
    //
    public function index()
    {
        $attendances = Attendance::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data attendance',
            'data' => $attendances
        ], 200);
    }
    public function show($id)
    {
        $attendance = Attendance::with('user', 'event')->where('id', $id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Data attendance',
            'data' => $attendance
        ], 200);
    }

    public function store(Request $request)
    {
        $attendance = Attendance::create([
            'id_event' => $request->event_id,
            'id_user' => $request->user_id,
            'isAttend' => "Hadir",
            'tanggal' => $request->tanggal,
        ]);

        if($attendance)
        {
            return response()->json([
                'success' => true,
                'message' => 'attendance berhasil di tambahkan',
                'data' => $attendance
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'attendance gagal di tambahkan',
                'data' => $attendance
            ], 409);
        }
    }
}
