<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $name
 * @property string $iso_code
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Language newModelQuery()
 * @method static Builder|Language newQuery()
 * @method static Builder|Language query()
 * @method static Builder|Language whereCreatedAt($value)
 * @method static Builder|Language whereId($value)
 * @method static Builder|Language whereIsDefault($value)
 * @method static Builder|Language whereIsoCode($value)
 * @method static Builder|Language whereName($value)
 * @method static Builder|Language whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Language extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'iso_code',
        'status',
    ];

    protected $casts = [
        'name' => 'string',
        'iso_code' => 'string',
        'is_default' => 'integer',
        'status' => 'integer',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:languages,name|max:20',
        'iso_code' => 'required|unique:languages,iso_code|min:2|max:2',
    ];

    const LANGUAGE_PATH = 'language_flag';

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::LANGUAGE_PATH)->first();
        if ($media !== null) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/redflag.jpeg');
    }
}
