<?php

namespace Aaran\Master\Models;

use Aaran\AccountMaster\Models\Ledger;
use Aaran\Common\Models\Common;
use Aaran\Master\Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): ContactFactory
    {
        return new ContactFactory();
    }

    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

    public function contact_type(): BelongsTo
    {
        return $this->belongsTo(Common::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

//    public function ledger(): BelongsTo
//    {
//        return $this->belongsTo(Ledger::class,'ledger_id','id','null');
//    }

}
