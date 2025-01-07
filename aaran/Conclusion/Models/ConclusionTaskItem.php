<?php

namespace Aaran\Conclusion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConclusionTaskItem extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $timestamp=false;

    public function conclusionTask():BelongsTo
    {
        return $this->belongsTo(ConclusionTask::class);
    }
}
