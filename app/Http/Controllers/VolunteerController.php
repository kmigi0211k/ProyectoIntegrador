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

        // Número de WhatsApp del administrador (o la tienda)
        $adminPhone = '573023850997'; // Reemplazar con el número real de la tienda
        
        $userName = Auth::user()->user_name;
        $mensaje = "¡Hola! Soy {$userName}. Acabo de registrarme en la plataforma para realizar un voluntariado de {$request->hours_committed} horas haciendo '{$request->help_type}' a cambio del producto: *{$product->name}*. ¡Quiero coordinar los detalles!";
        
        $whatsappUrl = "https://api.whatsapp.com/send?phone=" . $adminPhone . "&text=" . urlencode($mensaje);

        // Redirigir directamente a WhatsApp
        return redirect()->away($whatsappUrl);
    }
}
