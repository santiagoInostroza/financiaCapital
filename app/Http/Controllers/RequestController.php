<?php

namespace App\Http\Controllers;

use App\Models\Request;

class RequestController extends Controller{
    public function saveRequest($propertyId, $userId, $message){
        $request = new Request();
        $request->property_id = $propertyId;
        $request->user_id = $userId;
        $request->message = $message;
        $request->status = 'PENDING';
        $request->save();
    }
}
