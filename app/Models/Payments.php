<?php namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payments
 *
 * @property double $amount
 * @property        $due_date
 * @property bool   $paid
 * @package App\Models
 */
class Payments extends Model
{
    use HasFactory;

    public    $timestamps = true;
    protected $table      = 'payments';
    protected $fillable   = [
        'due_date',
        'paid',
        'amount'
    ];


    public function children()
    {
        return $this->belongsToMany(Children::class);
    }
}
