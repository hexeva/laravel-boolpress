<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// includo il model Lead
use App\Lead;
// includo LE MAIL
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactMail;
// includo il validator per fare validazione manualmente
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        // dd($data);
        

        // api Validation
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            // Errori di validazione
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }
        // 1 - salvo il nuovo Lead nel database

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        return response()->json([
            'success' => true,
            
        ]);
  

        

        // 2- inviare la mail al customer service
        Mail::to('customer-service@boolpress.it')->send(new NewContactMail($new_lead));
    }
}
