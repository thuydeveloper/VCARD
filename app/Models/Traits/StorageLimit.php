<?php

namespace App\Models\Traits;

use App\Exceptions\StorageLimitExceededException;
use App\Models\Role;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Events\CollectionHasBeenCleared;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\FileAdderFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait StorageLimit
{
    /**
     * Add a file to the media library.
     *
     *
     */

    public function newAddMedia(string|\Symfony\Component\HttpFoundation\File\UploadedFile $file): FileAdder
    {
        if (getLogInUser()->hasRole(Role::ROLE_ADMIN)) {
            $total = totalStorage() + $file->getSize() / (1024 * 1024);
            $planStorage = getCurrentSubscription()->plan->storage_limit;

            if ($total < $planStorage) {
                return app(FileAdderFactory::class)->create($this, $file);
            } else {
                throw new StorageLimitExceededException(__('messages.storage_full'));
            }
        } else {
            return app(FileAdderFactory::class)->create($this, $file);
        }
    }

    public function newClearMediaCollection($input, string $collectionName = 'default'): HasMedia
    {
        $oldMediaStorage = $this->getMedia($collectionName)->sum('size') / (1024*1024);
        $newMediaStorage = $input->getSize() / (1024*1024);
        $total = totalStorage() - $oldMediaStorage + $newMediaStorage;
        $planStorage = getCurrentSubscription()->plan->storage_limit;
        if ($total > $planStorage) {
            throw new StorageLimitExceededException(__('messages.storage_full'));
        }
        $this
            ->getMedia($collectionName)
            ->each(fn (Media $media) => $media->delete());

        event(new CollectionHasBeenCleared($this, $collectionName));

        if ($this->mediaIsPreloaded()) {
            unset($this->media);
        }

        return $this;
    }
}
