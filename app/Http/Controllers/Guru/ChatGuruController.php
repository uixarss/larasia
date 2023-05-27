<?php

namespace App\Http\Controllers\Guru;

use App\ChatGuru;
use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Siswa;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Gate;

class ChatGuruController extends Controller
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

        // if (Gate::denies('manage-chat')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        // $data_siswa = DB::select("select users.id, users.name, users.email, count(is_read) as unread 
        // from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        // where users.id != " . Auth::id() . " 
        // group by users.id, users.name, users.email");

        $data_siswa = DB::select("select mahasiswa.user_id, mahasiswa.nama_mahasiswa, mahasiswa.email, count(is_read) as unread 
        from mahasiswa LEFT  JOIN  messages ON mahasiswa.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where mahasiswa.user_id != " . Auth::id() . " 
        group by mahasiswa.user_id, mahasiswa.nama_mahasiswa, mahasiswa.email");

        $data_ortu = DB::select("select orangtua.user_id, orangtua.nama_orangtua, orangtua.email_orangtua, count(is_read) as unread 
        from orangtua LEFT  JOIN  messages ON orangtua.user_id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where orangtua.user_id != " . Auth::id() . " 
        group by orangtua.user_id, orangtua.nama_orangtua, orangtua.email_orangtua");


        return view('guru.chatguru.index', [
            'data_siswa' => $data_siswa,
            'data_ortu' => $data_ortu
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

        return view('guru.chatguru.message', ['messages' => $messages]);
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


}
