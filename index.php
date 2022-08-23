<?php 

// Connexion à la base de données / import du Header
require './assets/db.php';
require './assets/conponents/header.php';


// récupération de toute la base de données 
$request = "SELECT date, title, location, profession, company, ref, description FROM 'bid'";


$response = $db->prepare($request);
$response->execute();

$result = $response->fetchAll();

?>

<div class="annonce">
<?php foreach ($result as $data): ?>
    <?php echo $data['title']; ?>
<?php endforeach; ?>
</div>

<?php $response->closeCursor(); ?>

