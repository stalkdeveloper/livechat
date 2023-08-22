<?php

namespace App\Services\User;

use App\Services\Service;
use Illuminate\Support\Facades\DB;

class CommonService extends Service
{
    public function saveData($table, $data)
    {
        try {
            $data = DB::table($table)->insert($data);
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getsingleData($key, $id, $table)
    {
        try {
            $data = DB::table($table)->where($key, $id)->first();
            return $data;
        } catch (\Throwable $th) {
            \Log::info($th);
        }
    }
}
