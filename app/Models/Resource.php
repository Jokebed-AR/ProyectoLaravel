<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'namespace'
    ];

    public static $resources = [
        'Usuarios' => 'App\User',
        'Productos' => 'App\Models\Product',
        'Documentos legales' => 'App\Models\LegalDocument',
        'Grupos' => 'App\Models\Group',
        'Formularios' => 'App\Models\Form',
        'Recolección de datos' => 'App\Models\DataCollection',
        'Caracaterísticas de productos' => 'App\Models\Characteristic',
        'Categorías' => 'App\Models\Category',
        'Marcas' => 'App\Models\Brand',
        'Preguntas' => 'App\Models\Question',
        'Módulos' => 'App\Models\Resource',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)
                    ->using(ResourceGroup::class)
                    ->withPivot('create', 'read', 'update', 'delete', 'restore');
    }

    public static function createResources(){
        $resources = Resource::$resources;
        foreach ($resources as $resource => $namespace)
        {
            if (! Resource::where('name', $resource )->exists() )
                 Resource::create(['name' => $resource, 'namespace' => $namespace]);
        }
    }
}
