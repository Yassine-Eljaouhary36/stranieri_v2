<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingAddressController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [ 
            'address_one' => 'required|string|min:5|max:255', 
            'address_two' => 'nullable|string|max:255',
            'country' => 'required|alpha|min:2|max:2', 
            'city' => 'required|string|min:2|max:100', 
            'zip' => 'required|string|min:3|max:100', 
        ]);
     
        $client = Auth::guard('client')->user();
        if(!$client->billingAddress){
            $client->billingAddress()->create([
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'country' => $request->country,
                'city' => $request->city,
                'zip' => $request->zip,
            ]);
        }

        return redirect()->back()->with('custom_alert', ['type' => 'success', 'title' => 'Thank you your billing address!', 'message' => 'the billing address has been successfully added.']);
    }
}
