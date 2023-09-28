<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class signupRequestVerification extends Model
{
    use HasFactory;

    protected $table = 'state_activations';

    protected $fillable = [
        'request_id',
        'email',
        'created_at'
    ];

    protected $primaryKey = 'email';

    public $timestamps = false;
}
