<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles(?string $key = null, ?bool $desc = null) : array
    {
        $way = 'ASC';
        //Si $desc est true on modifie la variable en DESC
        if ($desc) {
            $way = 'DESC';
        }
        //Si nous ne mettons pas de colonne en parametre nous avons le comportement par défaut
        if (!isset($key)){
            $key = 'id';
        }

        // Changement de la requete sql pour récuperer le nombre de commentaire distinct par article
        $sql = <<<EOD
            SELECT
            a.id,
            a.title,
            a.content,
            a.views,
            a.date_creation,
            a.date_update,
            COUNT(DISTINCT c.id) AS comment_count
            FROM article a
                     LEFT JOIN comment c
                               ON c.id_article = a.id
            GROUP BY a.id, a.title, a.content, a.views, a.date_creation, a.date_update
            ORDER BY $key $way
        EOD;

        $result = $this->db->query($sql);
        $articles = [];
        //Nous devons autoriser la classe à avoir des propriétés dynamiques avec #[AllowDynamicProperties]
        while ($article = $result->fetch()) {
            $newArticle = new Article($article);
            $newArticle->comment_count = $article['comment_count'];
            $articles[] = $newArticle;
        }

        return $articles;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    public function incrementArticleViews(int $id) : void
    {
        $sql = "UPDATE article SET views = views + 1 WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);

    }
    
}