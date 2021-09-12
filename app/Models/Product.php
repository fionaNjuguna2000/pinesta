<?php

namespace App\Models;

use App\Http\Traits\HasFiles;
use Database\Factories\ProductsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $crawl_id
 * @property string|null $name
 * @property string|null $title
 * @property string|null $sku
 * @property int|null $brand_id
 * @property string|null $colorway
 * @property int|null $created_by
 * @property string|null $gender
 * @property int|null $quantity
 * @property string $status
 * @property float|null $retail_price
 * @property float|null $size
 * @property string|null $shoe
 * @property string|null $release_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $createdBy
 * @property-read mixed $date_diff
 * @property-read string|null $file_url
 * @property-read string|null $image_url
 * @property-read string|null $small_image_url
 * @property-read string|null $thumb_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColorway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCrawlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRetailPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShoe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product withTrashed()
 * @method static Builder|Product withoutTrashed()
 * @mixin Eloquent
 */
class Product extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFiles;


    protected $guarded=[];

    /**
     * @return BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
      return $this->hasMany(Comment::class)
          ->whereStatus(config('settings.status.active'));
    }

    public function getDateDiffAttribute(){
        $date = Carbon::parse($this->release_date);
        $now = Carbon::now();

        return $date->diffInDays($now);
    }

    public function getStoreQuantityAttribute(){
        if($this->quantity<=5){
            return "5 items remaining";
        }else if($this->quantity<=1) {
            return "out of stock";
        }}

}
