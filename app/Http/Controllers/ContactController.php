<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
class ContactController extends Controller
{
    //
    public function getContactNotViewed()
{
    $contacts = Contact::orderBy('created_at', 'desc')->where('status','Not Viewed')->get();
    
   
    return view('admin.contact.list-contact-not-viewed', compact('contacts'));
}
public function getContactViewed()
{
    $contacts = Contact::orderBy('created_at', 'desc')->get()->where('status','Viewed');
    return view('admin.contact.list-contact-viewed', compact('contacts'));
}
public function getContactReplied()
{
    $contacts = Contact::orderBy('created_at', 'desc')->get()->where('status','Replied');
    return view('admin.contact.list-contact-replied', compact('contacts'));
}
    public function showMessage($id)
    {
        $contact = Contact::find($id); // Assuming Contact is your Eloquent model for contacts
        // Cập nhật trạng thái đã xem
        if($contact->status!='Replied'){
            $contact->status = 'Viewed';
        $contact->save();
        }
        
        return view('admin.contact.show-contact', compact('contact'));
    }
    public function sendResponse(Request $request, $id)
{
    $contact = Contact::find($id);
       
    $validatedData = $request->validate([
        'response' => 'required|string',
    ]);

    // Cập nhật trạng thái đã phản hồi trước khi gửi email
    if($contact->status!="Replied"){
        $contact->status = 'Replied';
        $contact->save();
    }

    // Send email to the customer
    Mail::to($contact->email)->send(new ContactResponse($request->response, $contact->name));
    Session::flash('success', 'Đã phản hồi thành công .');
    // Assuming you want to redirect back to the contact message page after sending the response
    return view('admin.contact.show-contact', compact('contact'));
}


}
