<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'admin_id', 'customer_id', 'title', 'description', 'code', 'status' ];

    protected function casts(): array {
        return [
            'status' => 'string',
            'deleted_at' => 'datetime',
        ];
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'admin_id', 'id')->withTrashed();
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(User::class, 'customer_id', 'id')->withTrashed();
    }

    public function messages(): HasMany {
        return $this->hasMany(Message::class, 'ticket_id', 'id')->withTrashed();
    }
}
