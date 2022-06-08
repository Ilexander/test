<?php

namespace App\DTO\Order;

use App\Models\Order;

class OrderItemDTO
{
    private ?int $id = null;
    private ?string $type  = null;
    private ?int $categoryId  = null;
    private ?int $serviceId  = null;
    private ?int $mainOrderId  = null;
    private ?string $serviceType  = null;
    private ?int $apiProviderId  = null;
    private ?string $apiServiceId  = null;
    private ?int $apiOrderId  = null;
    private ?string $link  = null;
    private ?string $quantity  = null;
    private ?string $userNames  = null;
    private ?string $userName  = null;
    private ?string $hashTags  = null;
    private ?string $hashTag  = null;
    private ?string $media  = null;
    private ?string $comments  = null;
    private ?int $subPosts  = null;
    private ?int $subMin  = null;
    private ?int $subMax  = null;
    private ?int $subDelay  = null;
    private ?string $subExpiry  = null;
    private ?string $subResponseOrders  = null;
    private ?string $subResponsePosts  = null;
    private ?string $subStatus  = null;
    private ?float $charge  = null;
    private ?float $formalCharge  = null;
    private ?float $profit  = null;
    private ?string $status  = null;
    private ?string $startCounter  = null;
    private ?string $remains  = null;
    private ?bool $isDripFeed  = null;
    private ?int $runs  = null;
    private ?int $interval  = null;
    private ?string $dripFeedQuantity  = null;
    private ?string $note  = null;
    private ?int $userId  = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int|null
     */
    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    /**
     * @param int|null $serviceId
     */
    public function setServiceId(?int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return int|null
     */
    public function getMainOrderId(): ?int
    {
        return $this->mainOrderId;
    }

    /**
     * @param int|null $mainOrderId
     */
    public function setMainOrderId(?int $mainOrderId): void
    {
        $this->mainOrderId = $mainOrderId;
    }

    /**
     * @return string|null
     */
    public function getServiceType(): ?string
    {
        return $this->serviceType;
    }

    /**
     * @param string|null $serviceType
     */
    public function setServiceType(?string $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return int|null
     */
    public function getApiProviderId(): ?int
    {
        return $this->apiProviderId;
    }

    /**
     * @param int|null $apiProviderId
     */
    public function setApiProviderId(?int $apiProviderId): void
    {
        $this->apiProviderId = $apiProviderId;
    }

    /**
     * @return string|null
     */
    public function getApiServiceId(): ?string
    {
        return $this->apiServiceId;
    }

    /**
     * @param string|null $apiServiceId
     */
    public function setApiServiceId(?string $apiServiceId): void
    {
        $this->apiServiceId = $apiServiceId;
    }

    /**
     * @return int|null
     */
    public function getApiOrderId(): ?int
    {
        return $this->apiOrderId;
    }

    /**
     * @param int|null $apiOrderId
     */
    public function setApiOrderId(?int $apiOrderId): void
    {
        $this->apiOrderId = $apiOrderId;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     */
    public function setLink(?string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string|null
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    /**
     * @param string|null $quantity
     */
    public function setQuantity(?string $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string|null
     */
    public function getUserNames(): ?string
    {
        return $this->userNames;
    }

    /**
     * @param string|null $userNames
     */
    public function setUserNames(?string $userNames): void
    {
        $this->userNames = $userNames;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string|null $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string|null
     */
    public function getHashTags(): ?string
    {
        return $this->hashTags;
    }

    /**
     * @param string|null $hashTags
     */
    public function setHashTags(?string $hashTags): void
    {
        $this->hashTags = $hashTags;
    }

    /**
     * @return string|null
     */
    public function getHashTag(): ?string
    {
        return $this->hashTag;
    }

    /**
     * @param string|null $hashTag
     */
    public function setHashTag(?string $hashTag): void
    {
        $this->hashTag = $hashTag;
    }

    /**
     * @return string|null
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string|null $media
     */
    public function setMedia(?string $media): void
    {
        $this->media = $media;
    }

    /**
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string|null $comments
     */
    public function setComments(?string $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return int|null
     */
    public function getSubPosts(): ?int
    {
        return $this->subPosts;
    }

    /**
     * @param int|null $subPosts
     */
    public function setSubPosts(?int $subPosts): void
    {
        $this->subPosts = $subPosts;
    }

    /**
     * @return int|null
     */
    public function getSubMin(): ?int
    {
        return $this->subMin;
    }

    /**
     * @param int|null $subMin
     */
    public function setSubMin(?int $subMin): void
    {
        $this->subMin = $subMin;
    }

    /**
     * @return int|null
     */
    public function getSubMax(): ?int
    {
        return $this->subMax;
    }

    /**
     * @param int|null $subMax
     */
    public function setSubMax(?int $subMax): void
    {
        $this->subMax = $subMax;
    }

    /**
     * @return int|null
     */
    public function getSubDelay(): ?int
    {
        return $this->subDelay;
    }

    /**
     * @param int|null $subDelay
     */
    public function setSubDelay(?int $subDelay): void
    {
        $this->subDelay = $subDelay;
    }

    /**
     * @return string|null
     */
    public function getSubExpiry(): ?string
    {
        return $this->subExpiry;
    }

    /**
     * @param string|null $subExpiry
     */
    public function setSubExpiry(?string $subExpiry): void
    {
        $this->subExpiry = $subExpiry;
    }

    /**
     * @return string|null
     */
    public function getSubResponseOrders(): ?string
    {
        return $this->subResponseOrders;
    }

    /**
     * @param string|null $subResponseOrders
     */
    public function setSubResponseOrders(?string $subResponseOrders): void
    {
        $this->subResponseOrders = $subResponseOrders;
    }

    /**
     * @return string|null
     */
    public function getSubResponsePosts(): ?string
    {
        return $this->subResponsePosts;
    }

    /**
     * @param string|null $subResponsePosts
     */
    public function setSubResponsePosts(?string $subResponsePosts): void
    {
        $this->subResponsePosts = $subResponsePosts;
    }

    /**
     * @return string|null
     */
    public function getSubStatus(): ?string
    {
        return $this->subStatus;
    }

    /**
     * @param string|null $subStatus
     */
    public function setSubStatus(?string $subStatus): void
    {
        $this->subStatus = $subStatus;
    }

    /**
     * @return float|null
     */
    public function getCharge(): ?float
    {
        return $this->charge;
    }

    /**
     * @param float|null $charge
     */
    public function setCharge(?float $charge): void
    {
        $this->charge = $charge;
    }

    /**
     * @return float|null
     */
    public function getFormalCharge(): ?float
    {
        return $this->formalCharge;
    }

    /**
     * @param float|null $formalCharge
     */
    public function setFormalCharge(?float $formalCharge): void
    {
        $this->formalCharge = $formalCharge;
    }

    /**
     * @return float|null
     */
    public function getProfit(): ?float
    {
        return $this->profit;
    }

    /**
     * @param float|null $profit
     */
    public function setProfit(?float $profit): void
    {
        $this->profit = $profit;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getStartCounter(): ?string
    {
        return $this->startCounter;
    }

    /**
     * @param string|null $startCounter
     */
    public function setStartCounter(?string $startCounter): void
    {
        $this->startCounter = $startCounter;
    }

    /**
     * @return string|null
     */
    public function getRemains(): ?string
    {
        return $this->remains;
    }

    /**
     * @param string|null $remains
     */
    public function setRemains(?string $remains): void
    {
        $this->remains = $remains;
    }

    /**
     * @return bool|null
     */
    public function getIsDripFeed(): ?bool
    {
        return $this->isDripFeed;
    }

    /**
     * @param bool|null $isDripFeed
     */
    public function setIsDripFeed(?bool $isDripFeed): void
    {
        $this->isDripFeed = $isDripFeed;
    }

    /**
     * @return int|null
     */
    public function getRuns(): ?int
    {
        return $this->runs;
    }

    /**
     * @param int|null $runs
     */
    public function setRuns(?int $runs): void
    {
        $this->runs = $runs;
    }

    /**
     * @return int|null
     */
    public function getInterval(): ?int
    {
        return $this->interval;
    }

    /**
     * @param int|null $interval
     */
    public function setInterval(?int $interval): void
    {
        $this->interval = $interval;
    }

    /**
     * @return string|null
     */
    public function getDripFeedQuantity(): ?string
    {
        return $this->dripFeedQuantity;
    }

    /**
     * @param string|null $dripFeedQuantity
     */
    public function setDripFeedQuantity(?string $dripFeedQuantity): void
    {
        $this->dripFeedQuantity = $dripFeedQuantity;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     */
    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }


}