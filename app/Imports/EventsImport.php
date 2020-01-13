<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
Use Carbon\Carbon;

class EventsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $start_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $row[2].":00")));
        $end_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $row[3].":00")));

        return new Event([
            'user_id' => Auth::id(),
            'title' => $row[0], 
            'description' => $row[1],
            'start_date' => $start_date,
            'end_date' => $end_date,
        ]);
    }
}
