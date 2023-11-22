<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail; // Importa la fachada Mail desde el espacio de nombres correcto
use Illuminate\Http\Request; // Asegúrate de importar la clase correcta

use App\Mail\Notificacion;
use App\Models\User; // Asegúrate de tener el espacio de nombres correcto para tu modelo User

class MailController extends Controller
{
    public function index(Request $request)
    {
        return view('panel.mails.form');
    }

    public function sendMail(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $admin = User::role('admin')->first();
        $user_auth = auth()->user();

        Mail::to($admin->email)->send(new Notificacion(
            $user_auth,
            $request->title,
            $request->body,
        ));
        

        return redirect()->route('mails.form')
            ->with('alert', 'Mensaje enviado exitosamente.');
    }
}
