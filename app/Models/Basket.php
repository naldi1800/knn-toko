<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee');
    }
}
