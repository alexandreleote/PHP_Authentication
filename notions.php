<?php

$password = "monMotdePasse1234";
$password2 = "monMotdePasse1234";


/* Algorithme de hachage dit FAIBLE */
$md5 = hash('md5', $password); // ne change pas à chaque rechargement d'une page
$md5_2 = hash('md5', $password2); // le hash sera le même

echo $md5."<br>";
echo $md5_2."<br>";

$sha256 = hash('sha256', $password); // idem le mot de passe haché reste le même, il n'est pas regénéré
$sha256_2 = hash('sha256', $password2); // si deux utilisauteurs ont le même mdp, idem le hachage reste le même

echo $sha256."<br>";
echo $sha256_2."<br>";

/* Algorithme de hachage dit FORT */ // -> mettre en BDD un varchar de 255 caractères

// Empreinte numérique = intégralité de la chaîne de caractères du mot de passe qui sera stockée en base de données et qui sera interprétée pour se connecter
// Hash du mdp = partie définie dans la chaîne de caractères 
// Sel / Salt = chaîne de caractère également aléatoire, rajoutée avant la partie hashée pour renforcer la partie initiale | il peut y avoir un
// Algorithm options (eg cost) = coût : une variable générée par défaut par l'agorithm de hachage qui est généré, cela permet de contrer les tentatives de piratage
// 2 puissance 10 de tentatives dans l'exemple de pouvoir essayer de rentrer le mot de passe 
// Au tout début : la version de l'algorithm qui a été utilisée

/* BCRYPT */
$hash = password_hash($password, PASSWORD_DEFAULT); // hachage du mot de passe avec un algorithme de hachage fort et irréversible
$hash2 = password_hash($password2, PASSWORD_DEFAULT); // hachage du mot de passe avec un algorithme de hachage fort et irréversible
echo $hash."<br>";
echo $hash2."<br>";

/* ARGON2I */
$hash3 = password_hash($password, PASSWORD_ARGON2I); // Avec l'algorithme argon2i
$hash4 = password_hash($password2, PASSWORD_ARGON2I);
echo $hash3."<br>";
echo $hash4."<br>";

// On voit qu'avec un algorithme fort, les hachages sont aléatoires et régénérés même pour un même mot de passe de plusieurs utilisateurs

/* Vérification du mot de passe saisi dans le formulaire de login */
$saisie = "monMotdePasse1234"; // Avec un input type = password

$verify = password_verify($saisie, $hash3);
echo $verify."<br>";