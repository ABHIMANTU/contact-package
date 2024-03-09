<?php

namespace Tech\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Tech\Contact\Mail\ContactMailable;
use Tech\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact::contact');
    }

    public function save(Request $request)
    {
        // Define validation rules
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required',
        //     'message' => 'required|string',
        // ]);

        // Create a new Contact instance with validated data
        $contact = new Contact();
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->phone = $request['phone'];
        $contact->message = $request['message'];

        // Save the contact to the database
        $contact->save();

        // Send email
        Mail::to(config('contact.send_email_to'))->send(new ContactMailable($request->all()));

        // Optionally, you can return a response indicating success
        return redirect()->route('contact')->with('success', 'Contact saved successfully');
    }
}
