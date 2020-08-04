<?php

require_once ("../MODELE/Hotel.class.php");
require_once ("../MODELE/Room.class.php");
require_once ("../MODELE/Person.class.php");
require_once ("../MODELE/Customer.class.php");
require_once ("../MODELE/Worker.class.php");
require_once ("../MODELE/Tools.class.php");
session_start();


$upload_dir = "../FILES/INPUT";

$validation = true;

$messages = array(
    'fichier' => '',
    'formulaire' => ''
);
// vérification des fichiers envoyés
if ($_FILES) {
    // validation du champ 'fichier'
    if (isset($_FILES['fichier']) && !empty($_FILES['fichier'])) {
        switch ($_FILES['fichier']['error']) {
            case UPLOAD_ERR_OK:
                // il n'y a pas d'erreur
                // on peut stocker le fichier
                if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $upload_dir . '/' . $_FILES['fichier']['name'])) {
                    // il y a une erreur
                    // php n'est pas parvenu à stocker le fichier
                    $validation = false;
                    // affectation d'un message d'erreur
                    $messages['fichier'] = "une erreur est survenue, le fichier '{$_FILES['fichier']['name']}' n'a pas pu être enregistré";
                    $_SESSION['message'] = $messages;
                    header("Location: ../VIEW/index.php");

                } else {
                    if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $upload_dir . '/' . $_FILES['fichier']['name'])) {

                        $pathCsv = $upload_dir . '/' . $_FILES['fichier']['name'];
                        $arrCsv = Tools::loadCsv($pathCsv);
                        $hotel = new Hotel($arrCsv);
                        $_SESSION['hotel'] = $hotel;
                        header("Location: ../VIEW/login.php");

                    }
                }
                break;
            case UPLOAD_ERR_NO_FILE:
                // il y a une erreur
                // l'utilisateur n'a pas envoyé de fichier

                $validation = false;
                // affectation d'un message d'erreur
                $messages['fichier'] = "merci de sélectionner un fichier";
                $_SESSION['message'] = $messages;
                header("Location: ../VIEW/index.php");

                break;
            default:
                // il y a une erreur
                $validation = false;
                // affectation d'un message d'erreur
                $messages['fichier'] = "une erreur est survenue, le fichier '{$_FILES['fichier']['name']}' n'a pas pu être enregistré";
                $_SESSION['message'] = $messages;
                header("Location: ../VIEW/index.php");

        }
    }
}