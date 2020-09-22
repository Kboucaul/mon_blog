<?php
namespace Controllers;

class Comment extends Controller {

    protected $modelName = \Models\Comment::class;
    
    public function insert()
    {
        $articleModel = new \Models\Article();
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }
        $content = null;
        if (!empty($_POST['content']))
        {
            $content = htmlspecialchars($_POST['content']);
        }
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }
        $article = $articleModel->find($article_id);
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }
        $this->model->insert($author, $content, $article_id);
        \Http::redirect('index.php?controller=article&task=show&id=' . $article_id);
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }
        $this->model->delete($id);
        $article_id = $commentaire['article_id'];
        \Http::redirect('index.php?controller=article&task=show&id=' . $article_id);
     }
}