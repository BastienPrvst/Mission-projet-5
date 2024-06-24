<?php


?>


<h2>Détails des articles</h2>


<table class="admin-table">
    <thead>
        <tr>
            <th><a href="index.php?action=monitoringArticles&key=title&type=true"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=title&type=false"><i class="fa-solid fa-sort-down"></i></a> Titre</th>
            <th><a href="index.php?action=monitoringArticles&key=views&type=true"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=views&type=false"><i class="fa-solid fa-sort-down"></i></a> Nbr. Vues</th>
            <th><a href="index.php?action=monitoringArticles&key=comment_count&type=true"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=comment_count&type=false"><i class="fa-solid fa-sort-down"></i></a> Nbr. Commentaires</th>
            <th><a href="index.php?action=monitoringArticles&key=date_creation&type=true"><i class="fa-solid fa-sort-up"></i></a><a href="index.php?action=monitoringArticles&key=date_creation&type=false"><i class="fa-solid fa-sort-down"></i></a> Date de publication</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($articles as $article){ ?>

            <tr>
                <td><?= $article->getTitle()?></td>
                <td><?= $article->getViews()?></td>
                <td><?= $article->comment_count?></td>
                <td><?= $article->getDateCreation()->format("d-m-Y")?></td>
            </tr>

        <?php } ?>


    </tbody>
</table>



