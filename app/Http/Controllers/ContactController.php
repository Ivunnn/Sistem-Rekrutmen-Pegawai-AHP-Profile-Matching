<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Kirim email ke admin
        Mail::to('herdiantoivan45@gmail.com')->send(new ContactMessageMail($validated));


        return back()->with('success', 'Pesan Anda telah terkirim!');
}
}