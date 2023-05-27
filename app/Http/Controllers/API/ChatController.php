<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Pusher\Pusher;
use App\Events\MyEvent;
use App\Models\DataOrangTua;
use App\Models\Siswa;
use App\Models\Guru;

use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //
    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // aktivasi websocket di terminal
        // php artisan websockets:serve

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );



        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
        broadcast(new MyEvent('hello'))->toOthers();

        return response()->json(true);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return response()->json($messages);
    }

    /**
     * List Siswa 
     * 
     */

    public function listSiswa()
    {
        $data_siswa = DB::select("select mahasiswa.user_id, mahasiswa.nama_mahasiswa as nama_depan, mahasiswa.nama_mahasiswa as nama_belakang, count(is_read) as unread 
        from mahasiswa LEFT  JOIN  messages ON mahasiswa.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where mahasiswa.user_id != " . Auth::id() . " 
        group by mahasiswa.user_id, mahasiswa.nama_mahasiswa, mahasiswa.nama_mahasiswa");

        return response()->json($data_siswa);
    }

    /**
     * List Guru 
     * 
     */

    public function listGuru()
    {
        $data_guru = DB::select("select dosen.user_id, dosen.nama_dosen as nama_lengkap, count(is_read) as unread 
        from dosen LEFT  JOIN  messages ON dosen.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where dosen.user_id != " . Auth::id() . " 
        group by dosen.user_id, dosen.nama_dosen");





        return response()->json($data_guru);
    }

    /**
     * List Ortu 
     * 
     */

    public function listOrtuSiswa()
    {
        $data_ortu = DB::select("select orangtua.user_id, orangtua.nama_orangtua, count(is_read) as unread 
        from orangtua LEFT  JOIN  messages ON orangtua.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where orangtua.user_id != " . Auth::id() . " 
        group by orangtua.user_id, orangtua.nama_orangtua");

        return response()->json($data_ortu);
    }
}
