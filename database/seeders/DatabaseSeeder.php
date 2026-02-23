<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\category;
use App\Models\tool;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create();   
        User::factory()->officer()->create(); 
        User::factory()->nia()->create(); 
//        User::factory(5)->create();           

        category::insert([
            ['nama_kategori' => 'Buku Novel', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Buku Pelajaran', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Buku Sejarah', 'created_at' => now(), 'updated_at' => now()],
        ]);

        tool::insert([
            ['name_tools' => 'Novel', 'category_id' => 1, 'stock' => 10, 'created_at' => now(), 'price' => 1000],
            ['name_tools' => 'mtk', 'category_id' => 2, 'stock' => 10, 'created_at' => now(),'price' => 2000],
            ['name_tools' => 'Sejarah', 'category_id' => 3, 'stock' => 10, 'created_at' => now(),'price' => 3000],
        ]);
    }
}
