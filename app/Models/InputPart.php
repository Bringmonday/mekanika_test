<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputPart extends Model
{
    use HasFactory;
    protected $table = 'part_produksi';
    protected $primaryKey = 'id';
    public $timestamps = true; 
    
    protected $fillable = [
        'model_id', 
        'model_name', 
        'part_name', 
        'part_code', 
        'part_number', 
        'image_illus_fix', 
        'image_illus_move', 
        'image_illus_core', 
        'image_blob', 
        'qty_in_cart', 
        'created_at', 
        'updated_at',
        'is_active'
    ];
}
