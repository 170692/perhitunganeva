<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hitungeva extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table        = 'dataeva';
    protected $primaryKey   = 'evaluate_at';
    protected $fillable     = ['name', 'budget_at_completion', 'plan_at_completion', 'evaluate_at', 'planned_value', 'earned_value', 'actual_cost', 'schedule_variance', 'cost_variance', 'CPI', 'SPI', 'time_at_completion', 'delay_at_completion', 'TCPI', 'EAC', 'ETC', 'VAC'];
}
