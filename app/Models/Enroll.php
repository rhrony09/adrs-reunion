<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model {
    use HasFactory;

    protected $guarded = ['id'];

    public function batch() {
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }
}
