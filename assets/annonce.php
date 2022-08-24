<?php

require 'db.php';


/* 
    Date : Date de mise en ligne
    Title : Titre de l'offre d'emploi
    Location : Localisation de la mission
    Contract : Type de contrat
    Profession : Métier
    Company : Entreprise
    Ref : Référence de l'annonce
    Description : Description de l'annonce
*/

// appel de l'API, et récupération de l'URL après l'avoir décodé
$url = "https://some-random-api.ml/meme";
$json_url_img = file_get_contents($url);
$json_parsed = json_decode($json_url_img);

// pagination requête & logique
$req_count = "SELECT COUNT(id) as nbrAnnonce FROM bid";
$res_count = $db->prepare($req_count);
$res_count->execute();
$count = $res_count->fetchAll();
$nbrAnnonce = $count[0]["nbrAnnonce"];
$annonce_per_page = 10;
$nbrPage = ceil($nbrAnnonce / $annonce_per_page);
$actual_page = 1;

$getPage = $_GET['page'];

if(isset($getPage) && $getPage>0 && $getPage<=$nbrPage) {
    $actual_page = $getPage;
} else {
    $actual_page = 1;
}

// récupération de toute la base de données 
$request = "SELECT * FROM bid LIMIT " . (($actual_page-1)*$annonce_per_page) .", $annonce_per_page";
$response = $db->prepare($request);
$response->execute();
$result = $response->fetchAll();

?>

<form action="" class="form-group-filter">
    <input class="input-field-search" placeholder="Développeur, intégrateur .." type="search" name="search" id="search-bar">
    <input class="input-field-submit" type="button" value="🔍">
    <a class="input-field-submit link" href="./index.php?page=1">Réinitialiser les filtres</a>
    <!-- input de type "reset" fonctionne également -->
</form>

<?php foreach ($result as $data): ?>
    <div class="annonce" value="<?php echo $data['id'] ?>">
        <img src="<?php echo $json_parsed->{'image'} ?>" class="img-annonce" alt="">
        <div class="container-information">
            <?php echo $data['id'] ?>
            <?php echo '<h2 class="title-annonce">🖇 ' . $data['Company'] . ' recherche un/une ' . $data['Title'] . ' en ' . $data['Contract'] .'</h2>'; ?>
            <?php echo '<div class="date">📅 ' . date('d/m/Y', strtotime($data['Date'])) . '</div>'; ?>
            <?php echo '<div class="location">📍 ' . $data['Location'] . '</div>'; ?>
            <?php echo '<div class="description">📝 ' . $data['Description'] . '</div>'; ?>
            <?php echo '<div class="ref">💻 ' . $data['Ref'] . '</div>'; ?>
            <input class="postuler" type="button" onclick="alert('Coming Soon ..')" value="📨 Postuler">
        </div>
    </div>
    
<?php 
    endforeach;
?>

<div class="pagination">

<?php

// pagination
for ($i=1; $i<=$nbrPage; $i++) {
    if ($i==$actual_page) {
        echo '<span class="link-actuel-page">' . $i . '</span>';
    } else {
        echo '<a class="link-pagination" href="index.php?page=' . $i . '"> ' . $i . '</a> ';
    }
}

?>

</div>

<?php

$response->closeCursor();
