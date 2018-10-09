<?php
/*
 * This is the script that the form on index.php submits to
 * Its job is to:
 * 1. Get the data from the form request
 * 2. Load the books and then filter them based on the search term
 * 3. Store the results in the SESSION
 * 4. Redirect the visitor back to index.php
 */
//require 'includes/helpers.php';
require 'Name.php';
require 'Form.php';
use Namelist\Name;
use DWA\Form;
# We'll be storing data in the session, so initiate it
session_start();
# Instantiate our objects
$name = new Name('names.json');


$form = new Form($_GET);
# Get data from form request
$bday = $form->get('bday');
$personality =$form->get('personality');
$sex=$form->get('sex');

# Validate the form data
$errors = $form->validate([
    'bday' => 'required|digit|min:1900|max:2019',
    'personality' => 'required',
    'sex' => 'required'
]);

if(!$form->hasErrors) {
    $names = $name->getName($bday, $personality, $sex);
}
// # Store our results data in the SESSION so it's available when we redirect back to index.php
$_SESSION['results'] = [
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'bday' => $bday,
    'personality' => $personality,
    'sex' => $sex,
    'names' => $names,
    'nameCount' => isset($names) ? count($names) : 0

];
// # Redirect back to the form on index.php
header('Location: index.php');
