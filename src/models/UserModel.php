<?php

namespace Wskz\Models;

use DateTime;


class UserModel
{
    private int $id;
    private string $login;
    private string $first_name;
    private string $last_name;
    private string $gender;
    private DateTime $created_at;
    private ?DateTime $last_login;
    private string $password;

    public static function builder(): self
    {
        return new self();
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
     * @return UserModel
     */
    public function setId(int $id): UserModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return UserModel
     */
    public function setLogin(string $login): UserModel
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     *
     * @return UserModel
     */
    public function setFirstName(string $first_name): UserModel
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     *
     * @return UserModel
     */
    public function setLastName(string $last_name): UserModel
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     *
     * @return UserModel
     */
    public function setGender(string $gender): UserModel
    {
        $this->gender = $gender;
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
     * @return UserModel
     */
    public function setCreatedAt(DateTime $created_at): UserModel
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getLastLogin(): ?DateTime
    {
        return $this->last_login;
    }

    /**
     * @param ?DateTime $last_login
     *
     * @return UserModel
     */
    public function setLastLogin(?DateTime $last_login): UserModel
    {
        $this->last_login = $last_login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return UserModel
     */
    public function setPassword(string $password): UserModel
    {
        $this->password = $password;
        return $this;
    }

}
