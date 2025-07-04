<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesticideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesticides')->insertOrIgnore([
            [
                'name' => 'Lambda-cyhalothrin',
                'crop' => 'rice',
                'used_for' => 'Armyworms, rice bugs, black bugs',
                'active_ingredient' => 'Lambda-cyhalothrin',
                'description' => 'Effective against armyworms, bugs, and black bugs.'
            ],
            [
                'name' => 'Cartap hydrochloride',
                'crop' => 'rice',
                'used_for' => 'Stem borers, gall midge',
                'active_ingredient' => 'Cartap hydrochloride',
                'description' => 'Used for stem borers and gall midge.'
            ],
            [
                'name' => 'Quinalphos',
                'crop' => 'rice',
                'used_for' => 'White stem borer, chewing pests',
                'active_ingredient' => 'Quinalphos',
                'description' => 'Used for white stem borer and other chewing pests.'
            ],
            [
                'name' => 'Chlorantraniliprole',
                'crop' => 'corn',
                'used_for' => 'Leaf folder, corn borer',
                'active_ingredient' => 'Chlorantraniliprole',
                'description' => 'Highly effective for leaf folder and corn borer.'
            ],
            [
                'name' => 'Malathion',
                'crop' => 'rice',
                'used_for' => 'Rice hispa, soft-bodied insects',
                'active_ingredient' => 'Malathion',
                'description' => 'Commonly used against rice hispa and soft-bodied insects.'
            ],
            [
                'name' => 'Imidacloprid',
                'crop' => 'corn',
                'used_for' => 'Planthoppers, aphids, thrips',
                'active_ingredient' => 'Imidacloprid',
                'description' => 'Systemic insecticide for planthoppers, aphids, thrips.'
            ],
            [
                'name' => 'Fipronil',
                'crop' => 'rice',
                'used_for' => 'Leafhoppers, wireworms',
                'active_ingredient' => 'Fipronil',
                'description' => 'Used against leafhoppers and wireworms.'
            ],
            [
                'name' => 'Buprofezin',
                'crop' => 'rice',
                'used_for' => 'Rice water weevils',
                'active_ingredient' => 'Buprofezin',
                'description' => 'Insect growth regulator for rice water weevils.'
            ],
            [
                'name' => 'Diazinon',
                'crop' => 'corn',
                'used_for' => 'Whorl maggots, soil pests',
                'active_ingredient' => 'Diazinon',
                'description' => 'Controls whorl maggots and soil pests.'
            ],
            [
                'name' => 'Dimethoate',
                'crop' => 'corn',
                'used_for' => 'Mealybugs',
                'active_ingredient' => 'Dimethoate',
                'description' => 'Contact insecticide for mealybugs.'
            ],
            [
                'name' => 'Acephate',
                'crop' => 'rice',
                'used_for' => 'Aphids, sucking insects',
                'active_ingredient' => 'Acephate',
                'description' => 'Systemic control of aphids and sucking insects.'
            ],
            [
                'name' => 'Cypermethrin',
                'crop' => 'corn',
                'used_for' => 'Bugs, beetles',
                'active_ingredient' => 'Cypermethrin',
                'description' => 'Fast-acting pyrethroid for bugs and beetles.'
            ],
            [
                'name' => 'Spinosad',
                'crop' => 'corn',
                'used_for' => 'Corn earworm',
                'active_ingredient' => 'Spinosad',
                'description' => 'Biological insecticide for corn earworm.'
            ],
            [
                'name' => 'Emamectin benzoate',
                'crop' => 'corn',
                'used_for' => 'Armyworms, leafminers',
                'active_ingredient' => 'Emamectin benzoate',
                'description' => 'Used for armyworms and leafminers.'
            ],
            [
                'name' => 'Tefluthrin',
                'crop' => 'corn',
                'used_for' => 'Rootworms',
                'active_ingredient' => 'Tefluthrin',
                'description' => 'Soil-applied insecticide for rootworms.'
            ],
            [
                'name' => 'Chlorpyrifos',
                'crop' => 'rice',
                'used_for' => 'Cutworms, shootflies',
                'active_ingredient' => 'Chlorpyrifos',
                'description' => 'Used for cutworms and shootflies.'
            ],
            [
                'name' => 'Aluminum phosphide',
                'crop' => 'corn',
                'used_for' => 'Stored grain pests like corn weevil',
                'active_ingredient' => 'Aluminum phosphide',
                'description' => 'Fumigant used for stored grain pests like corn weevil.'
            ],
            [
                'name' => 'Thiamethoxam',
                'crop' => 'corn',
                'used_for' => 'White grubs, root pests',
                'active_ingredient' => 'Thiamethoxam',
                'description' => 'Effective against white grubs and other root pests.'
            ],
            [
                'name' => 'Spinetoram',
                'crop' => 'rice',
                'used_for' => 'Thrips',
                'active_ingredient' => 'Spinetoram',
                'description' => 'Advanced formulation for thrips.'
            ],
            [
                'name' => 'Abamectin',
                'crop' => 'corn',
                'used_for' => 'Spider mites',
                'active_ingredient' => 'Abamectin',
                'description' => 'Miticide for spider mites.'
            ],
        ]);
    }
}
