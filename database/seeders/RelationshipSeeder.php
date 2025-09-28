<?php

namespace Database\Seeders;

use App\Models\Relationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relations = [
            ['code' => 'father', 'label' => 'Ayah'],
            ['code' => 'mother', 'label' => 'Ibu'],

            ['code' => 'grandfa', 'label' => 'Kakek'],
            ['code' => 'grandma', 'label' => 'Nenek'],

            ['code' => 'brother', 'label' => 'Saudara Laki-Laki'],
            ['code' => 'sister', 'label' => 'Saudara Perempuan'],

            ['code' => 'husband', 'label' => 'Suami'],
            ['code' => 'wife', 'label' => 'Istri'],

            ['code' => 'child', 'label' => 'Anak'],
        ];

        foreach ($relations as $r) {
            Relationship::create($r);
        }
    }
}
