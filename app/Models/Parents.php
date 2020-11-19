<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Parents
 *
 * @property        $id
 * @property        $first_name
 * @property        $last_name
 * @property        $created_at
 * @property        $updated_at
 * @package App\Models
 */
class Parents extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'parents';
    protected $fillable = [
        'first_name',
        'last_name'
    ];

    public function children() {
        return $this->belongsToMany(Children::class);
    }
}
