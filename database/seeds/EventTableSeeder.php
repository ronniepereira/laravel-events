<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        factory(App\Models\Event::class, 25)->create();

        // Exemplo de evento hoje / em andamento
        DB::table('events')->insert([
            'user_id' => 1,
            'title' => 'Evento teste Hoje',
            'description' => 'Exemplo manual de evento hoje',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(5)
        ]);

        // Exemplo de evento nos próximos 5 dias
        DB::table('events')->insert([
            'user_id' => 1,
            'title' => 'Evento teste próximo 5 dias',
            'description' => 'Exemplo manual de evento nos próximos 5 dias',
            'start_date' => Carbon::now()->addDays(2),
            'end_date' => Carbon::now()->addDays(5)
        ]);
    }
}
