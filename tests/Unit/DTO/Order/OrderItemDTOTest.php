<?php

namespace Tests\Unit\DTO\Order;

use App\DTO\Order\OrderItemDTO;
use PHPUnit\Framework\TestCase;

class OrderItemDTOTest extends TestCase
{
    /**
     * @dataProvider itemDataProvider
     *
     * @param int|null $id
     * @param string|null $type
     * @param int|null $categoryId
     * @param int|null $serviceId
     * @param int|null $mainOrderId
     * @param string|null $serviceType
     * @param int|null $apiProviderId
     * @param string|null $apiServiceId
     * @param int|null $apiOrderId
     * @param string|null $link
     * @param string|null $quantity
     * @param string|null $userNames
     * @param string|null $userName
     * @param string|null $hashTags
     * @param string|null $hashTag
     * @param string|null $media
     * @param string|null $comments
     * @param int|null $subPosts
     * @param int|null $subMin
     * @param int|null $subMax
     * @param int|null $subDelay
     * @param string|null $subExpiry
     * @param string|null $subResponseOrders
     * @param string|null $subResponsePosts
     * @param string|null $subStatus
     * @param float|null $charge
     * @param float|null $formalCharge
     * @param float|null $profit
     * @param string|null $status
     * @param string|null $startCounter
     * @param string|null $remains
     * @param bool|null $isDripFeed
     * @param int|null $runs
     * @param int|null $interval
     * @param string|null $dripFeedQuantity
     * @param string|null $note
     * @param int|null $userId
     * @return void
     */
    public function testItem(
        ?int $id,
        ?string $type,
        ?int $categoryId,
        ?int $serviceId,
        ?int $mainOrderId,
        ?string $serviceType,
        ?int $apiProviderId,
        ?string $apiServiceId,
        ?int $apiOrderId,
        ?string $link,
        ?string $quantity,
        ?string $userNames,
        ?string $userName,
        ?string $hashTags,
        ?string $hashTag,
        ?string $media,
        ?string $comments,
        ?int $subPosts,
        ?int $subMin,
        ?int $subMax,
        ?int $subDelay,
        ?string $subExpiry,
        ?string $subResponseOrders,
        ?string $subResponsePosts,
        ?string $subStatus,
        ?float $charge,
        ?float $formalCharge,
        ?float $profit,
        ?string $status,
        ?string $startCounter,
        ?string $remains,
        ?bool $isDripFeed,
        ?int $runs,
        ?int $interval,
        ?string $dripFeedQuantity,
        ?string $note,
        ?int $userId,
    ): void{
        $orderItemDTO = new OrderItemDTO();
        $orderItemDTO->setUserId($userId);
        $orderItemDTO->setId($id);
        $orderItemDTO->setStatus($status);
        $orderItemDTO->setNote($note);
        $orderItemDTO->setSubResponsePosts($subResponsePosts);
        $orderItemDTO->setSubResponseOrders($subResponseOrders);
        $orderItemDTO->setApiOrderId($apiOrderId);
        $orderItemDTO->setProfit($profit);
        $orderItemDTO->setFormalCharge($formalCharge);
        $orderItemDTO->setRemains($remains);
        $orderItemDTO->setCharge($charge);
        $orderItemDTO->setStartCounter($startCounter);
        $orderItemDTO->setLink($link);
        $orderItemDTO->setApiProviderId($apiProviderId);
        $orderItemDTO->setApiServiceId($apiServiceId);
        $orderItemDTO->setCategoryId($categoryId);
        $orderItemDTO->setComments($comments);
        $orderItemDTO->setDripFeedQuantity($dripFeedQuantity);
        $orderItemDTO->setHashTag($hashTag);
        $orderItemDTO->setHashTags($hashTags);
        $orderItemDTO->setInterval($interval);
        $orderItemDTO->setIsDripFeed($isDripFeed);
        $orderItemDTO->setMainOrderId($mainOrderId);
        $orderItemDTO->setMedia($media);
        $orderItemDTO->setQuantity($quantity);
        $orderItemDTO->setRuns($runs);
        $orderItemDTO->setServiceId($serviceId);
        $orderItemDTO->setServiceType($serviceType);
        $orderItemDTO->setSubDelay($subDelay);
        $orderItemDTO->setSubExpiry($subExpiry);
        $orderItemDTO->setSubMax($subMax);
        $orderItemDTO->setSubMin($subMin);
        $orderItemDTO->setSubPosts($subPosts);
        $orderItemDTO->setSubStatus($subStatus);
        $orderItemDTO->setType($type);
        $orderItemDTO->setUserName($userName);
        $orderItemDTO->setUserNames($userNames);

        $this->assertEquals($userId, $orderItemDTO->getUserId());
        $this->assertEquals($id, $orderItemDTO->getId());
        $this->assertEquals($status, $orderItemDTO->getStatus());
        $this->assertEquals($note, $orderItemDTO->getNote());
        $this->assertEquals($subResponsePosts, $orderItemDTO->getSubResponsePosts());
        $this->assertEquals($subResponseOrders, $orderItemDTO->getSubResponseOrders());
        $this->assertEquals($apiOrderId, $orderItemDTO->getApiOrderId());
        $this->assertEquals($profit, $orderItemDTO->getProfit());
        $this->assertEquals($formalCharge, $orderItemDTO->getFormalCharge());
        $this->assertEquals($remains, $orderItemDTO->getRemains());
        $this->assertEquals($charge, $orderItemDTO->getCharge());
        $this->assertEquals($startCounter, $orderItemDTO->getStartCounter());
        $this->assertEquals($link, $orderItemDTO->getLink());
        $this->assertEquals($apiProviderId, $orderItemDTO->getApiProviderId());
        $this->assertEquals($apiServiceId, $orderItemDTO->getApiServiceId());
        $this->assertEquals($categoryId, $orderItemDTO->getCategoryId());
        $this->assertEquals($comments, $orderItemDTO->getComments());
        $this->assertEquals($dripFeedQuantity, $orderItemDTO->getDripFeedQuantity());
        $this->assertEquals($hashTag, $orderItemDTO->getHashTag());
        $this->assertEquals($hashTags, $orderItemDTO->getHashTags());
        $this->assertEquals($interval, $orderItemDTO->getInterval());
        $this->assertEquals($isDripFeed, $orderItemDTO->getIsDripFeed());
        $this->assertEquals($mainOrderId, $orderItemDTO->getMainOrderId());
        $this->assertEquals($media, $orderItemDTO->getMedia());
        $this->assertEquals($quantity, $orderItemDTO->getQuantity());
        $this->assertEquals($runs, $orderItemDTO->getRuns());
        $this->assertEquals($serviceId, $orderItemDTO->getServiceId());
        $this->assertEquals($serviceType, $orderItemDTO->getServiceType());
        $this->assertEquals($subDelay, $orderItemDTO->getSubDelay());
        $this->assertEquals($subExpiry, $orderItemDTO->getSubExpiry());
        $this->assertEquals($subMax, $orderItemDTO->getSubMax());
        $this->assertEquals($subMin, $orderItemDTO->getSubMin());
        $this->assertEquals($subPosts, $orderItemDTO->getSubPosts());
        $this->assertEquals($subStatus, $orderItemDTO->getSubStatus());
        $this->assertEquals($type, $orderItemDTO->getType());
        $this->assertEquals($userName, $orderItemDTO->getUserName());
        $this->assertEquals($userNames, $orderItemDTO->getUserNames());
    }

    public function itemDataProvider(): array
    {
        return [
            [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ],
            [
                1,
                'first type',
                1,
                1,
                1,
                'first service type',
                1000,
                'first api service id',
                23,
                'first link',
                "500",
                'first user names',
                'first user name',
                'first hash tags',
                'first hash tag',
                'first',
                'first $comments',
                341,
                10,
                100,
                3,
                'first sub expiry',
                'first sub response orders',
                'first  sub response posts',
                'first sub status',
                1.5,
                4.5,
                3.0,
                "pending",
                "start",
                'first emains',
                true,
                1,
                30,
                'first dripFeedQuantity',
                'first some note',
                10,
            ]
        ];
    }
}
