<?php

namespace App\Imports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\ToModel;

class EventsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Event([
            'user_id'     => Auth::id(),
            'title'    => $row['title'], 
            'description' => $row['description'],
            'start_date' => $row['start_date'].":00",
            'end_date' => $row['end_date'].":00",
        ]);
    }
}
