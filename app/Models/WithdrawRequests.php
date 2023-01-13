<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequests extends Model
{
    use HasFactory;

    public function admins()
    {
        return $this->belongsTo(Admins::class);
    }

    public function bank_accounts()
    {
        return $this->belongsTo(BankAccounts::class);
    }
}
