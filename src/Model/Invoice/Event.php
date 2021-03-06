<?php

declare(strict_types=1);

namespace Billogram\Model\Invoice;

use Billogram\Model\CreatableFromArray;

/**
 * @author Ibrahim Hizeoui <ibrahimhizeoui@gmail.com>
 */
class Event implements CreatableFromArray
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $type;

    /**
     * @var EventData
     */
    private $data;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Event
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $new = clone $this;
        $new->createdAt = $createdAt;

        return $new;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Event
     */
    public function setType(string $type)
    {
        $new = clone $this;
        $new->type = $type;

        return $new;
    }

    /**
     * @return EventData
     */
    public function getDate()
    {
        return $this->data;
    }

    /**
     * @param EventData $data
     *
     * @return Event
     */
    public function setDate(EventData $data)
    {
        $new = clone $this;
        $new->data = $data;

        return $new;
    }

    public function toArray()
    {
        $data = [];
        if (null !== $this->createdAt) {
            $data['created_at'] = $this->createdAt->getTimestamp();
        }
        if (null !== $this->type) {
            $data['type'] = $this->type;
        }
        if (null !== $this->data) {
            $data['data'] = $this->data->toArray();
        }

        return $data;
    }

    /**
     * Create an API response object from the HTTP response from the API server.
     *
     * @param array $data
     *
     * @return self
     */
    public static function createFromArray(array $data)
    {
        $event = new self();
        $event->type = $data['type'] ?? null;
        $event->createdAt = isset($data['created_at']) ? new \DateTime($data['created_at']) : null;
        $event->data = isset($data['data']) ? EventData::createFromArray($data['data']) : null;

        return $event;
    }
}
