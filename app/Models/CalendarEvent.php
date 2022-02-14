<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CalendarEvent
 *
 * @property int $id
 * @property string $start_time
 * @property string $end_time
 * @property string $title Titulo del evento
 * @property string $description
 * @property string $link Indica si el evento tiene alguna url relacionada
 * @property int $created_user Usuario que realizo el registro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereCreatedUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CalendarEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CalendarEvent extends Model
{
    protected $fillable=[
      "start_time",
      "end_time",
      "description",
      "created_user",
      'title',
      'link'
    ];
}
