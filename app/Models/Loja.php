<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Loja
 *
 * @property integer $id
 * @property string $nome_loja
 * @property string $email
 * @property Produto[] $produtos
 * @property-read int|null $produtos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Loja newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loja newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loja query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loja whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loja whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loja whereNomeLoja($value)
 * @mixin \Eloquent
 */
class Loja extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loja';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nome_loja', 'email'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'loja_id');
    }
}
