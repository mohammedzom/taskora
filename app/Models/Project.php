<?php

namespace App\Models;

use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'client_name', 'description', 'hourly_rate', 'deadline', 'expected_hours', 'logged_hours'])]
#[Hidden(['id'])]
class Project extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'hourly_rate' => 'decimal:2',
            'expected_hours' => 'decimal:2',
            'logged_hours' => 'decimal:2',
            'deadline' => 'date',
            'completion_percentage' => 'decimal:2',
            'status' => 'enum',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
