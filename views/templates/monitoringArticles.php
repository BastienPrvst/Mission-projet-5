<?php


?>


<h2>Détails des articles</h2>


<table class="admin-table">
    <thead>
        <tr>
            <th><a href="index.php?action=monitoringArticles&key=title&type=DESC"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=title&type=ASC"><i class="fa-solid fa-sort-down"></i></a> Titre</th>
            <th><a href="index.php?action=monitoringArticles&key=views&type=DESC"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=views&type=ASC"><i class="fa-solid fa-sort-down"></i></a> Nbr. Vues</th>
            <th><a href="index.php?action=monitoringArticles&key=comment_count&type=DESC"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=comment_count&type=ASC"><i class="fa-solid fa-sort-down"></i></a> Nbr. Commentaires</th>
            <th><a href="index.php?action=monitoringArticles&key=date_creation&type=DESC"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=date_creation&type=ASC"><i class="fa-solid fa-sort-down"></i></a> Date de publication</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($articles as $article){ ?>

            <tr>
                <td><a href="index.php?action=showArticle&id=<?=$article->getId()?>"><?= $article->getTitle()?></a></td>
                <td><?= $article->getViews()?></td>
                <td><?= $article->comment_count?></td>
                <td><?= $article->getDateCreation()->format("d-m-Y")?></td>
            </tr>

        <?php } ?>


    </tbody>
</table>



