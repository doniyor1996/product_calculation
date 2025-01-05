<?php

namespace App\Models;

use App\Enums\CategoryTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function items()
    {
        return $this->type === CategoryTypesEnum::MATERIAL->value ?
            $this->materials()
            : $this->products();
    }
}
