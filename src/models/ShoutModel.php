<?php

namespace Wskz\Models;
use DateTime;
use JsonSerializable;


class ShoutModel implements JsonSerializable
{
    private int $id;
    private string $body;
    private int $author;
    private string $author_name;
    private DateTime $created_at;

    public static function builder(): self {
        return new self();
    }

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->body,
            'author_name' => $this->author_name,
            'created_at' => $this->created_at->format('c')
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return ShoutModel
     */
    public function setId(int $id): ShoutModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return ShoutModel
     */
    public function setBody(string $body): ShoutModel
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }

    /**
     * @param int $author
     *
     * @return ShoutModel
     */
    public function setAuthor(int $author): ShoutModel
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->author_name;
    }

    /**
     * @param string $author_name
     *
     * @return ShoutModel
     */
    public function setAuthorName(string $author_name): ShoutModel
    {
        $this->author_name = $author_name;
        return $this;
    }


    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     *
     * @return ShoutModel
     */
    public function setCreatedAt(DateTime $created_at): ShoutModel
    {
        $this->created_at = $created_at;
        return $this;
    }
}
