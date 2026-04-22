<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    /**
     * @OA\Post(
     *     path="/orders/process",
     *     summary="Procesar la compra del carrito actual",
     *     tags={"Pedidos"},
     *     @OA\Response(
     *         response=200,
     *         description="Compra procesada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="order_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Error en el proceso (stock insuficiente, carrito vacío)")
     * )
     */
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Tu carrito está vacío.'], 400);
            }
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Create Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'completed'
            ]);

            // Create Order Items and Discount Stock
            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                
                if ($product->stock < $details['quantity']) {
                    throw new \Exception("Stock insuficiente para el producto: " . $product->name);
                }

                $product->decrement('stock', $details['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => '¡Compra realizada con éxito!',
                    'order_id' => $order->id
                ], 200);
            }

            return redirect()->route('orders.success', $order->id)->with('success', '¡Compra realizada con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 400);
            }
            return redirect()->route('cart.index')->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('orders.success', compact('order'));
    }
}
