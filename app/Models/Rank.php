<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rank
 *
 * @property int $id
 * @property string $name Nombre del rango
 * @property string $pf Pierna fuerte minimo
 * @property string $pd Pierna debil minimo
 * @property string|null $min_ranks_id Rango minimo requerido en para cada lado del binario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereMinRanksId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank wherePd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank wherePf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image Imagen
 * @property string|null $requirements Requisitos minimos de rango
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rank whereRequirements($value)
 */
class Rank extends Model
{
    protected $fillable = [
        'name',
        'pf',
        'pd',
        'min_ranks_id',
        'image',
        'requirements'
    ];
    public function nextRank()
    {
        return Rank::where('id','>',$this->id)->orderBy('id','ASC')->first();
    }
    public function nextRanks()
    {
        return Rank::where('id','>',$this->id)->orderBy('id','ASC')->get();
    }
    public function previousRanks()
    {
        return Rank::where('id','<',$this->id)->orderBy('id','desc')->get();
    }
}
