<?php
require_once('./Backend/Animal.php');
$animal = new Animal();

$price = $_REQUEST['price'] + 0;
$species = $_REQUEST['species'];
$group = $_REQUEST['group'];
$is_healhty = $_REQUEST['healthy'];
$is_pregnant = $_REQUEST['pregnant'];

$is_healhty = ($is_healhty === 'yes') ? 1 : 0;
$is_pregnant = ($is_pregnant === 'yes') ? 1 : 0;

if ($animal->add_animal($price, $species, $is_pregnant, $is_healhty, $group)) {
    echo "Added ";
} else {
    echo "NOt added";
}

?>

