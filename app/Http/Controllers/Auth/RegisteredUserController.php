<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $parentFamilyId = null): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'], // tambahan gender
        ]);

        // 1. Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
        ]);

        // 2. Buat Family record
        $family = Family::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'gender' => $request->gender,
            'birth_date' => $user->birth_date,
            'relationship_id' => null,  // bisa diisi sesuai kebutuhan
            'parent_id' => $parentFamilyId ?? null,  // jika parent_id dikirim, gunakan; jika tidak, null
            'spouse_id' => null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Data user dan family berhasil ditambahkan!');
    }
}
