<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;

        if ($currentQty + 1 > $product->stock) {
            return redirect()->back()->with('error', 'Lo sentimos, solo quedan ' . $product->stock . ' unidades disponibles de este producto.');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $product = Product::find($request->id);
            if ($request->quantity > $product->stock) {
                session()->flash('error', 'No puedes agregar más de ' . $product->stock . ' unidades.');
                return response()->json(['success' => false]);
            }

            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Carrito actualizado.');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado del carrito.');
        }
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }
}
