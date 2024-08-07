<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\Vcard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StorageLimitController extends AppBaseController
{
    public function index()
    {
        $userStorageData = totalStorageData();
        $totalStorageData = collect($userStorageData)->sum() / (1024 * 1024);
        $userLimit = $totalStorageData;
        $storageLimit = getCurrentSubscription()->plan->storage_limit;
        $productStorageMB = isset($userStorageData['product_storage']) ? $userStorageData['product_storage'] / (1024 * 1024) : 0;
        $serviceStorageMB = isset($userStorageData['services_storage']) ? $userStorageData['services_storage'] / (1024 * 1024) : 0;
        $testimonialStorageMB = isset($userStorageData['testimonial_storage']) ? $userStorageData['testimonial_storage'] / (1024 * 1024) : 0;
        $socialStorageMB = isset($userStorageData['social_storage']) ? $userStorageData['social_storage'] / (1024 * 1024) : 0;
        $blogStorageMB = isset($userStorageData['blog_storage']) ? $userStorageData['blog_storage'] / (1024 * 1024) : 0;
        $galleryStorageMB = isset($userStorageData['gallery_storage']) ? $userStorageData['gallery_storage'] / (1024 * 1024) : 0;
        $profileStorageMB = isset($userStorageData['profile_storage']) ? $userStorageData['profile_storage'] / (1024 * 1024) : 0;
        $pwaStorageMB = isset($userStorageData['pwa_storage']) ? $userStorageData['pwa_storage'] / (1024 * 1024) : 0;
        $avatarStorageMB = isset($userStorageData['avatar_storage']) ? $userStorageData['avatar_storage'] / (1024 * 1024) : 0;



        $storagePercentage = $userLimit * 100 / $storageLimit;
        $labels = [
            __('messages.used_storage'),
            __('messages.unused_storage'),
        ];
        $chartData = [
           'labels' => $labels,
           'data' => [$storagePercentage, 100 - $storagePercentage],
        ];

        return view('storage.index', compact('userLimit','chartData','storageLimit','blogStorageMB','productStorageMB','serviceStorageMB', 'testimonialStorageMB','socialStorageMB','galleryStorageMB','profileStorageMB','pwaStorageMB','avatarStorageMB'));
    }
}
