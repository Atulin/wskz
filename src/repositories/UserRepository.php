<?php
namespace Wskz\Repositories;
use DateTime;
use Exception;
use Wskz\Models\UserModel;


class UserRepository extends BaseRepository
{
    public function create(UserModel $user): bool
    {
        $algo = in_array('argon2id', password_algos()) ? PASSWORD_ARGON2ID : PASSWORD_DEFAULT;

        $sql = <<<SQL
                    INSERT INTO users (login, first_name, last_name, gender, password)
                    VALUES (:login, :first, :last, :gender, :pass)
               SQL;

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'login' => $user->getLogin(),
            'first' => $user->getFirstName(),
            'last' => $user->getLastName(),
            'gender' => $user->getGender(),
            'pass' => password_hash($user->getPassword(), $algo),
        ]);
    }

    public function login(string $login, string $password): ?int {
        $sql = <<<SQL
                    SELECT u.id, u.password
                    FROM users u
                    WHERE u.login = :login
                SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'login' => $login,
        ]);
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return null;
    }

    public function checkLoginExist(string $login): bool
    {
        $sql = <<<SQL
                    SELECT COUNT(u.id)
                    FROM users u
                    WHERE u.login = :login
                SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'login' => $login
        ]);

        return $stmt->fetchColumn() ? true : false;
    }

    public function getById(int $id): ?UserModel
    {
        $sql = <<<SQL
                    SELECT u.login, u.first_name, u.last_name, u.gender, u.created_at, u.last_login
                    FROM users u
                    WHERE u.id = :id
                SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        if ($user = $stmt->fetch()) {
            try {
                return UserModel::builder()
                    ->setLogin($user['login'])
                    ->setFirstName($user['first_name'])
                    ->setLastName($user['last_name'])
                    ->setGender($user['gender'])
                    ->setCreatedAt(new DateTime($user['created_at']))
                    ->setLastLogin($user['last_login'] ? new DateTime($user['last_login']) : null);
            } catch (Exception $e) {
                return null;
            }
        }
        return null;
    }
}
