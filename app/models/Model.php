<?php

namespace App\Models;

use Conf\DB;

class Model
{
    protected $db = null;

    public function __construct()
    {
        $this->db = DB::connect();
    }
}
