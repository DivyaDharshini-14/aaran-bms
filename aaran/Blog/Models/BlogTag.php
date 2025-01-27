<?php

namespace Aaran\Blog\Models;

use Aaran\Common\Models\Common;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{

    protected $guarded = [];

    public static function common($id)
    {
        return Common::find($id)->vname;
    }

    public static function blogTag($id)
    {
        $blogTag = BlogTag::find($id);
        return $blogTag ? $blogTag->vname : null; // Return null if not found
    }



    public static function search(string $searches)
    {
        return empty($searches) ? static::query()
            : static::where('vname', 'like', '%' . $searches . '%');
    }

}
