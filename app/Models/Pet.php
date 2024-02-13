<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ['name', 'date_of_birth', 'breed', 'comment', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function redemptions()
    {
        return $this->belongsToMany(Redemption::class)->withPivot('quantity');
    }
}
