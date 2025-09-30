<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AllProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            ['name' => 'Mojito', 'ingredients' => 'Ром, лайм, мята, сахарный сироп, содовая', 'image_path' => 'drinks/mojito.jpg', 'price' => 250.00, 'is_alcoholic' => true],
            ['name' => 'Margarita', 'ingredients' => 'Текила, Triple Sec, лайм', 'image_path' => 'drinks/margarita.jpg', 'price' => 300.00, 'is_alcoholic' => true],
            ['name' => 'Negroni', 'ingredients' => 'Джин, Campari, вермут', 'image_path' => 'drinks/negroni.jpg', 'price' => 320.00, 'is_alcoholic' => true],
            ['name' => 'Espresso Martini', 'ingredients' => 'Водка, эспрессо, кофейный ликер', 'image_path' => 'drinks/espresso_martini.jpg', 'price' => 270.00, 'is_alcoholic' => true],
            ['name' => 'Aperol Spritz', 'ingredients' => 'Просекко, Aperol, сода', 'image_path' => 'drinks/aperol_spritz.jpg', 'price' => 260.00, 'is_alcoholic' => true],
            ['name' => 'Bombardino', 'ingredients' => 'Бренди, яичный ликер', 'image_path' => 'drinks/bombardino.jpg', 'price' => 280.00, 'is_alcoholic' => true],
            ['name' => 'Old Fashioned', 'ingredients' => 'Бурбон, сахар, биттер', 'image_path' => 'drinks/old_fashioned.jpg', 'price' => 350.00, 'is_alcoholic' => true],
            ['name' => 'Cosmopolitan', 'ingredients' => 'Водка, Cointreau, клюквенный сок', 'image_path' => 'drinks/cosmopolitan.jpg', 'price' => 310.00, 'is_alcoholic' => true],
            ['name' => 'Daiquiri', 'ingredients' => 'Ром, сок лайма, сахарный сироп', 'image_path' => 'drinks/daiquiri.jpg', 'price' => 280.00, 'is_alcoholic' => true],
            ['name' => 'Whiskey Sour', 'ingredients' => 'Виски, лимон, сахар, белок', 'image_path' => 'drinks/whiskey_sour.jpg', 'price' => 290.00, 'is_alcoholic' => true],
        ]);

         DB::table('pizzas')->insert([
            ['name' => 'Margherita', 'ingredients' => 'Томат, моцарелла, базилик', 'image_path' => 'pizza/margherita.jpg', 'price' => 450.00],
            ['name' => 'Quattro Formaggi', 'ingredients' => 'Моцарелла, горгонзола, пармезан, эмменталь', 'image_path' => 'pizza/quattro_formaggi.jpg', 'price' => 550.00],
            ['name' => 'Capricciosa', 'ingredients' => 'Томаты, моцарелла, ветчина, артишоки, грибы', 'image_path' => 'pizza/capricciosa.jpg', 'price' => 520.00],
            ['name' => 'Prosciutto e Rucola', 'ingredients' => 'Томаты, моцарелла, прошутто, руккола', 'image_path' => 'pizza/prosciutto_rucola.jpg', 'price' => 580.00],
            ['name' => 'Quattro Stagioni', 'ingredients' => 'Разные топпинги по секциям', 'image_path' => 'pizza/quattro_stagioni.jpg', 'price' => 600.00],
            ['name' => 'Napoli', 'ingredients' => 'Моцарелла, анчоусы, каперсы', 'image_path' => 'pizza/napoli.jpg', 'price' => 500.00],
            ['name' => 'Vegetariana', 'ingredients' => 'Овощи, томаты, моцарелла', 'image_path' => 'pizza/vegetariana.jpg', 'price' => 470.00],
            ['name' => 'Calzone', 'ingredients' => 'Моцарелла, ветчина, томаты (внутри)', 'image_path' => 'pizza/calzone.jpg', 'price' => 520.00],
            ['name' => 'Diavola', 'ingredients' => 'Моцарелла, салями, чили', 'image_path' => 'pizza/diavola.jpg', 'price' => 530.00],
            ['name' => 'Pizza alla Bufala', 'ingredients' => 'Моцарелла из буйволиного молока, базилик', 'image_path' => 'pizza/alla_bufala.jpg', 'price' => 600.00],
        ]);

         DB::table('dishes')->insert([
            ['name' => 'Spaghetti Carbonara', 'ingredients' => 'Спагетти, яйца, панчетта, сыр, перец', 'image_path' => 'italian/carbonara.jpg', 'price' => 400.00],
            ['name' => 'Lasagna alla Bolognese', 'ingredients' => 'Листы лазаньи, мясной соус, бешамель', 'image_path' => 'italian/lasagna.jpg', 'price' => 480.00],
            ['name' => 'Risotto Milanese', 'ingredients' => 'Рис, шафран, сыр, масло', 'image_path' => 'italian/risotto_milanese.jpg', 'price' => 420.00],
            ['name' => 'Tagliatelle al Ragù', 'ingredients' => 'Тальятелле, мясной соус', 'image_path' => 'italian/tagliatelle_ragu.jpg', 'price' => 390.00],
            ['name' => 'Gnocchi al Pesto', 'ingredients' => 'Ньокки, песто, пармезан', 'image_path' => 'italian/gnocchi_pesto.jpg', 'price' => 410.00],
            ['name' => 'Minestrone', 'ingredients' => 'Овощи, фасоль, томаты, паста', 'image_path' => 'italian/minestrone.jpg', 'price' => 350.00],
            ['name' => 'Ossobuco alla Milanese', 'ingredients' => 'Телячья голень, овощи, вино', 'image_path' => 'italian/ossobuco.jpg', 'price' => 600.00],
            ['name' => 'Saltimbocca alla Romana', 'ingredients' => 'Телятина, прошутто, шалфей', 'image_path' => 'italian/saltimbocca.jpg', 'price' => 550.00],
            ['name' => 'Pollo alla Cacciatora', 'ingredients' => 'Курица, томаты, оливки', 'image_path' => 'italian/pollo_cacciatora.jpg', 'price' => 480.00],
            ['name' => 'Tiramisu', 'ingredients' => 'Кофе, маскарпоне, савоярди, какао', 'image_path' => 'italian/tiramisu.jpg', 'price' => 300.00],
        ]);
    }
}
