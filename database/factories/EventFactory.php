<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    static $password;
    
    $start_date = $faker->dateTimeBetween('now', 'next Year');
    $end_date = $faker->dateTimeBetween($start_date, $start_date->format('Y-m-d H:i:s').' +2 days');
    
    return [
        'user_id' => 1,
        'title' => $faker->text($max_nb_chars = 75, $ext_word_list = false),
        'description' =>$faker->text($max_nb_chars = 200, $ext_word_list = false),
        'start_date' => $start_date,
        'end_date' => $end_date
    ];
});
