<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client; // Ensure this line exists

class ClientsSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'name' => 'Acme Corp',
            'email' => 'contact@acmecorp.com',
            'phone' => '123-456-7890',
            'affiliation' => 'Acme Industries',
            'other_details' => 'Leading provider of industrial widgets',
            'created_by' => 1, // Adjust this value as needed
        ]);

        Client::create([
            'name' => 'Global Enterprises',
            'email' => 'info@globalent.com',
            'phone' => '987-654-3210',
            'affiliation' => 'Global Enterprise Inc.',
            'other_details' => 'Pioneers in global logistics solutions',
            'created_by' => 1, 
        ]);
    }
}
