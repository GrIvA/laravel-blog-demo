<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Parsedown;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $header
 * @property string $slug
 * @property string $description
 * @property string $epilog
 * @property string|null $thumbnails
 * @property string|null $content
 * @property int $category_id
 * @property int $status
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Post findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEpilog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereThumbnails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    use Sluggable;

    const UPLOAD_IMAGE_PATH = 'uploads/';

    protected $guarded = ['id'];

    protected $fillable = [
        'header',
        'epilog',
        'description',
        'content',
        'thumbnails',
        'category_id',
        'status',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * get post image path
     *
     * @return String
     */
    public function getImage($default_path = 'no-image-80.png')
    {
        $img = $this->thumbnails ?? $default_path;
        return asset(self::UPLOAD_IMAGE_PATH . $img);
    }

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'header']
        ];
    }

    public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
                ->format('d F, Y');
    }

    public function getHtmlAttribute()
    {
        $parser = new Parsedown();
        $parser->setSafeMode(true);
        return $parser->setMarkupEscaped(false)->text($this->content);

    }

    // PROTECT

    /**
     * Accesor for content fiels
     * convert MarkDown to HTML
     *
     * @return Attribute
     */
    /*
    protected function content(): Attribute
    {
        return Attribute::make(
            get: function ($v) {
                $parser = new Parsedown();
                $parser->setSafeMode(true);
                return $parser->setMarkupEscaped(false)->text($v);
            },
        );
    }
    */

}
