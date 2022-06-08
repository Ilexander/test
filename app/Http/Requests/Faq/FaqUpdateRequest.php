<?php

namespace App\Http\Requests\Faq;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Models\Faq;
use App\Models\User;
use App\Services\Language\LanguageFacade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $question
 * @property string $answer
 */
class FaqUpdateRequest extends FormRequest implements FaqUpdateInterface
{
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

        return $user->hasPermissionTo(Faq::MODEL_ROUTE_PERMISSION);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        return [
//            'id'        => 'required|exists:faqs,id',
//            'question'  => 'required|string',
//            'answer'    => 'required|string',
//        ];

        $rules = [
            'id'        => 'required|exists:faqs,id',
        ];

        foreach (LanguageFacade::all(new LanguageAllRequest()) as $language) {
            $rules[$language->name] = 'required|array';
            $rules[$language->name.'.question'] = 'required|string';
            $rules[$language->name.'.answer'] = 'required|string';
        }

        return $rules;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function getTranslation(string $language): TranslationItemDTO|bool
    {
        $translation = $this->request->get($language);

        if ($translation) {
            return new TranslationItemDTO(
                $translation['question'],
                $translation['answer']
            );
        } else {
            return false;
        }
    }
}
