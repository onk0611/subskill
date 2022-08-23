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

<form action="" class="form-group-filter">
    <input class="input-field-search" placeholder="Développeur, intégrateur .." type="search" name="search" id="search-bar">
    <input class="input-field-submit" type="button" value="🔍">
</form>

<?php foreach ($result as $data): ?>
    <div class="annonce" value="<?php echo $data['Date'] ?>">
        <img src="<?php echo $json_parsed->{'image'} ?>" class="img-annonce" alt="">
        <div class="container-information">
            <?php echo '<h2 class="title-annonce">🖇 ' . $data['Company'] . ' recherche un/une ' . $data['Title'] . ' en ' . $data['Contract'] .'</h2>'; ?>
            <?php echo '<div class="date">📅 ' . date('d/m/Y', strtotime($data['Date'])) . '</div>'; ?>
            <?php echo '<div class="location">📍 ' . $data['Location'] . '</div>'; ?>
            <?php echo '<div class="description">📝 ' . $data['Description'] . '</div>'; ?>
            <?php echo '<div class="ref">💻 ' . $data['Ref'] . '</div>'; ?>
        </div>
        
    </div>
<?php endforeach; ?>


<?php $response->closeCursor();

// DON'T CLOSE PhP !
// DON'T CLOSE PhP !
// DON'T CLOSE PhP !