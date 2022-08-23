<?php 

// Connexion à la base de données / import du Header
require './assets/db.php';
require './assets/conponents/header.php';


// récupération de toute la base de données 
$request = "SELECT * FROM bid";
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

$response = $db->prepare($request);
$response->execute();
$result = $response->fetchAll();

$url = "https://some-random-api.ml/meme";
$json_url_img = file_get_contents($url);
$json_parsed = json_decode($json_url_img);

?>


<?php foreach ($result as $data): ?>
    <div class="annonce" value="<?php echo $data['Date'] ?>">
        <img src="<?php echo $json_parsed->{'image'} ?>" class="img-annonce" alt="">
        <?php echo '<div class="title-annonce">' . $data['Company'] . ' recherche un/une ' . $data['Title'] . '</div>'; ?>
        <?php echo '<div class="description">' . $data['Description'] . '</div>'; ?>
        <?php echo '<div class="date">Publié le ' . date('d/m/Y', strtotime($data['Date'])) . '</div>'; ?>
        <?php echo '<div class="ref">' . $data['Ref'] . '</div>'; ?>
        <?php echo '<div class="location"> Le poste est basé à ' . $data['Location'] . '.</div>'; ?>
    </div>
<?php endforeach; ?>


<?php // $response->closeCursor(); ?>

