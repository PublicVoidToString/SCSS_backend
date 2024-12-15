<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfferType;

class OfferTypeSeeder extends Seeder
{
    public function run()
    {
        $offerTypes = [
            ['name' => 'Staż/Praktyka', 'description' => 'Praca mająca na celu wprowadzenie do zawodu.'],
            ['name' => 'Sezonowa', 'description' => 'Praca wykonywana tylko przez część roku.'],
            ['name' => 'Weekendowa', 'description' => 'Praca wykonywana tylko w weekendy.'],
            ['name' => 'Pełny etat', 'description' => 'Praca wykonywana 40 godzin tygodniowo.'],
            ['name' => 'Pół etatu', 'description' => 'Praca wykonywana 20 godzin tygodniowo.'],
            ['name' => 'Inny', 'description' => 'Inny rodzaj pracy, do ustalenia.'],
        ];

        foreach ($offerTypes as $type) {
            OfferType::create($type);
        }
    }
}
