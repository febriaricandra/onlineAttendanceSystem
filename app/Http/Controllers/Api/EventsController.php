<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventsController extends Controller
{
    //
    public function index()
    {
        $events = Event::paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Daftar data event',
            'data' => $events
        ], 200);
    }

    public function show($id)
    {
        //find event by ID dengan attendancee yang hadir dan tidak hadir
        $event = Event::with('attendance.user')->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'event tidak ditemukan',
                'data' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data event',
            'data' => $event
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi data dari frontend
        $request->validate([
            'nama' => 'required|string',
            'tempat' => 'required|string',
            'deskripsi' => 'required|string',
            'dateTime' => 'required|date',
            'startTime' => 'required',
            'endTime' => 'required',
            'file' => 'required|mimes:pdf|max:2048', // Hanya menerima file PDF maksimal 2MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            // Simpan file PDF ke direktori penyimpanan yang sesuai (misalnya, "public/document")
            $file->storeAs('public/document', $filename);
        }

        $event = Event::create([
            'nama' => $request->nama,
            'tempat' => $request->tempat,
            'deskripsi' => $request->deskripsi,
            'dateTime' => $request->dateTime,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'file' => $filename,
        ]);

        if ($event) {
            return response()->json([
                'success' => true,
                'message' => 'event berhasil di tambahkan',
                'data' => $event
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'event gagal di tambahkan',
                'data' => $event
            ], 409);
        }
    }

    public function update(Request $request, Event $event)
    {
        //update event by id and if file exist then delete old file
        $event = Event::find($request->id);
        if($request->file('file') != null){
            $filename = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/document', $filename);
            $event->file = $filename;
        }
        $event->nama = $request->nama;
        $event->tempat = $request->tempat;
        $event->deskripsi = $request->deskripsi;
        $event->dateTime = $request->dateTime;
        $event->startTime = $request->startTime;
        $event->endTime = $request->endTime;
        $event->save();

        if($event)
        {
            return response()->json([
                'success' => true,
                'message' => 'event berhasil di update',
                'data' => $event
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'event gagal di update',
                'data' => $event
            ], 409);
        }
    }

    //mengambil event yang akan datang
    public function upcoming()
    {
        $events = Event::where('dateTime', '>=', date('Y-m-d'))->paginate(5);
        return response()->json([
            'success' => true,
            'message' => 'Daftar data event yang akan datang',
            'data' => $events
        ], 200);
    }

    public function destroy($id)
    {
        //hapus event termasuk file nya
        $event = Event::find($id);
        $event->delete();

        if($event)
        {
            return response()->json([
                'success' => true,
                'message' => 'event berhasil di hapus',
                'data' => $event
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'event gagal di hapus',
                'data' => $event
            ], 409);
        }
    }

    
}
