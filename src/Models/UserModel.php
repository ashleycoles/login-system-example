<?php

require_once 'src/Entities/User.php';

class UserModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getById(int $id): User|false
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `password`, `bio` FROM `users` WHERE `id` = :id;');
        $query->execute([
            ':id' => $id
        ]);

        $data = $query->fetch();

        if (!$data) {
            return false;
        }

        return $this->hydrate($data);
    }

    public function getByUsername(string $username): User|false
    {
        $query = $this->db->prepare('SELECT `id`, `username`, `password`, `bio` FROM `users` WHERE `username` = :username;');
        $query->execute([
            ':username' => $username
        ]);

        $data = $query->fetch();

        if (!$data) {
            return false;
        }

        return $this->hydrate($data);
    }

    public function isUsernameUnique(string $username): bool
    {
        $query = $this->db->prepare('SELECT `id` FROM `users` WHERE `username` = :username;');

        $query->execute([
            ':username' => $username
        ]);

        $result = $query->fetch();

        if (!$result) {
            return true;
        }

        return false;
    }

    public function addUser(User $user): bool
    {
        $query = $this->db->prepare('INSERT INTO `users` (`username`, `password`, `bio`) VALUES (:username, :password, :bio)');
        return $query->execute([
            ':username' => $user->username,
            ':password' => $user->password,
            ':bio' => $user->bio
        ]);
    }
    private function hydrate(array $data): User
    {
        return new User($data['username'], $data['password'], $data['bio'], $data['id']);
    }
}