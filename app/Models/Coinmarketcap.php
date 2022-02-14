<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Coinmarketcap
 *
 * @property int $id
 * @property string $currency
 * @property string $symbol
 * @property float $price
 * @property float $volume_24h
 * @property float $percent_change_1h
 * @property float $percent_change_24h
 * @property float $percent_change_7d
 * @property float $percent_change_30d
 * @property float $percent_change_60d
 * @property float $percent_change_90d
 * @property float $market_cap
 * @property string $last_updated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereMarketCap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange1h($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange24h($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange30d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange60d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange7d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePercentChange90d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coinmarketcap whereVolume24h($value)
 * @mixin \Eloquent
 */
class Coinmarketcap extends Model
{

    protected $fillable = [
        'currency',
        'symbol',
        'price',
        'volume_24h',
        'percent_change_1h',
        'percent_change_24h',
        'percent_change_7d',
        'percent_change_30d',
        'percent_change_60d',
        'percent_change_90d',
        'market_cap',
        'last_updated'
    ];

}
