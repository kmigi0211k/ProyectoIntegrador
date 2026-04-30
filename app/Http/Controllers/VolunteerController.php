<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'help_type' => 'required|string|max:255',
            'hours_committed' => 'required|integer|min:1|max:100',
            'details' => 'nullable|string|max:1000'
        ]);

        Volunteer::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'help_type' => $request->help_type,
            'hours_committed' => $request->hours_committed,
            'details' => $request->details,
            'status' => 'pending'
        ]);

        $adminPhone = '573023850997'; 
        $userName = Auth::user()->user_name;
        $mensaje = "¡Hola! Soy {$userName}. Registro de voluntariado para: *{$product->name}*.";
        
        $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $adminPhone . "&text=" . urlencode($mensaje);

        return redirect()->away($whatsappUrl);
    }
}
