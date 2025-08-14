<?php

namespace Database\Seeders;

use App\Models\AdType;
use Illuminate\Database\Seeder;
use App\Models\PropertyCategory;
use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PropertyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Ad Types only if they do not exist
        $rent = AdType::firstOrCreate(['name' => 'rent'],['orders' => 2],['show_in_navbar' => 1]);
        $sale = AdType::firstOrCreate(['name' => 'sale'],['orders' => 1],['show_in_navbar' => 1]);
        $share = AdType::firstOrCreate(['name' => 'share'],['orders' => 3],['show_in_navbar' => 0]);

        // Insert Property Categories
        $residential = PropertyCategory::firstOrCreate(['name' => 'residential']);
        $commercial = PropertyCategory::firstOrCreate(['name' => 'commercial']);

        // Property types mapping
        $propertyTypes = [
            'residential' => [
                ['name' => 'house', 'show_in_navbar' => 1, 'ad_types' => [$rent->id, $sale->id]],
                ['name' => 'apartment', 'show_in_navbar' => 1, 'ad_types' => [$rent->id, $sale->id]],
                ['name' => 'duplex', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'penthouse', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'terrace house', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'semi detached', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'detached', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'country house', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'studio', 'show_in_navbar' => 1, 'ad_types' => [$rent->id]],
                ['name' => 'flat', 'show_in_navbar' => 0, 'ad_types' => [$rent->id]]
            ],
            'commercial' => [
                ['name' => 'office', 'show_in_navbar' => 1, 'ad_types' => [$rent->id]],
                ['name' => 'industrial', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'business', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'investment', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'pubs & restaurants', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'hotels & resorts', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'retail', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]],
                ['name' => 'farm land', 'show_in_navbar' => 1, 'ad_types' => [$sale->id]],
                ['name' => 'developement land', 'show_in_navbar' => 1, 'ad_types' => [$sale->id]],
                ['name' => 'parking space', 'show_in_navbar' => 1, 'ad_types' => [$rent->id, $sale->id]],
                ['name' => 'live work-units', 'show_in_navbar' => 0, 'ad_types' => [$sale->id]]
            ]
        ];

        // Insert Property Types and Attach Ad Types
        foreach ($propertyTypes as $categoryName => $types) {
            $category = PropertyCategory::where('name', $categoryName)->first();

            foreach ($types as $typeData) {
                // Insert Property Type if not exists
                $propertyType = $category->propertyTypes()->firstOrCreate([
                    'name' => $typeData['name']
                ], [
                    'show_in_navbar' => $typeData['show_in_navbar']
                ]);

                // Attach Property Type to Ad Types only if not already attached
                $propertyType->adTypes()->syncWithoutDetaching($typeData['ad_types']);
            }
        }

        // Attach Property Categories to Ad Types
        $rent->propertyCategories()->syncWithoutDetaching([$residential->id, $commercial->id]);
        $sale->propertyCategories()->syncWithoutDetaching([$residential->id, $commercial->id]);
        $share->propertyCategories()->syncWithoutDetaching([$residential->id]);

     }
}
