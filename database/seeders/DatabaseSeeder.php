<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use App\Models\Entry;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::factory()->create([
            'email' => 'admin@company.com',
            'password' => bcrypt('admin')
        ]);
        $user2 = User::factory()->create([
            'email' => 'berta.bubble@company2.com',
            'password' => bcrypt('berta12345!')
        ]);

        $user3 = User::factory()->create([
            'email' => 'claus.cleber@company.com',
            'password' => bcrypt('claus12345!')
        ]);

        $client1 = Client::factory()->create([
            'name' => 'Client1',
        ]);
        $client2 = Client::factory()->create([
            'name' => 'Client2',
        ]);

        $client3 = Client::factory()->create([
            'name' => 'Client3',

        ]);

        $product1 = Product::factory()->create([
            'client_id' => $client1->id
        ]);

        $product2 = Product::factory()->create([
            'client_id' => $client1->id
        ]);
        $product3 = Product::factory()->create([
            'client_id' => $client1->id
        ]);
        $product4 = Product::factory()->create([
            'client_id' => $client2->id
        ]);
        $product5 = Product::factory()->create([
            'client_id' => $client2->id
        ]);
        $product6 = Product::factory()->create([
            'client_id' => $client2->id
        ]);
        $product7 = Product::factory()->create([
            'client_id' => $client2->id
        ]);
        $product8 = Product::factory()->create([
            'client_id' => $client3->id
        ]);


        Entry::factory(5)->create([
            'user_id' => $user1->id,
            'product_id' => $product1->id,
        ]);
        Entry::factory(2)->create([
            'user_id' => $user1->id,
            'product_id' => $product2->id,
        ]);
        Entry::factory(1)->create([
            'user_id' => $user1->id,
            'product_id' => $product3->id,
        ]);
        Entry::factory(2)->create([
            'user_id' => $user2->id,
            'product_id' => $product4->id,
        ]);
        Entry::factory(4)->create([
            'user_id' => $user2->id,
            'product_id' => $product5->id,
        ]);
        Entry::factory(2)->create([
            'user_id' => $user2->id,
            'product_id' => $product6->id,
        ]);
        Entry::factory(1)->create([
            'user_id' => $user2->id,
            'product_id' => $product7->id,
        ]);
        Entry::factory(2)->create([
            'user_id' => $user3->id,
            'product_id' => $product8->id,
        ]);
        Entry::factory(5)->create();
    }

}
