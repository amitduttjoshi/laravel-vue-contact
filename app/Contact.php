<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    protected $dates = ['birthday'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function path()
    {
        return url('/contacts/' . $this->id);
    }
}
