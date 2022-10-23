<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    public function biro()
    {
        return $this->belongsTo(Biro::class, 'biro_id', 'id');
    }

    public function ythh()
    {
        return $this->belongsTo(Yth::class, 'yth_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
