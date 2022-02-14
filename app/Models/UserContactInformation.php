<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

/**
 * App\Models\UserContactInformation
 *
 * @property int $id
 * @property int $users_id
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property int|null $gender 0 => Masculino / 1 => Femenino
 * @property string|null $birth_date
 * @property int|null $code_postal
 * @property string|null $prefix_cellphone
 * @property string|null $cellphone1
 * @property string|null $cellphone2
 * @property int $language
 * @property string|null $web_page
 * @property string|null $url_image
 * @property string|null $name_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserContactInformation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereCellphone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereCellphone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereNameImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation wherePrefixCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereUrlImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereUsersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereWebPage($value)
 * @method static \Illuminate\Database\Query\Builder|UserContactInformation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserContactInformation withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $identification_document documento de identidad
 * @method static \Illuminate\Database\Eloquent\Builder|UserContactInformation whereIdentificationDocument($value)
 */
class UserContactInformation extends Model
{

    use SoftDeletes, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'address1',
        'address2',
        'city',
        'gender',
        'birth_date',
        'code_postal',
        'prefix_cellphone',
        'cellphone1',
        'cellphone2',
        'language',
        'web_page',
        'url_image',
        'name_image',
    ];

    protected static $logAttributes = [
        'users_id',
        'address1',
        'address2',
        'city',
        'gender',
        'birth_date',
        'code_postal',
        'prefix_cellphone',
        'cellphone1',
        'cellphone2',
        'language',
        'web_page',
        'url_image',
        'name_image',
    ];
}
