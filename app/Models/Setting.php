<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country|null $country
 * @property-read string $favicon_url
 * @property-read string $logo_url
 * @property-read string $front_cms
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 *
 * @mixin Eloquent
 */
class Setting extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
    ];

    const HOME_PAGE_THEME = [
        1 => 'Theme 1',
        2 => 'Theme 2',
    ];

    const FORMAT1 = 1;
    const FORMAT2 = 2;
    const FORMAT3 = 3;
    const FORMAT4 = 4;
    const FORMAT5 = 5;
    const FORMAT6 = 6;

    const DATE_FORMATE = [
        self::FORMAT1 => 'Day Month, Year',
        self::FORMAT2 =>  'Month Day, Year',
        self::FORMAT3 => 'DD/MM/YYYY',
        self::FORMAT4 => 'YYYY/MM/DD',
        self::FORMAT5 =>  'MM/DD/YYYY',
        self::FORMAT6 => 'YYYY-MM-DD',
    ];

    const AFFILIATION_FORMAT1 = 1;
    const AFFILIATION_FORMAT2 = 2;

    const AFFILIATION_FORMATE = [
        self::AFFILIATION_FORMAT1 => 'Fix Amount',
        self::AFFILIATION_FORMAT2 =>  'Percentage (%)',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'app_name' => 'required|string|max:30',
        'app_logo' => 'nullable|mimes:jpg,jpeg,png',
    ];

    public const PATH = 'settings';

    public const FRONTPATH = 'front_cms';

    public function getLogoUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if ($media !== null) {
            return $media->getFullUrl();
        }

        return asset($this->value);
    }

    public function getFaviconUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if ($media !== null) {
            return $media->getFullUrl();
        }

        return asset($this->value);
    }

    public function getfrontCmsAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::FRONTPATH)->first();
        if ($media !== null) {
            return $media->getFullUrl();
        }

        return asset($this->value);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
