<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Mail\InfoMail;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
	public function sendMessage(Request $request, $slug) {
		$validatedData = $request->validate(
		  [
			'email' => 'required|email',
			'message' => 'required',
		  ]);
		$apartment = Apartment::where('slug', $slug)->get()->first();
		//salvo il messaggio nel DB
		$message = new Message();
		$message->apartment_id = $apartment->id;
		$message->from = $validatedData['email'];
		$message->body = $validatedData['message'];
		$message->save();
		//invio email al proprietario dell'appartamento notificandogli il nuovo messaggio
		Mail::to($apartment->user->email)->send(new InfoMail($apartment->title));
		//ritorno alla pagina
		return redirect()->back()->withMessage('Messaggio inviato correttamente');
	}
}
