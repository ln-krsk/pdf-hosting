<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Relations\BelongsToThrough;

class Entry extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function client(): BelongsToThrough
    {
        return $this->belongsToThrough(Client::class, Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus(): string
    {
        if (now() >= $this->start && now() <= $this->end) {
            return $status = 'aktiv';
        }
        elseif (!$this->start || !$this->end){
            return $status = 'unbekannt';
        }
        elseif (now() < $this->start) {
            return $status = 'zukünftig';
        }
        elseif (now() > $this->end) {
            return $status = 'beendet';
        }
        else {
            return $status = 'unbekannt';
        }
    }
}
