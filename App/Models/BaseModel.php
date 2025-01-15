<?php

namespace App\Models;

class BaseModel
{
    public function expose()
    {
        return get_object_vars($this);
    }
    public function toJSON()
    {
        return json_encode($this);
    }
}
