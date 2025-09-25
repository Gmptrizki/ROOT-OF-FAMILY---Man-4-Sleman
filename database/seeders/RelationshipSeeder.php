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
            ['code' => 'grandfather_paternal', 'label' => 'Kakek Ayah'],
            ['code' => 'grandmother_paternal', 'label' => 'Nenek Ayah'],
            ['code' => 'grandfather_maternal', 'label' => 'Kakek Ibu'],
            ['code' => 'grandmother_maternal', 'label' => 'Nenek Ibu'],

            ['code' => 'father', 'label' => 'Ayah'],
            ['code' => 'mother', 'label' => 'Ibu'],

            ['code' => 'son', 'label' => 'Anak Laki-laki'],
            ['code' => 'daughter', 'label' => 'Anak Perempuan'],

            ['code' => 'grandson', 'label' => 'Cucu Laki-laki'],
            ['code' => 'granddaughter', 'label' => 'Cucu Perempuan'],

            ['code' => 'brother', 'label' => 'Saudara Laki-laki'],
            ['code' => 'sister', 'label' => 'Saudara Perempuan'],
            ['code' => 'sibling', 'label' => 'Saudara'],

            ['code' => 'spouse', 'label' => 'Pasangan'],
            ['code' => 'husband', 'label' => 'Suami'],
            ['code' => 'wife', 'label' => 'Istri'],

            ['code' => 'uncle_paternal', 'label' => 'Paman Ibu'],
            ['code' => 'aunt_paternal', 'label' => 'Bibi Ibu'],
            ['code' => 'uncle_maternal', 'label' => 'Paman Ayah'],
            ['code' => 'aunt_maternal', 'label' => 'Bibi Ayah'],

            ['code' => 'nephew', 'label' => 'Keponakan Laki-laki'],
            ['code' => 'niece', 'label' => 'Keponakan Perempuan'],
            ['code' => 'cousin', 'label' => 'Sepupu'],
        ];


        foreach ($relations as $r) {
            Relationship::create($r);
        }
    }
}
