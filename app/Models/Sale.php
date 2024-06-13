<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
        
    protected $guarded = [];
    // protected  $table = 'sales';

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
    public function employee()
    {
        return $this->belongsTo(Item::class, 'id_employee');
    }

}
