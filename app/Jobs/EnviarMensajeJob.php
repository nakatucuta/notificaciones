<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class EnviarMensajeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $numero;
    protected $mensaje;

    public function __construct($numero, $mensaje)
    {
        $this->numero = $numero;
        $this->mensaje = $mensaje;
    }

    public function handle()
    {
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $message = $twilio->messages
            ->create('whatsapp:' . $this->numero, // to
                [
                    'from' => 'whatsapp:+14155238886' . config('services.twilio.from'),
                    'body' => $this->mensaje
                ]);

        echo $message->sid;
    }

}
