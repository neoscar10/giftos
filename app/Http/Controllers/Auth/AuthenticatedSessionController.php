<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cart;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $user = Auth::user();

        // Synchronize the cart
        $sessionCart = session()->get('cart', []);
        foreach ($sessionCart as $product_id => $item) {
            $existingCartItem = Cart::where('user_id', $user->id)
                                    ->where('product_id', $product_id)
                                    ->first();

            if ($existingCartItem) {
                $existingCartItem->quantity += $item['quantity'];
                $existingCartItem->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product_id,
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Clear the session cart
        session()->forget('cart');

        $request->session()->regenerate();

        return redirect()->intended();
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
