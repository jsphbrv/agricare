<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PestsTableSeeder extends Seeder
{
    public function run()
    {
        // Get all pesticides: [name => id]
        $pesticides = DB::table('pesticides')->pluck('id', 'name');

       DB::table('pests')->insert([
    // RICE PESTS
    ['crop' => 'rice', 'common_name' => 'Rice Black Bug', 'scientific_name' => 'Scotinophara coarctata', 'pesticide_id' => $pesticides['Lambda-cyhalothrin'], 'image' => 'Rice_Black_Bug.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Stem Borer (Yellow)', 'scientific_name' => 'Scirpophaga incertulas', 'pesticide_id' => $pesticides['Cartap hydrochloride'], 'image' => 'Rice_Stem_Borer_Yellow.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Stem Borer (White)', 'scientific_name' => 'Sesamia inferens', 'pesticide_id' => $pesticides['Quinalphos'], 'image' => 'Rice_Stem_Borer_White.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Leaf Folder', 'scientific_name' => 'Cnaphalocrocis medinalis', 'pesticide_id' => $pesticides['Chlorantraniliprole'], 'image' => 'Rice_Leaf_Folder.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Hispa', 'scientific_name' => 'Dicladispa armigera', 'pesticide_id' => $pesticides['Malathion'], 'image' => 'Rice_Hispa.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Brown Planthopper', 'scientific_name' => 'Nilaparvata lugens', 'pesticide_id' => $pesticides['Imidacloprid'], 'image' => 'Brown_Planthopper.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Green Leafhopper', 'scientific_name' => 'Nephotettix virescens', 'pesticide_id' => $pesticides['Fipronil'], 'image' => 'Green_Leafhopper.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Water Weevil', 'scientific_name' => 'Lissorhoptrus oryzophilus', 'pesticide_id' => $pesticides['Buprofezin'], 'image' => 'Rice_Water_Weevil.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Gall Midge', 'scientific_name' => 'Orseolia oryzae', 'pesticide_id' => $pesticides['Cartap hydrochloride'], 'image' => 'Rice_Gall_Midge.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Whorl Maggot', 'scientific_name' => 'Hydrellia philippina', 'pesticide_id' => $pesticides['Diazinon'], 'image' => 'Rice_Whorl_Maggot.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Mealybug', 'scientific_name' => 'Brevennia rehi', 'pesticide_id' => $pesticides['Dimethoate'], 'image' => 'Rice_Mealybug.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Root Aphid', 'scientific_name' => 'Rhopalosiphum rufiabdominale', 'pesticide_id' => $pesticides['Acephate'], 'image' => 'Rice_Root_Aphid.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Armyworm', 'scientific_name' => 'Mythimna separata', 'pesticide_id' => $pesticides['Lambda-cyhalothrin'], 'image' => 'Rice_Armyworm.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Bug', 'scientific_name' => 'Leptocorisa oratorius', 'pesticide_id' => $pesticides['Cypermethrin'], 'image' => 'Rice_Bug.jpeg'],
    ['crop' => 'rice', 'common_name' => 'Rice Thrips', 'scientific_name' => 'Stenchaetothrips biformis', 'pesticide_id' => $pesticides['Imidacloprid'], 'image' => 'Rice_Thrips.jpeg'],

    // CORN PESTS
    ['crop' => 'corn', 'common_name' => 'Corn Earworm', 'scientific_name' => 'Helicoverpa zea', 'pesticide_id' => $pesticides['Spinosad'], 'image' => 'Corn_Earworm.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Fall Armyworm', 'scientific_name' => 'Spodoptera frugiperda', 'pesticide_id' => $pesticides['Emamectin benzoate'], 'image' => 'Fall_Armyworm.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Asian Corn Borer', 'scientific_name' => 'Ostrinia furnacalis', 'pesticide_id' => $pesticides['Chlorantraniliprole'], 'image' => 'Asian_Corn_Borer.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Leaf Aphid', 'scientific_name' => 'Rhopalosiphum maidis', 'pesticide_id' => $pesticides['Imidacloprid'], 'image' => 'Corn_Leaf_Aphid.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Rootworm', 'scientific_name' => 'Diabrotica spp.', 'pesticide_id' => $pesticides['Tefluthrin'], 'image' => 'Corn_Rootworm.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Cutworm', 'scientific_name' => 'Agrotis ipsilon', 'pesticide_id' => $pesticides['Chlorpyrifos'], 'image' => 'Cutworm.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Weevil', 'scientific_name' => 'Sitophilus zeamais', 'pesticide_id' => $pesticides['Aluminum phosphide'], 'image' => 'Corn_Weevil.jpeg'],
    ['crop' => 'corn', 'common_name' => 'White Grub', 'scientific_name' => 'Phyllophaga spp.', 'pesticide_id' => $pesticides['Thiamethoxam'], 'image' => 'White_Grub.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Thrips', 'scientific_name' => 'Frankliniella williamsi', 'pesticide_id' => $pesticides['Spinetoram'], 'image' => 'Corn_Thrips.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Wireworm', 'scientific_name' => 'Conoderus spp.', 'pesticide_id' => $pesticides['Fipronil'], 'image' => 'Wireworm.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Planthopper', 'scientific_name' => 'Peregrinus maidis', 'pesticide_id' => $pesticides['Imidacloprid'], 'image' => 'Corn_Planthopper.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Leaf Beetle', 'scientific_name' => 'Monolepta signata', 'pesticide_id' => $pesticides['Cypermethrin'], 'image' => 'Leaf_Beetle.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Spider Mite', 'scientific_name' => 'Tetranychus spp.', 'pesticide_id' => $pesticides['Abamectin'], 'image' => 'Spider_Mite.jpeg'],
    ['crop' => 'corn', 'common_name' => 'Corn Shootfly', 'scientific_name' => 'Atherigona orientalis', 'pesticide_id' => $pesticides['Chlorpyrifos'], 'image' => 'Corn_Shootfly.jpeg'],
]);

    }
}
