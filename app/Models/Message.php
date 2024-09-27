<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'ticket_id', 'user_id', 'content', 'is_read' ];

    protected $hidden = [ 'is_read' ];

    protected function casts(): array {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function ticket(): BelongsTo {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id')->withTrashed();
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }
}
