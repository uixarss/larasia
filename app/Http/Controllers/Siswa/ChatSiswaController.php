<?php

namespace App\Http\Controllers\Siswa;

use App\ChatSiswa;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Message;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatSiswaController extends Controller
{
    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data_gurus = DB::select("select dosen.user_id, dosen.nama_dosen, dosen.email, count(is_read) as unread 
        from dosen LEFT  JOIN  messages ON dosen.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where dosen.user_id != " . Auth::id() . " 
        group by dosen.user_id, dosen.nama_dosen, dosen.email");

        return view('siswa.chat.index',[
            'data_guru' => $data_gurus
        ]);
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

        return view('siswa.chat.message', ['messages' => $messages]);
    }

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatSiswa  $chatSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(ChatSiswa $chatSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatSiswa  $chatSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatSiswa $chatSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatSiswa  $chatSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatSiswa $chatSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatSiswa  $chatSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatSiswa $chatSiswa)
    {
        //
    }
}
