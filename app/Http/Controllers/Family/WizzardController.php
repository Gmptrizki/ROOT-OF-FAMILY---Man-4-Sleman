<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class WizzardController extends Controller
{
    public function indexFather()
    {
        return view('family.partials.wizzard.father');
    }

    public function storeFather(Request $request)
    {
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Ayah belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = 'father_' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard.wizzard.mother')->with('success', 'Data Ayah berhasil disimpan!');
    }

    public function indexMother()
    {
        return view('family.partials.wizzard.mother');
    }

    public function storeMother(Request $request)
    {
        $relationship = Relationship::where('code', 'mother')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Ibu belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = 'mother' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard.wizzard.grandfa')->with('success', 'Data Ibu berhasil disimpan!');
    }

    public function indexGrandFather()
    {
        return view('family.partials.wizzard.grandfa');
    }


    public function storeGrandFa(Request $request)
    {
        $relationship = Relationship::where('code', 'grandfa')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Ibu belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = 'grandfa' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard.wizzard.grandmom')->with('success', 'Data Kakek berhasil disimpan!');
    }


    public function indexGrandMother()
    {
        return view('family.partials.wizzard.grandmom');
    }

    public function storeGrandMom(Request $request)
    {
        $relationship = Relationship::where('code', 'grandmom')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Nenek belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = 'grandmom' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard')->with('success', 'Data Nenek berhasil disimpan!');
    }

    public function indexBrother()
    {
        return view('family.partials.wizzard.brother');
    }

    public function storeBrother(Request $request)
    {
        $relationship = Relationship::where('code', 'brother')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Ibu belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = 'brother' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('family.create.sister')->with('success', 'Data Saudara Laki-Laki berhasil disimpan!');
    }


    public function indexSister()
    {
        return view('family.partials.wizzard.sister');
    }

    public function storeSister(Request $request)
    {
        $relationship = Relationship::where('code', 'sister')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Saudara Perempuan belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'sister' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('family-photos', $photoName, 'public');
        }

        $data = [
            'user_id'          => Auth::id(),
            'name'             => $validated['name'],
            'birth_date'       => $validated['birth_date'] ?? null,
            'status'           => $validated['status'] ?? null,
            'note'             => $validated['notes'] ?? null,
            'relationship_id'  => $relationship->id,
            'photo'            => $photoPath,
            'parent_id'        => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard')->with('success', 'Data Saudara Perempuan berhasil disimpan!');
    }
}
