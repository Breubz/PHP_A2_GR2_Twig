<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

$articles = getArticles($link);
$categories = getCategories($link);


echo $twig ->render('admin-article-list.html.twig',[
    'articles' => $articles,
    'connected' => isConnected(),
    'username' => $_SESSION['username'],
]);

require __DIR__.'/_footer.php';
