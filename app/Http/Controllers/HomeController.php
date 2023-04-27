<?php

namespace App\Http\Controllers;
use App\Jobs\EnviarMensajeJob;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */

        

    public function index()
    {
        $us = User::all();
        return view('home',compact('us'));
    }

    public function enviarMensaje(Request $request)
    {
        $mensaje = $request->input('mensaje');

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            dispatch(new EnviarMensajeJob($usuario->phone_number, $mensaje));
        }

        return redirect()->back()->with('success', 'Mensaje enviado correctamente');
    }

    public function destroy(User $seguimiento, $id)
    {
        User::destroy($id);
        // Session::flash('error','El registro se ha agregado correctamente');
        $us = User::all();
        return view('home',compact('us'));
       
    }

   
}

// class EnviarMensajeJob implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $mensaje;

//     public function __construct($mensaje)
//     {
//         $this->mensaje = $mensaje;
//     }

//     public function handle()
//     {
//         $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

//         $message = $twilio->messages
//                     ->create('whatsapp:' . config('services.twilio.from'), // to
//                              [
//                                  'from' => 'whatsapp:' . config('services.twilio.from'),
//                                  'body' => $this->mensaje
//                              ]);

//         echo $message->sid;
//     }
// }