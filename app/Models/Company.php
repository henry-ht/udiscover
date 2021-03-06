<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $appends = ['logo_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'web_page',
    ];

    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function getLogoUrlAttribute()
    {
        return url('/').$this->logo;
    }
}
