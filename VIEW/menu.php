<?php
require_once "../MODELE/Person.class.php";
require_once "../MODELE/Worker.class.php";
require_once "../MODELE/Customer.class.php";
require_once "../MODELE/Tools.class.php";
require_once "../MODELE/Room.class.php";
require_once "../MODELE/Hotel.class.php";
require_once "../MODELE/PDF_Invoice.class.php";
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/menu.css">

    <title>MenuEmploye.php</title>
</head>

<body>
    <div class="container">

        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">VotreHôtel.fr</h3>
                <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="menu.php">Retour au menu</a>
            </nav>
            </div>
        </header>

        <div class="row justify-content-center">
            <div class="col-12">
              <h1>MENU DE L'HOTEL</h1>
            </div>
        </div>
        
        <div class="row justify_content-center">      
            <div class="col-8 menu-list">
                <table class="table table-striped">
                    <form action="" method="post">
                    <thead>
                        <tr>
                            <th scope="col">Listes des menus</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Afficher l’état de l’hôtel</td>                             
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/displayHotel.action.php">Let's Go</button></td> 
                        </tr>
                        <tr>  
                            <td>Afficher le nombre de chambres réservées</td>  
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/displayBookedRoom.action.php">Let's Go</button></td>                                                                                                                                          
                        </tr>
                        <tr>
                            <td>Afficher le nombre de chambres libres</td>
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/displayFreeRoom.action.php">Let's Go</button></td>
                        </tr>
                        <tr>  
                            <td>Afficher le numéro de la première chambre vide</td>      
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/displayFirstRoom.action.php">Let's Go</button></td>            
                        </tr>
                        <tr>  
                            <td>Afficher le numéro de la dernière chambre vide</td>       
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/displayLastRoom.action.php">Let's Go</button></td>           
                        </tr>
                        <tr>   
                            <td>Réserver une chambre</td>           
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/passwordBooking.action.php">Let's Go</button></td>      
                        </tr>
                        <tr>  
                            <td>Libérer une chambre</td>  
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/passwordFree.action.php">Let's Go</button></td>                
                        </tr>
                        <tr>  
                            <td>Modifier une réservation</td>      
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/passwordEdit.action.php">Let's Go</button></td>            
                        </tr>
                        <tr>  
                            <td>Annuler une réservation</td> 
                            <td><button type="submit" class="btn btn-secondary" formaction="../CTRL/passwordCancel.action.php">Let's Go</button></td>                 
                        </tr>
                        <tr>   
                            <td>Quitter</td>     
                            <td><button type="button" class="btn btn-danger"> <a href="../VIEW/login.php">Let's Go</a> </button></td>            
                    </tbody>
                </table>
            </div>
        </div>

        <footer>
                <p>Projet aout 2020 - PGA && MVI.</p>
        </footer>
        
    </div>


    <?php
        unset($_SESSION['displayRoomBooked']);
        unset($_SESSION['displayRoomFree']);
        unset($_SESSION['displayFirstRoomFree']);
        unset($_SESSION['displayLastRoomFree']);
        unset($_SESSION['customer']);
        unset($_SESSION['client1']);
        unset($_SESSION['prixTotalTTC']);
        unset($_SESSION['prixDiff']);
        unset($_SESSION['remboursement']);
        unset($_SESSION['room']);
        unset($_SESSION['booking']);
        unset($_SESSION['roomCancel']);
        unset($_SESSION['roomsBookedSimple']);
        unset($_SESSION['displayHotel']);
        unset($_SESSION['roomModified']);
        unset($_SESSION['numOfFacture']);
        unset($_SESSION['roomFree']);
        unset($_SESSION['dateStart']);
        unset($_SESSION['dateEnd']);
        unset($_SESSION['numRoom']);
        unset($_SESSION['newDateStart']);
        unset($_SESSION['newDateEnd']);
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>