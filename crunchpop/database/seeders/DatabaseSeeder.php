<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Admin user ----------------------------------------------------
        User::updateOrCreate(
            ['email' => 'admin@crunchpop.test'],
            [
                'name'     => 'CrunchPop Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // ---- Categories ----------------------------------------------------
        $candy = Category::updateOrCreate(
            ['slug' => 'freeze-dried-candy'],
            ['name' => 'Freeze-Dried Candy', 'sort_order' => 1, 'is_active' => true,
             'description' => 'Bright, crunchy, shelf-stable freeze-dried candy.']
        );

        $bundles = Category::updateOrCreate(
            ['slug' => 'multi-packs'],
            ['name' => 'Multi-Packs & Bundles', 'sort_order' => 2, 'is_active' => true,
             'description' => 'Save more with multi-packs for sharing, families, and events.']
        );

        $snacks = Category::updateOrCreate(
            ['slug' => 'snacks'],
            ['name' => 'Freeze-Dried Snacks', 'sort_order' => 3, 'is_active' => true,
             'description' => 'Naturally sweet freeze-dried snack options.']
        );

        // ---- Products ------------------------------------------------------
        $allergen = 'Made in a facility that may also handle milk, soy, wheat, and tree nuts. See bag for full allergen details.';
        $sourIngredients = 'Freeze-dried sour rainbow candy (sugar, corn syrup, modified corn starch, citric acid, natural and artificial flavors, colors).';

        $products = [
            [
                'name' => 'Sour Rainbow Crunchers — 2 oz Bag',
                'category_id' => $candy->id,
                'tagline' => 'Bright, crunchy, sour freeze-dried candy with a big pop of flavor.',
                'description' => 'Our signature freeze-dried sour rainbow candy in a grab-and-go 2 oz bag. Light, airy, and impossibly crunchy with an intense sour-sweet pop.',
                'size' => '2 oz bag', 'price' => 6.99, 'pack_quantity' => 1,
                'ingredients' => $sourIngredients, 'allergen_info' => $allergen,
                'badge' => 'Fan Favorite', 'is_featured' => true, 'sort_order' => 1,
            ],
            [
                'name' => 'Sour Rainbow Crunchers — 4 oz Bag',
                'category_id' => $candy->id,
                'tagline' => 'Double the crunch for serious candy lovers.',
                'description' => 'The same bright, sour crunch you love in a bigger 4 oz bag. Perfect for sharing — or not.',
                'size' => '4 oz bag', 'price' => 11.99, 'pack_quantity' => 1,
                'ingredients' => $sourIngredients, 'allergen_info' => $allergen,
                'badge' => null, 'is_featured' => true, 'sort_order' => 2,
            ],
            [
                'name' => 'Sour Rainbow Crunchers — 4-Pack',
                'category_id' => $bundles->id,
                'tagline' => 'Great for sharing or trying more than one bag.',
                'description' => 'Four 2 oz bags of Sour Rainbow Crunchers. Great for sharing or stocking up.',
                'size' => '4 × 2 oz bags', 'price' => 25.99, 'pack_quantity' => 4,
                'ingredients' => $sourIngredients, 'allergen_info' => $allergen,
                'badge' => 'Save 7%', 'is_bundle' => true, 'sort_order' => 3,
            ],
            [
                'name' => 'Sour Rainbow Crunchers — 6-Pack',
                'category_id' => $bundles->id,
                'tagline' => 'A better value for families, parties, or gifts.',
                'description' => 'Six 2 oz bags of Sour Rainbow Crunchers. A better value for families, parties, or gifts.',
                'size' => '6 × 2 oz bags', 'price' => 36.99, 'pack_quantity' => 6,
                'ingredients' => $sourIngredients, 'allergen_info' => $allergen,
                'badge' => 'Popular', 'is_bundle' => true, 'is_featured' => true, 'sort_order' => 4,
            ],
            [
                'name' => 'Sour Rainbow Crunchers — 8-Pack',
                'category_id' => $bundles->id,
                'tagline' => 'Best value for groups, events, or candy lovers.',
                'description' => 'Eight 2 oz bags of Sour Rainbow Crunchers. Best value for groups, events, or serious candy lovers.',
                'size' => '8 × 2 oz bags', 'price' => 46.99, 'pack_quantity' => 8,
                'ingredients' => $sourIngredients, 'allergen_info' => $allergen,
                'badge' => 'Best Value', 'is_bundle' => true, 'sort_order' => 5,
            ],
            [
                'name' => 'Freeze-Dried Banana Slices',
                'category_id' => $snacks->id,
                'tagline' => 'A naturally sweet snack option coming soon.',
                'description' => 'Naturally sweet, crunchy freeze-dried banana slices. A wholesome snack option — coming soon to CrunchPop.',
                'size' => 'Coming soon', 'price' => 0, 'pack_quantity' => 1,
                'ingredients' => 'Freeze-dried bananas.', 'allergen_info' => $allergen,
                'badge' => 'Coming Soon', 'is_coming_soon' => true, 'sort_order' => 6,
            ],
            [
                'name' => 'More CrunchPop Treats',
                'category_id' => $candy->id,
                'tagline' => 'New freeze-dried candy flavors and snack options are on the way.',
                'description' => 'We are always cooking up new freeze-dried candy flavors and snack options. Join the early list to be first to know.',
                'size' => 'Coming soon', 'price' => 0, 'pack_quantity' => 1,
                'ingredients' => null, 'allergen_info' => null,
                'badge' => 'Coming Soon', 'is_coming_soon' => true, 'sort_order' => 7,
            ],
        ];

        foreach ($products as $data) {
            $existing = Product::where('name', $data['name'])->first();
            $data['slug'] = $existing?->slug ?? Product::uniqueSlug($data['name']);
            $data['is_active'] = true;
            Product::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
