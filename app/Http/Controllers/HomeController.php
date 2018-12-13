<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TextNotification;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function notify(Request $request)
    {
        $run = now()->addSeconds(10);
        Notification::send($request->user(), (new TextNotification('Funcionou!'))->delay($run));
        return 'notificados...';
    }

    public function view(Request $request)
    {
        $user = $request->user();
        return view('view', compact('user'));
    }

    public function read($id)
    {
        $user = Auth::user();
        $user->notifications->find($id)->markAsRead();
        return redirect('/view');
    }
}
