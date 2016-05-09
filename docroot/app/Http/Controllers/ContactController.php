<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller {

    public function store(ContactFormRequest $request)
    {
        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'phone' => $request->get('phone'),
            'user_message' => $request->get('message')
        );

        \Mail::send('emails.contact',
            $data,
            function($message) use ($data)
            {
                $message->from($data['email'] , $data['name']);
                $message->to('office@evocasainvest.ro', 'Office Evocasa Invest')->subject($data['subject']);
            }
        );

        return redirect('contact')->with('success',1);
    }
}
