<?php


namespace App\Http\Traits;


trait HasFiles
{

    /**
     * Retrieves an image from a collection
     * @param $collectionName
     * @return string|null
     */
    public function file($collectionName): ?string
    {
        return $this->hasMedia($collectionName) ? $this->getFirstMediaUrl($collectionName) : asset('public/shoe.png');;
    }


    /**
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->file('imageUrl')
            ?? asset('public/shoe.png');
    }

    /**
     * @return string|null
     */
    public function getSmallImageUrlAttribute(): ?string
    {
        return $this->file('smallImageUrl')
            ?? asset('public/shoe.png');
    }


    /**
     * @return string|null
     */
    public function getThumbUrlAttribute(): ?string
    {
        return $this->file('thumbUrl')
            ?? asset('public/shoe.pngssss');
    }



    /**
     * @return string|null
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file('subtitle');
    }
}
