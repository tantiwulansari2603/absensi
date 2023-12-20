<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'attendance_id', 'attendance_id')
            ->where('user_id', $this->user_id)
            ->where('is_accepted', true);
    }
}
