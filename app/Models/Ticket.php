<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Category;
use App\Models\TicketLog;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
    'ticket_no',
    'title',
    'description',
    'category_id',
    'user_id',
    'status',
    'priority'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function logs()
{
    return $this->hasMany(\App\Models\TicketLog::class);
}
}