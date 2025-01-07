<?php

namespace Aaran\Conclusion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConclusionTask extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $timestamp=false;

    public function conclusionsTaskItem():HasMany
    {
        return $this->hasMany(ConclusionTaskItem::class);
    }
}
