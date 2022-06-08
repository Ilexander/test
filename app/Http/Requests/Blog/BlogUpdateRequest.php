<?php

namespace App\Http\Requests\Blog;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Models\Blog;
use App\Models\User;
use App\Services\Language\LanguageFacade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $title
 * @property string $category
 * @property string|null $url_slug
 * @property UploadedFile|null $image
 * @property string $blog_content
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int|null $sort
 * @property bool $status
 */
class BlogUpdateRequest extends FormRequest implements BlogUpdateInterface
{
    private ?string $image_url = null;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        /** @var User $user */
        $user = Auth::user();

        return $user->hasPermissionTo(Blog::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id'                    => 'required|exists:blogs,id',
            "category"              => 'required|string',
            "url_slug"              => 'nullable|string',
            "image"                 => 'nullable|image',
            "meta_keywords"         => 'required|string',
            "meta_description"      => 'required|string',
            "sort"                  => 'nullable|numeric|min:1',
            "status"                => 'required|boolean'
        ];

        foreach (LanguageFacade::all(new LanguageAllRequest()) as $language) {
            $rules[$language->name] = 'required|array';
            $rules[$language->name.'.title'] = 'required|string';
            $rules[$language->name.'.blog_content'] = 'required|string';
        }

        return $rules;
    }

    public function getTranslation(string $language): TranslationItemDTO|bool
    {
        $translation = $this->request->get($language);

        if ($translation) {
            return new TranslationItemDTO(
                $translation['title'],
                $translation['blog_content']
            );
        } else {
            return false;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return Auth::user()->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getUrlSlug(): ?string
    {
        return $this->url_slug;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getMetaKeywords(): string
    {
        return $this->meta_keywords;
    }

    public function getMetaDescription(): string
    {
        return $this->meta_description;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }
}
