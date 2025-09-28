<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relationship;
use Illuminate\Support\Facades\Auth;


class FamilyController extends Controller
{

    public function index()
    {
        $userId = Auth::id();

        $rootFamily = Auth::user()->family()
            ->with(['relationship', 'children.relationship', 'parent.relationship'])
            ->first();

        $family = Family::where('user_id', '!=', $userId)
            ->with(['relationship', 'parent.relationship'])
            ->get();

        $relations = Family::where('user_id', $userId)
            ->whereIn('relationship_id', [1, 2, 3, 4, 5, 6])
            ->get()
            ->keyBy('relationship_id');

        $father      = $relations->get(1);
        $mother      = $relations->get(2);
        $grandfa = $relations->get(3);
        $grandmom = $relations->get(4);
        $brother     = $relations->get(5);
        $sister      = $relations->get(6);

        $relationships = Relationship::all();

        return view('family.index', compact(
            'rootFamily',
            'family',
            'relationships',
            'father',
            'mother',
            'grandfa',
            'grandmom',
            'brother',
            'sister'
        ));
    }

    public function createBrother()
    {
        return view('family.create-brother');
    }
    public function createSister()
    {
        return view('family.create-sister');
    }

    public function storeBrother(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'         => Auth::id(),
            'name'            => $validated['name'],
            'birth_date'      => $validated['birth_date'] ?? null,
            'status'          => $validated['status'] ?? null,
            'note'            => $validated['notes'] ?? null,
            'relationship_id' => 5,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('family.create.sister')->with('success', 'Saudara Laki-Laki berhasil ditambahkan!');
    }

    public function storeSister(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'status'     => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        $userFamily = Family::where('user_id', Auth::id())->first();

        $data = [
            'user_id'         => Auth::id(),
            'name'            => $validated['name'],
            'birth_date'      => $validated['birth_date'] ?? null,
            'status'          => $validated['status'] ?? null,
            'note'            => $validated['notes'] ?? null,
            'relationship_id' => 6,
            'parent_id'       => $userFamily ? $userFamily->parent_id : null,
        ];

        Family::create($data);

        return redirect()->route('dashboard')->with('success', 'Saudara Perempuan berhasil ditambahkan!');
    }

    public function editTree()
    {
        $userId = Auth::id();

        $familyMembers = Family::where('user_id', $userId)
            ->with('relationship')
            ->get();

        $relationships = Relationship::all();

        return view('family.edit-tree', compact('familyMembers', 'relationships'));
    }

    public function updateTree(Request $request)
    {
        $validated = $request->validate([
            'families.*.id'             => 'required|exists:families,id',
            'families.*.name'           => 'required|string|max:255',
            'families.*.birth_date'     => 'nullable|date',
            'families.*.status'         => 'nullable|string',
            'families.*.notes'          => 'nullable|string',
            'families.*.relationship_id' => 'required|exists:relationships,id',
        ]);

        foreach ($validated['families'] as $data) {
            $family = Family::where('user_id', Auth::id())
                ->where('id', $data['id'])
                ->first();

            if ($family) {
                $family->update([
                    'name'            => $data['name'],
                    'birth_date'      => $data['birth_date'] ?? null,
                    'status'          => $data['status'] ?? null,
                    'note'            => $data['notes'] ?? null,
                    'relationship_id' => $data['relationship_id'],
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Data keluarga berhasil diperbarui!');
    }
}
