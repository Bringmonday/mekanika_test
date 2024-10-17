<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPart extends Model
{
    use HasFactory;

    protected $table = 'model';
    protected $primaryKey = 'id';
    public $timestamps = true; 
    
    protected $fillable = [
        'model_name', 
        'model_description', 
        'created_at', 
        'updated_at',
        'is_active'
    ];
}
