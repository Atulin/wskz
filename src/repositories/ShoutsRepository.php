<?php

namespace Wskz\Repositories;
use DateTime;
use Exception;
use Wskz\Models\ShoutModel;


class ShoutsRepository extends BaseRepository
{
    /**
     * @param int $limit
     *
     * @return ShoutModel[]
     */
    public function getSome(int $limit = 30): array
    {
        $sql = <<<SQL
                    SELECT s.created_at, s.body, u.login
                    FROM shouts s
                    LEFT JOIN users u on u.id = s.author
                    LIMIT :limit
                SQL;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'limit' => $limit
        ]);

        try {
            return array_map(static fn($item) => ShoutModel::builder()
                ->setBody($item['body'])
                ->setCreatedAt(new DateTime($item['created_at']))
                ->setAuthorName($item['login']),
            $stmt->fetchAll());
        } catch (Exception $e) {
            return [];
        }
    }

    public function create(ShoutModel $shout): bool
    {
        $sql = <<<SQL
                    INSERT INTO shouts (body, author) 
                    VALUES (:body, :author)
                SQL;
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'body' => $shout->getBody(),
            'author' => $shout->getAuthor()
        ]);
    }
}
