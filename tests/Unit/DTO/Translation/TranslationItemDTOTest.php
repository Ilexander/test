<?php

namespace Tests\Unit\DTO\Translation;

use App\DTO\Translation\TranslationItemDTO;
use PHPUnit\Framework\TestCase;

class TranslationItemDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @dataProvider itemDataProvider
     *
     * @param string $title
     * @param string $context
     * @param string|null $item_type
     * @param int|null $item_id
     * @return void
     */
    public function testItem(
        string $title,
        string $context,
        ?string $item_type,
        ?int $item_id,
    ): void {
        $translationItemDTO = new TranslationItemDTO( $title, $context, $item_type, $item_id );

        $this->assertEquals($title, $translationItemDTO->getTitle());
        $this->assertEquals($context, $translationItemDTO->getContext());
        $this->assertEquals($item_type, $translationItemDTO->getItemType());
        $this->assertEquals($item_id, $translationItemDTO->getItemId());

    }

    public function itemDataProvider(): array
    {
        return [
            [
                'first title',
                'first context',
                'first item_type',
                1
            ],
            [
                'second title',
                'second context',
                'second item_type',
                2
            ],
            [
                'new title',
                'new context',
                null,
                null
            ],
        ];
    }
}
