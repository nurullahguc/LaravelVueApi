<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::all();

        return response()->json([
            'contacts' => $contacts,
            'message' => 'Contacts',
            'code' => 200
        ], 200);
    }

    public function saveContact(Request $request)
    {

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;

        $contact->save();

        return response()->json([
            'message' => 'Contact Created Successfully!',
            'code' => 200,
        ], 200);

    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);

        if ($contact) {
            $contact->delete();
            return response()->json(['message' => 'Contact deleted Successfully', 'code' => 200], 200);
        } else {
            return response()->json(['message' => "Contact with id:$id does not exists", 'code' => 404], 404);
        }
    }

    public function getContact($id)
    {
        $contact = Contact::find($id);

        if (!$contact)
            return response()->json(['status' => 404, 'message' => 'Contact not found!'], 404);

        return response()->json($contact);
    }

    public function updateContact(Request $request, $id)
    {
        $contact = Contact::find($id);

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;

        $contact->save();

        return response()->json([
            'message' => 'Contact Updated Successfully!',
            'code' => 200,
        ], 200);
    }

    public function profile_info()
    {
        $user = Auth::user();

        return response()->json(['status' => 200, 'user' => $user], 200);
    }

}
