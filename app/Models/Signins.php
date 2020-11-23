<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Signins
 * @property integer    $id
 * @property integer    $children_id
 * @property            $signed_in
 * @property            $signed_out
 * @package App\Models
 */
class Signins extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'signins';

    protected $fillable = [
        'children_id',
        'signed_in',
        'signed_out'
    ];

    protected $dates = ['signed_in', 'signed_out'];

    public function children() {
        return $this->belongsTo(Children::class);
    }


    public function scopeNewestSignIn($query) {
        return $query->sortBy('signed_in')->last();
    }


    public function scopeNewestSignOut($query) {
        return $query->sortBy('signed_out')->last();
    }
}
