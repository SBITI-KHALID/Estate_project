<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offre>
 */
class OffreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Proprietaire' => fake()->name,
            'Location' => fake()->randomElement([
                'Tanger-Tetouan-Al Hoceima',
                'Oriental',
                'Fès-Meknès',
                'Rabat-Salé-Kénitra',
                'Béni Mellal-Khénifra',
                'Casablanca-Settat',
                'Marrakech-Safi',
                'Drâa-Tafilalet',
                'Souss-Massa',
                'Guelmim-Oued Noun',
                'Laâyoune-Sakia El Hamra',
                'Dakhla-Oued Ed-Dahab'
            ]),
            'Category' => fake()->randomElement([
                'Villa', 
                'House', 
                'Apartment', 
                'Condo', 
                'Townhouse', 
                'Cottage', 
                'Mansion',
                'Bungalow',
                'Farmhouse',
                'Chalet',
                'Duplex',
                'Studio',
                'Penthouse',
                'Loft',
                'Castle',
                'Beach House',
                'Ranch',
                'Mobile Home',
                'Treehouse'
            ]),
            'Descreption' => fake()->text(),
            'tel' => "0".fake()->randomElement([5,6, 7]) . fake()->randomNumber(7),
            'Price' => fake()->numberBetween(1000, 300000),
            'Type_Offre' => fake()->randomElement(['Purchase', 'Rental'])
        ];
        
    }
}
