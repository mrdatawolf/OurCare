<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Children
 * @property string $first_name
 * @property string $last_name
 * @property        $payments
 * @property        $parents
 * @property        $signins
 * @property        $billingRate
 * @package App\Models
 */
class Children extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'children';
    protected $fillable = [
        'name',
    ];

    public function payments() {
        return $this->belongsToMany(Payments::class);
    }

    public function parents() {
        return $this->belongsToMany(Parents::class);
    }

    public function signins() {
        return $this->hasMany(Signins::class);
    }

    public function billingRate() {
        return $this->hasOne(BillingRate::class);
    }
}
