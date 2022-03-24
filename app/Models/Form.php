<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function dataCollections()
    {
        return $this->hasMany(DataCollection::class);
    }

    public static function createForms(){
        // Se crean los formularios
        Form::helperCreateForm('Formulario de cotizaciones 1', 'Header de cotizaciones', 1, 1);
        Form::helperCreateForm('Formulario de documentos', 'Descarga de documentos en productos', 1, 1);
        Form::helperCreateForm('Formulario de contacto', 'Bloque de contacto', 1, 1);
        Form::helperCreateForm('Formulario de cotizaciones 1', 'Botón de cotizar en producto', 1, 1);
    }

    public static function helperCreateForm($formName, $sectionName, $period, $every){
        // Se verifica si el formulario ya existía
        $form = Form::where('name', $formName)->first();
        $form = ($form != null) ? $form : Form::create(['name' => $formName]);

        // Se valida que la recolección de datos existe
        if(!DataCollection::where('section', $sectionName)->where('form_id', $form->id)->exists())
            DataCollection::create(['section' => $sectionName, 'form_id' => $form->id, 'period' => $period, 'every' => $every]);
    }
}
