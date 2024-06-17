<?php


?>


<h2>Détails des articles</h2>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Nbr. Vues</th>
<!--            <th>Nbr. Commentaires</th>-->
            <th>Date de publication</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($articles as $article){ ?>

            <tr>
                <td><?= $article->getTitle()?></td>
                <td><?= $article->getViews()?></td>
                <td><?= $article->getDateCreation()->format("Y-m-d")?></td>
            </tr>

        <?php } ?>


    </tbody>
</table>


