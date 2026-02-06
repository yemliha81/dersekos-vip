<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Event;
use App\Models\Campaign;
use App\Models\VipPackage;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function index()
    {
        
        $cartItems = session()->get('cart', []);

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'];
        }

        return view('cart.index', compact('cartItems', 'totalPrice'));

    }

    public function addToCart(Request $request)
    {
        $itemId = $request->input('package_id');

        //dd($itemId);

        $VipPackage = VipPackage::find($itemId);

        

        $cart = session()->get('cart', []);

        // Check if item already in cart
        foreach ($cart as &$item) {
            if ( $item['id'] === $itemId) {
                return redirect()->back()->with('success', 'Ürün zaten sepetinizde.');
            }
        }

        // Add new item to cart
        $cart[] = [
            'id' => $itemId,
            'name' => $VipPackage->title,
            'price' => $VipPackage->price,
        ];

        session()->put('cart', $cart);

        //calcualte total price
        

        return redirect()->back()->with('success', 'Ürün sepete eklendi.');
    }

    //empty cart function
    public function emptyCart(Request $request)
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Sepet boşaltıldı.');
    }

    //removeFromCart function
    public function removeFromCart(Request $request)
    {
        $itemId = $request->input('item_id');

        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] === $itemId) {
                unset($cart[$key]);
                break;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Ürün sepetten silindi.');
    }

    
}
