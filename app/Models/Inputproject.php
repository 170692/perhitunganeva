<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inputproject extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dataproject';
    protected $fillable = ['name', 'budget_at_completion', 'plan_at_completion'];
}
