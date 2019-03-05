<?php

namespace SmartHospital\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'name', 'icon', 'path', 'permission_id', 'parent_id'
    ];

    public function childs(){
        return $this->hasMany( 'SmartHospital\Models\Architecture\Menu', 'parent_id')
            ->select('id','parent_id','icon','path','permission_id','parent_id');
    }
}
