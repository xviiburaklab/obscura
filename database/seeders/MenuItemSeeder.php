<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['course' => 1,'title' => 'Burnt Butter & Sea','description' => 'Black garlic emulsion, sea urchin, Ossetra caviar, micro shiso'],
            ['course' => 2,'title' => 'Obsidian Stone','description' => 'Squid ink cracker, smoked eel, compressed cucumber, dill oil, frozen horseradish snow'],
            ['course' => 3,'title' => 'Forest After Rain','description' => '72-hour mushroom consommé, truffle custard, dehydrated porcini, hazelnut foam'],
            ['course' => 4,'title' => 'Aegean Drift','description' => 'Slow-poached turbot, saffron beurre blanc, fennel ash, ikura, preserved lemon gel'],
            ['course' => 5,'title' => 'Cold Earth','description' => 'Frozen beet sorbet, goat cheese snow, black pepper oil'],
            ['course' => 6,'title' => 'The Long Wait','description' => '72-hour sous vide lamb, truffle dust, gold leaf, bone marrow jus, smoked potato purée'],
            ['course' => 7,'title' => 'Dark Chambers','description' => '120-day dry-aged A5 wagyu, activated charcoal crust, aged sherry reduction, wasabi emulsion'],
            ['course' => 8,'title' => 'Old Silence','description' => 'Selection of three aged cheeses, quince in black tea, walnut praline, honeycomb'],
            ['course' => 9,'title' => 'Midnight Smoke','description' => 'Smoked butter ice cream, fleur de sel, aged balsamic, dark chocolate soil'],
            ['course' => 10,'title' => 'The Void','description' => 'Single origin 100% cacao tart, black sesame cream, yuzu gelée, edible 24k gold leaf'],
        ];

        foreach ($items as $item) {
            \App\Models\MenuItem::create(array_merge($item, ['is_active' => true, 'sort_order' => $item['course']]));
        }
    }
}
