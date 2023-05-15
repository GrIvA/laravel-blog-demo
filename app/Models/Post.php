<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Parsedown;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    const UPLOAD_IMAGE_PATH = 'uploads/';

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

    // PROTECT

    /**
     * Accesor for content fiels
     * convert MarkDown to HTML
     *
     * @return Attribute
     */
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

}
