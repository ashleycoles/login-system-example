<?php

readonly class User
{
    public ?int $id;
    public string $username;
    public string $password;
    public ?string $bio;

    public function __construct(string $username, string $password, ?string $bio = null, ?int $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->bio = $bio;
    }


}