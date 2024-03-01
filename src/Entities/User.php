<?php

readonly class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $bio;

    public function __construct(int $id, string $username, string $password, string $bio)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->bio = $bio;
    }


}