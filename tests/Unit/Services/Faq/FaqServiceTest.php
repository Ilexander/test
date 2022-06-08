<?php

namespace Tests\Unit\Services\Faq;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Faq\FaqAllInterface;
use App\Http\Requests\Faq\FaqCreateInterface;
use App\Http\Requests\Faq\FaqDeleteInterface;
use App\Http\Requests\Faq\FaqInfoInterface;
use App\Http\Requests\Faq\FaqUpdateInterface;
use App\Interfaces\Repositories\FaqInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Faq;
use App\Models\Language;
use App\Services\Department\DepartmentService;
use App\Services\Faq\FaqService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\FaqFactory;
use Tests\Factories\LanguageFactory;
use Tests\Factories\TranslationFactory;
use Tests\TestCase;

class FaqServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Faq $faq;

    private FaqService $faqService;

    private Language $language;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faq = FaqFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->faq);

        $repo = $this->createMock(FaqInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->faq);
        $repo->method('create')->willReturn($this->faq);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $this->language = LanguageFactory::new()->create();
        $languageCollection = new Collection();
        $languageCollection->add($this->language);

        $languageRepo = $this->createMock(LanguageInterface::class);
        $languageRepo->method('all')->willReturn($languageCollection);
        $languageRepo->method('create')->willReturn($this->language);
        $languageRepo->method('info')->willReturn($this->language);
        $languageRepo->method('update')->willReturn(true);
        $languageRepo->method('delete')->willReturn(true);

        $translation = TranslationFactory::new()->create();
        $translationCollection = new Collection();
        $translationCollection->add($translation);

        $translationRepo = $this->createMock(TranslationInterface::class);
        $translationRepo->method('create')->willReturn($translation);
        $translationRepo->method('deleteByEntityData')->willReturn(true);

        $this->faqService = new FaqService($repo, $languageRepo, $translationRepo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(FaqAllInterface::class);
        $result = $this->faqService->all($all);

        /** @var Faq $item */
        foreach ($result as $item) {
            $this->assertEquals($this->faq->question, $item->question);
            $this->assertEquals($this->faq->answer, $item->answer);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(FaqInfoInterface::class);
        $result = $this->faqService->info($info);

        $this->assertEquals($this->faq->question, $result->question);
        $this->assertEquals($this->faq->answer, $result->answer);
    }

    public function testCreate()
    {
        $translationItemDTO = $this->createMock(TranslationItemDTO::class);
        $translationItemDTO->method('getTitle')->willReturn('some title');
        $translationItemDTO->method('getContext')->willReturn('some Context');
        $translationItemDTO->method('getLanguageId')->willReturn($this->language->id);

        $create = $this->createMock(FaqCreateInterface::class);
        $create->method('getTranslation')->willReturn($translationItemDTO);

        $result = $this->faqService->create($create);

        $this->assertEquals($this->faq->question, $result->question);
        $this->assertEquals($this->faq->answer, $result->answer);
    }

    public function testUpdate()
    {
        $translationItemDTO = $this->createMock(TranslationItemDTO::class);
        $translationItemDTO->method('getTitle')->willReturn('some title');
        $translationItemDTO->method('getContext')->willReturn('some Context');
        $translationItemDTO->method('getLanguageId')->willReturn($this->language->id);

        $update = $this->createMock(FaqUpdateInterface::class);
        $update->method('getTranslation')->willReturn($translationItemDTO);

        $this->assertTrue($this->faqService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(FaqDeleteInterface::class);

        $this->assertTrue($this->faqService->delete($delete));
    }
}
