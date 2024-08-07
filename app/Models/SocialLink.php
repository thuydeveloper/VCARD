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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\SocialLink
 *
 * @property int $id
 * @property int $vcard_id
 * @property string|null $website
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $reddit
 * @property string|null $tumblr
 * @property string|null $linkedin
 * @property string|null $whatsapp
 * @property string|null $pinterest
 * @property string|null $tiktok
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Vcard $vcard
 *
 * @method static Builder|SocialLink newModelQuery()
 * @method static Builder|SocialLink newQuery()
 * @method static Builder|SocialLink query()
 * @method static Builder|SocialLink whereCreatedAt($value)
 * @method static Builder|SocialLink whereFacebook($value)
 * @method static Builder|SocialLink whereId($value)
 * @method static Builder|SocialLink whereInstagram($value)
 * @method static Builder|SocialLink whereLinkedin($value)
 * @method static Builder|SocialLink wherePinterest($value)
 * @method static Builder|SocialLink whereReddit($value)
 * @method static Builder|SocialLink whereTiktok($value)
 * @method static Builder|SocialLink whereTumblr($value)
 * @method static Builder|SocialLink whereTwitter($value)
 * @method static Builder|SocialLink whereUpdatedAt($value)
 * @method static Builder|SocialLink whereVcardId($value)
 * @method static Builder|SocialLink whereWebsite($value)
 * @method static Builder|SocialLink whereWhatsapp($value)
 * @method static Builder|SocialLink whereYoutube($value)
 *
 * @mixin Eloquent
 */
class SocialLink extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'social_links';

    /**
     * @var string[]
     */
    protected $fillable = [
        'vcard_id',
        'website',
        'twitter',
        'facebook',
        'instagram',
        'youtube',
        'tumblr',
        'reddit',
        'linkedin',
        'whatsapp',
        'pinterest',
        'tiktok',
        'snapchat',
    ];

    protected $casts = [
        'vcard_id' => 'integer',
        'website' => 'string',
        'twitter' => 'string',
        'facebook' => 'string',
        'instagram' => 'string',
        'youtube' => 'string',
        'tumblr' => 'string',
        'reddit' => 'string',
        'linkedin' => 'string',
        'whatsapp' => 'string',
        'pinterest' => 'string',
        'tiktok' => 'string',
        'snapchat' => 'string',
    ];

    protected $appends = ['social_icon'];

    const SOCIAL_ICON = 'icon';

    public function vcard(): BelongsTo
    {
        return $this->belongsTo(Vcard::class, 'vcard_id');
    }

    public function getSocialIconAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::SOCIAL_ICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/avatars/user.png');
    }

    public function icon()
    {
        return $this->hasMany(SocialIcon::class, 'social_link_id');
    }
}
