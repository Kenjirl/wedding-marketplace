<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function fetchTemplate(Request $req, $type, $value)
    {
        if (in_array($type, [
            'header',
            'quote',
            'profile',
            'event',
            'gallery',
            'wish',
            'footer'
            ]) && preg_match('/^\d+$/', $value)
        ){
            $wedding = WCWedding::with('w_detail')->find($req->input('wedding'));
            if (!$wedding) {
                return response()->json(['error' => 'Data not found'], 404);
            }
            return view("user.wedding-couple.undangan.template.$type.$value", compact('wedding'))->render();
        } else {
            abort(404);
        }
    }
}
