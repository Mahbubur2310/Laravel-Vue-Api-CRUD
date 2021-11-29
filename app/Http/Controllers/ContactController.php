<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContacts()
    {
        $contacts = Contact::all();
        return response()->json($contacts);

    }
    public function saveContact(Request  $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:contacts,email'
        ]);
        
        $contact = new Contact;
        if($request->has('image') && !empty($request->image)){
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/gallery'),$filename);
            $contact->image = $filename;
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('images/gallery'),$imageName);
            // $path = ('images/gallery/'.$imageName);
            // $contact->image = $path;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;

        if($contact->save()){
            return response()->json(['status'=>true,'message' =>'Contact Added Successfully']);
            
        }else{
            return response()->json(['status'=>false,'message' =>'There is some Problem, Please try again']);
        }
    }

    public function getContact($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);

        
    }

    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        @unlink(public_path('images/gallery/'.$contact->image));
        if ($contact->delete()) {
            return response()->json(['status'=>true,'message' =>'Contact Deleted Successfully']);
        }else{
            return response()->json(['status'=>false,'message' =>'Something went worng']);
        }
    }

    public function updateContact(Request  $request, $id)
    {
        $contact = Contact::where('id',$id)->first();
        
        if($request->has('image') && !empty($request->image)){
            $file = $request->file('image');
            @unlink(public_path('images/gallery/'.$contact->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/gallery/'),$filename);
            $contact->image = $filename;

            //@unlink(public_path('images/gallery/'.$contact->image));
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(public_path('images/gallery'),$imageName);
            // $path = ('images/gallery/'.$imageName);
            // $contact->image = $path;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;

        if($contact->save()){
            return response()->json(['status'=>true,'message' =>'Contact Updated Successfully']);
            
        }else{
            return response()->json(['status'=>false,'message' =>'There is some Problem, Please try again']);
        }
    }
}
