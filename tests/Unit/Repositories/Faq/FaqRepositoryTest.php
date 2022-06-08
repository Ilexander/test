<?php

namespace Tests\Unit\Repositories\Faq;

use App\Http\Requests\Faq\FaqAllRequest;
use App\Http\Requests\Faq\FaqInfoRequest;
use App\Models\Faq;
use App\Repositories\Faq\FaqRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\Factories\FaqFactory;
use Tests\TestCase;
use Tests\Traits\ValidationTrait;

class FaqRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use ValidationTrait;

    private FaqRepository $faqRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->faqRepository = new FaqRepository(new Faq());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $faq = FaqFactory::new()->create();

        $all = new FaqAllRequest();

        foreach ($this->faqRepository->all($all) as $item) {
            $this->checkEquals($faq, $item, [ "question", "answer",]);
        }
    }

    public function testInfo()
    {
        $faq = FaqFactory::new()->create();
        $info = new FaqInfoRequest();
        $info->merge([
            "id" => $faq->id
        ]);

        $result = $this->faqRepository->info($info);

        $this->checkEquals($faq, $result, [ "question", "answer",]);
    }

    public function testCreate()
    {
        $insertData = [
            "question"  => Str::random(32),
            "answer"    => Str::random(32),
        ];
    }
}
