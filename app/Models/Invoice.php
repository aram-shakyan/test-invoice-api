<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    const PENDING = 0;
    const PAYED = 1;

    /**
     * @var string[]
     */
    protected $fillable = ['school_name', 'description', 'amount', 'payed_at', 'payed_by', 'status'];

    /**
     * @var string[]
     */
    protected $appends = ['status_label', 'payed_at_human'];


    /**
     * Append status label
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            self::PENDING => 'Pending',
            self::PAYED => 'Payed',
        ];

        return isset($this->attributes['status']) ? $statuses[$this->attributes['status']] : null;
    }

    /**
     * Get Invoice Payeer
     * @return BelongsTo
     */
    public function payeer()
    {
        return $this->belongsTo(User::class, 'payed_by', 'id');
    }

    /**
     * @return string
     */
    public function getPayedAtHumanAttribute()
    {
        if(!isset($this->attributes['payed_at'])) return null;

        return Carbon::createFromFormat("Y-m-d H:i:s", $this->attributes['payed_at'])->diffForHumans();
    }

}
