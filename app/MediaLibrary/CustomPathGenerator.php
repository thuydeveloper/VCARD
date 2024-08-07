<?php

namespace App\MediaLibrary;

use App\Models\AboutUs;
use App\Models\Feature;
use App\Models\FrontTestimonial;
use App\Models\Gallery;
use App\Models\Language;
use App\Models\Nfc;
use App\Models\NfcOrders;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\Subscription;
use App\Models\Template;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\Vcard;
use App\Models\VcardBlog;
use App\Models\VcardService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 */
class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}'.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case User::PROFILE:
                return str_replace('{PARENT_DIR}', User::PROFILE, $path);
            case Setting::PATH:
                return str_replace('{PARENT_DIR}', Setting::PATH, $path);
            case Vcard::PROFILE_PATH:
                return str_replace('{PARENT_DIR}', Vcard::PROFILE_PATH, $path);
            case Vcard::COVER_PATH:
                return str_replace('{PARENT_DIR}', Vcard::COVER_PATH, $path);
            case VcardService::SERVICES_PATH:
                return str_replace('{PARENT_DIR}', VcardService::SERVICES_PATH, $path);
            case Gallery::GALLERY_PATH:
                return str_replace('{PARENT_DIR}', Gallery::GALLERY_PATH, $path);
            case Testimonial::TESTIMONIAL_PATH:
                return str_replace('{PARENT_DIR}', Testimonial::TESTIMONIAL_PATH, $path);
            case Template::TEMPLATE_PATH:
                return str_replace('{PARENT_DIR}', Template::TEMPLATE_PATH, $path);
            case Feature::PROFILE:
                return str_replace('{PARENT_DIR}', Feature::PROFILE, $path);
            case Setting::FRONTPATH:
                return str_replace('{PARENT_DIR}', Setting::FRONTPATH, $path);
            case FrontTestimonial::PATH:
                return str_replace('{PARENT_DIR}', FrontTestimonial::PATH, $path);
            case AboutUs::PATH:
                return str_replace('{PARENT_DIR}', AboutUs::PATH, $path);
            case Product::PRODUCT_PATH:
                return str_replace('{PARENT_DIR}', Product::PRODUCT_PATH, $path);
            case VcardBlog::BLOG_PATH:
                return str_replace('{PARENT_DIR}', VcardBlog::BLOG_PATH, $path);
            case Subscription::ATTACHMENT_PATH:
                return str_replace('{PARENT_DIR}', Subscription::ATTACHMENT_PATH, $path);
            case SocialLink::SOCIAL_ICON:
                return str_replace('{PARENT_DIR}', SocialLink::SOCIAL_ICON, $path);
            case Subscription::NOTES_PATH:
                return str_replace('{PARENT_DIR}', Subscription::NOTES_PATH, $path);
            case Language::LANGUAGE_PATH:
                return str_replace('{PARENT_DIR}', Language::LANGUAGE_PATH, $path);
            case Nfc::NFC_PATH:
                return str_replace('{PARENT_DIR}', Nfc::NFC_PATH, $path);
            case Nfc::NFC_BACK_IMAGE:
                return str_replace('{PARENT_DIR}', Nfc::NFC_BACK_IMAGE, $path);
            case NfcOrders::LOGO_PATH:
                return str_replace('{PARENT_DIR}', NfcOrders::LOGO_PATH, $path);
            case UserSetting::LOGO_PATH:
                return str_replace('{PARENT_DIR}', UserSetting::LOGO_PATH, $path);
            case 'default':
                return '';
        }
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}

