<?php

readonly class User
{
    // The id is nullable to allow us to use this User when creating a registering a new account
    // new accounts won't have an ID yet.
    public ?int $id;
    public string $username;
    public string $password;
    public ?string $bio; // Bio is optional in the DB, so make it nullable

    public function __construct(string $username, string $password, ?string $bio = null, ?int $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->bio = $bio;
    }


}