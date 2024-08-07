<?php

namespace App\Models;

use App\Models\Traits\StorageLimit;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\SocialIcon
 *
 * @property int $id
 * @property int|null $social_link_id
 * @property string $link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $social_icon
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static Builder|SocialIcon newModelQuery()
 * @method static Builder|SocialIcon newQuery()
 * @method static Builder|SocialIcon query()
 * @method static Builder|SocialIcon whereCreatedAt($value)
 * @method static Builder|SocialIcon whereId($value)
 * @method static Builder|SocialIcon whereLink($value)
 * @method static Builder|SocialIcon whereSocialLinkId($value)
 * @method static Builder|SocialIcon whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class SocialIcon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, StorageLimit;

    protected $fillable = [
        'social_link_id',
        'link',
    ];

    protected $table = 'social_icon';

    const SOCIAL_ICON = 'icon';

    protected $appends = ['social_icon'];

    public function getSocialIconAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SOCIAL_ICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/user.png');
    }
}
