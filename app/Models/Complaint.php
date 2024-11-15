<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function user()
    {
        return $this->belongsTO(User::class);
    }

    public function latest_action()
    {
        return $this->hasOne(Action::class)->latestOfMany();
    }

    public function scopeFilters($query)
    {
        return $query
            ->when(request('filters.title'), fn($q) => $q->where('title', 'like', '%' . request('filters.title') . '%'))
            ->when(request('filters.user_id'), fn($q) => $q->where('user_id', request('filters.user_id')))
            ->when(request('filters.action_status_id'), fn($q) => $q->whereHas('latest_action', fn($q) => $q->where('action_status_id', request('filters.action_status_id'))));
    }
}
