<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BillingRate
 * @property integer    $id
 * @property integer    $children_id
 * @property double     $rate
 * @package App\Models
 */
class BillingRate extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'billing_rate';

    protected $fillable = [
        'children_id',
        'rate'
    ];

    public function children() {
        return $this->belongsTo(Children::class);
    }
}
