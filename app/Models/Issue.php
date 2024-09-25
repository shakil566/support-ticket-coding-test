<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';
    protected $guarded = ['id'];
    public $timestamps = true;

    // Define a scope for searching by ticket_number
    public function scopeSearch($query, $searchText)
    {
        if (!empty($searchText)) {
            return $query->where('ticket_number', 'LIKE', '%' . $searchText . '%');
        }
        return $query;
    }

    // Define a scope for status check
    public function scopeStatus($query, $status = 'Open')
    {
        return $query->where('status', $status);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}