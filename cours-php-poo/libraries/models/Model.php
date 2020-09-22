<?php
namespace Models;
abstract class Model
{
    protected $pdo;
    protected $table;
    public function __construct()
    {
        $this->pdo = \Database::getPdo();
    }

        /**
     * Retourne un article dans la base de données grâce à son id
     *
     * @param integer $id
     *
     * @return array|bool retourne un tableau si on trouve l'article, false si on ne trouve rien
     */
    public function find(int $id): array
    {
        // 2. On prépare une requête
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();

        // 5. On retourne l'article retrouvé
        return $item;
    } 

    /**
     * Supprime un commentaire grâce à son id
     *
     * @param integer $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        // 2. On exécute la suppression
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * Retourne la liste des articles classés par date
     *
     * @return array
     */
    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        /*if ($order)
        {
            $sql .= " ORDER BY " . $order;
        }*/
        $resultats = $this->pdo->query($sql);
        $items = $resultats->fetchAll();
        return $items;
    }
}