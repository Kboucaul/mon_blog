<?php

namespace Models;

class Comment extends Model
{
    protected $table = "comments";

/**
 * Insère un nouveau commentaire dans la base de données
 *
 * @param string $author
 * @param string $content
 * @param integer $article_id
 *
 * @return void
 */
    public function findAllWithArticle(int $article_id): array
    {
        // 2. On récupère les commentaires
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id ORDER BY created_at ASC");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();

        // 3. On retourne les commentaires
        return $commentaires;
    }

public function insert(string $author, string $content, int $article_id): void
{
    // 2. On exécute la requête
    $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}
}