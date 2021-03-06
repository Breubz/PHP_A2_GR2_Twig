<?php
/**
 * @author Thibaud BARDIN (https://github.com/Irvyne).
 * This code is under MIT licence (see https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/_header-admin.php';

$articles = getArticles($link);
$categories = getCategories($link);
$boolean = null;
$errors = [];

if (!empty($_POST) && isset($_POST['submitArticle'])) {
    $mandatory = ['title', 'content', 'category'];
    foreach($mandatory as $name) {
        if (empty($_POST[$name])) {
            $errors[] = $name.' cannot be empty!';
        }
    }

    if (0 === sizeof($errors)) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $enabled = isset($_POST['enabled']) ? true : false;
        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        $categoryId = (int) $_POST['category'];
        $tagsId = isset($_POST['tags']) ? $_POST['tags'] : null;

       // var_dump($_FILES['image']);

        $boolean = addArticle($link, $title, $content, $enabled, $image, $categoryId, 1, $tagsId);
    }

}

echo $twig ->render('admin-article-add.html.twig',[
    'articles' => $articles,
    'connected' => isConnected(),
    'username' => $_SESSION['username'],
    'boolean' => $boolean,

]);


require __DIR__.'/_footer.php';
