<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 1,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
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
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Ibu belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 2,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
        ];


        Family::create($data);

        return redirect()->route('dashboard.wizzard.grandfa')->with('success', 'Data Ibu berhasil disimpan!');
    }

    public function indexGrandFather()
    {
        return view('family.partials.wizzard.grandfa');
    }


    public function storeGrandfa(Request $request)
    {
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Kakek belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 3,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
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
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Nenek belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 4,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
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
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Saudara Laki-Laki belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 5,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
        ];


        Family::create($data);

        return redirect()->route('dashboard.wizzard.sister')->with('success', 'Data Saudara Laki-Laki berhasil disimpan!');
    }


    public function indexSister()
    {
        return view('family.partials.wizzard.sister');
    }

    public function storeSister(Request $request)
    {
        $relationship = Relationship::where('code', 'father')->first();

        if (!$relationship) {
            return redirect()->back()->with('error', 'Relationship Saudara Perempuan belum tersedia di database.');
        }

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'        => Auth::id(),
            'name'           => $validated['name'],
            'birth_date'     => $validated['birth_date'] ?? null,
            'status'         => $validated['status'] ?? null,
            'note'           => $validated['notes'] ?? null,
            'relationship_id' => 6,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
        ];


        Family::create($data);

        return redirect()->route('dashboard')->with('success', 'Data Saudara Perempuan berhasil disimpan!');
    }
}
