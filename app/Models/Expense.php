<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'amount', 'description', 'expense_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'category', 'category')
            ->where('start_date', date(strtotime($this->expense_date)))
            ->where('end_date', date(strtotime($this->expense_date)));
    }
}
