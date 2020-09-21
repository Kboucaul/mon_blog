<?php

/**
 * Fonction chargée de rendre notre affichage
 *
 * @param string $path
 * @return void
 * 
 * ex : render('articles/show)
 *  => templates/articles/show.html.php
 */
function render(string $path, array $variables = [])
{
    /*
    **  Ici on extrait les variables du tableau.
    **  ex : $tab[ 
    **      'title' => "mon Titre"
    **  ]
    **      => $title = "mon Titre";
    */
    extract($variables);
    ob_start();
    require("templates/" . $path . '.html.php');
    $pageContent = ob_get_clean();
    require('templates/layout.html.php');
}

/**
 * Fonction chargée de la redirection
 *
 * @param string $url
 * @return void
 */
function  redirect(string $url): void
{
    header("Location: $url");
    echo $url;
    exit();
}