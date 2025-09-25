<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Relationship;
use App\Models\Family;

class FamilyHelper
{
    public static function getFamilyTree($userId = null)
    {
        $user = $userId ? \App\Models\User::find($userId) : Auth::user();
        
        if (!$user) {
            return self::getDefaultFamilyTree();
        }

        // Ambil data dari database menggunakan model Family
        $familyData = self::getFamilyFromDatabase($user);
        
        return $familyData ?: self::getDefaultFamilyTree($user);
    }

    private static function getFamilyFromDatabase($user)
    {
        try {
            // Ambil data keluarga user dari model Family
            $userFamily = Family::where('user_id', $user->id)->first();
            
            if (!$userFamily) {
                return null;
            }

            // Bangun struktur tree dari data Family
            return self::buildTreeFromFamily($userFamily);
            
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function buildTreeFromFamily($userFamily)
    {
        $tree = [];

        $tree['level_0'] = [
            'user' => [
                'name' => $userFamily->name,
                'relationship' => 'self',
                'photo' => $userFamily->photo,
                'gender' => $userFamily->gender,
                'birth_date' => $userFamily->birth_date,
            ]
        ];

        // Ambil pasangan jika ada
        if ($userFamily->spouse) {
            $tree['level_0']['user']['spouse'] = [
                'name' => $userFamily->spouse->name,
                'relationship' => 'spouse',
                'photo' => $userFamily->spouse->photo,
                'gender' => $userFamily->spouse->gender,
                'birth_date' => $userFamily->spouse->birth_date,
            ];
        }

        // Ambil orang tua jika ada
        if ($userFamily->parent) {
            $parent = $userFamily->parent;
            $tree['level_1'] = [
                'parents' => [
                    'father' => [
                        'name' => $parent->name,
                        'relationship' => $parent->relationship->code ?? 'parent',
                        'photo' => $parent->photo,
                        'gender' => $parent->gender,
                        'birth_date' => $parent->birth_date,
                    ]
                ]
            ];

            // Ambil pasangan orang tua (ibu)
            if ($parent->spouse) {
                $tree['level_1']['parents']['mother'] = [
                    'name' => $parent->spouse->name,
                    'relationship' => $parent->spouse->relationship->code ?? 'parent',
                    'photo' => $parent->spouse->photo,
                    'gender' => $parent->spouse->gender,
                    'birth_date' => $parent->spouse->birth_date,
                ];
            }

            // Ambil kakek/nenek (level 2) jika ada
            if ($parent->parent) {
                $grandparent = $parent->parent;
                $tree['level_2'] = [
                    'paternal' => [
                        'name' => $grandparent->name . ' & ' . ($grandparent->spouse->name ?? 'Pasangan'),
                        'relationship' => 'grandparent',
                        'photo' => null,
                    ]
                ];
            }
        }

        // Ambil anak-anak (level -1)
        $children = $userFamily->children;
        if ($children->isNotEmpty()) {
            $tree['level_-1'] = ['children' => []];
            foreach ($children as $child) {
                $tree['level_-1']['children'][$child->relationship->code ?? 'child'] = [
                    'name' => $child->name,
                    'relationship' => $child->relationship->code ?? 'child',
                    'photo' => $child->photo,
                    'gender' => $child->gender,
                    'birth_date' => $child->birth_date,
                ];
            }
        }

        return $tree;
    }

    private static function getDefaultFamilyTree($user = null)
    {
        return [
            'level_2' => [
                'paternal' => [
                    'name' => 'Kakek & Nenek Paternal',
                    'relationship' => 'grandparent',
                    'photo' => null,
                ],
                'maternal' => [
                    'name' => 'Kakek & Nenek Maternal', 
                    'relationship' => 'grandparent',
                    'photo' => null,
                ]
            ],
            'level_1' => [
                'parents' => [
                    'father' => [
                        'name' => 'Ayah',
                        'relationship' => 'father',
                        'photo' => null,
                    ],
                    'mother' => [
                        'name' => 'Ibu', 
                        'relationship' => 'mother',
                        'photo' => null,
                    ]
                ],
            ],
            'level_0' => [
                'user' => [
                    'name' => $user ? $user->name : 'Saya',
                    'relationship' => 'self',
                    'photo' => $user ? $user->photo : null,
                    'spouse' => [
                        'name' => 'Pasangan',
                        'relationship' => 'spouse',
                        'photo' => null
                    ]
                ]
            ],
            'level_-1' => [
                'children' => [
                    'son' => [
                        'name' => 'Anak Laki-laki',
                        'relationship' => 'son', 
                        'photo' => null
                    ],
                    'daughter' => [
                        'name' => 'Anak Perempuan',
                        'relationship' => 'daughter',
                        'photo' => null
                    ]
                ],
            ]
        ];
    }

    public static function getAllRelationships()
    {
        return Relationship::all()->pluck('label', 'code')->toArray();
    }

    public static function getRelationshipLabel($code)
    {
        $relationship = Relationship::where('code', $code)->first();
        return $relationship ? $relationship->label : ucfirst(str_replace('_', ' ', $code));
    }

    // Helper untuk mendapatkan opsi relationship berdasarkan gender
    public static function getRelationshipOptions($gender = null)
    {
        $relationships = Relationship::all();
        
        if ($gender) {
            // Filter relationships berdasarkan gender jika diperlukan
            return $relationships->filter(function($rel) use ($gender) {
                return self::isRelationshipGenderCompatible($rel->code, $gender);
            })->pluck('label', 'code')->toArray();
        }
        
        return $relationships->pluck('label', 'code')->toArray();
    }

    private static function isRelationshipGenderCompatible($relationshipCode, $gender)
    {
        // Logika kompatibilitas gender dengan relationship
        $maleRelationships = ['father', 'son', 'grandfather_paternal', 'grandfather_maternal', 'brother', 'husband', 'uncle_paternal', 'uncle_maternal', 'nephew'];
        $femaleRelationships = ['mother', 'daughter', 'grandmother_paternal', 'grandmother_maternal', 'sister', 'wife', 'aunt_paternal', 'aunt_maternal', 'niece'];
        
        if ($gender === 'male') {
            return in_array($relationshipCode, $maleRelationships);
        } elseif ($gender === 'female') {
            return in_array($relationshipCode, $femaleRelationships);
        }
        
        return true;
    }
}