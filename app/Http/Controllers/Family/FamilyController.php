<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Relationship;
use Illuminate\Support\Facades\Auth;


class FamilyController extends Controller
{

    public function index()
    {
        $rootFamily = Auth::user()->family()
            ->with(['relationship', 'spouse.relationship', 'children.relationship', 'parent.relationship'])
            ->first();

        $family = Family::where('user_id', '!=', Auth::id())
            ->with(['relationship', 'spouse.relationship', 'parent.relationship'])
            ->get();

        $relationships = Relationship::all();

        return view('family.index', compact('rootFamily', 'family', 'relationships'));
    }


    public function show($userId)
    {
        $user = User::findOrFail($userId);
        $relationships = Relationship::all();
        return view('family.show', compact('user', 'relationships'));
    }


    public function create()
    {
        $relationships = Relationship::all();
        return view('family.create', compact('relationships'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'relationship_id' => ['required', 'exists:relationships,id'],
        ]);

        $parentFamilyId = Auth::user()->family->id;

        Family::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'relationship_id' => $request->relationship_id,
            'parent_id' => $parentFamilyId,
            'spouse_id' => null,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data anggota keluarga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rootFamily = Auth::user()->family()
            ->with(['spouse', 'children', 'parent'])
            ->first();

        $families = Family::where('user_id', Auth::id())->get();
        $relationships = Relationship::all();

        $family = Family::findOrFail($id);

        return view('family.edit', compact('rootFamily', 'families', 'family', 'relationships'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'birth_date' => ['nullable', 'date'],
            'relationship_id' => ['required', 'exists:relationships,id'],
        ]);

        $family = Family::findOrFail($id);
        $family->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'relationship_id' => $request->relationship_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data anggota keluarga berhasil diperbarui!');
    }


    public function destroy(string $id)
    {
        $family = Family::findOrFail($id);
        $family->delete();
        return redirect()->route('dashboard')->with('success', 'Data anggota keluarga berhasil dihapus!');
    }
}
