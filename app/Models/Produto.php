<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Produto
 *
 * @property integer $id
 * @property integer $loja_id
 * @property string $nome
 * @property int $valor
 * @property boolean $ativo
 * @property Loja $loja
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereLojaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produto whereValor($value)
 * @mixin \Eloquent
 */
class Produto extends Model
{

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produto';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['loja_id', 'nome', 'valor', 'ativo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loja()
    {
        return $this->belongsTo('App\Models\Loja');
    }

    public function getValorAttribute()
    {
        $valor = $this->attributes['valor'];
        return "R$ " . number_format((float)$valor,  2, '.', '');
    }
}
