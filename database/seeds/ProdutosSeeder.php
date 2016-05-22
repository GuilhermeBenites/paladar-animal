<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(['codigo' => '1','nome' => 'Ração Max 30kg', 'preco' => 50.0, 'categoria_id' => 1]);
    }
}
