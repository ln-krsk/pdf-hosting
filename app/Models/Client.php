<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = ['name'];

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function entries(): HasManyThrough
    {
        return $this->hasManyThrough(Entry::class, Product::class, );
    }
}
