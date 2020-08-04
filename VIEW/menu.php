<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/menu.css">

    <title>Menu.php</title>
</head>
<body>
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-8">
              <h1>MENU DE L'HOTEL</h1>
            </div>
        </div>
        
        <div class="row justify_content-center">      
            <div class="col-8 menuList">
                <ul class="list-group">
                    <li class="list-group-item">Liste des menus</li>

                    
                    <li class="list-group-item list-group-item-1 list-group-item-primary">Afficher l’état de l’hôtel</li>
                    <li class="list-group-item list-group-item-1 list-group-item-success">Afficher le nombre de chambres réservées</li>
                    <li class="list-group-item list-group-item-1 list-group-item-success"> Afficher le nombre de chambres libres</li>
                    <li class="list-group-item list-group-item-1 list-group-item-info">Afficher le numéro de la première chambre vide</li>
                    <li class="list-group-item list-group-item-1 list-group-item-info">Afficher le numéro de la dernière chambre vide</li>
                    <li class="list-group-item list-group-item-1 list-group-item-warning">Réserver une chambre</li>
                    <li class="list-group-item list-group-item-1 list-group-item-warning">Libérer une chambre</li>
                    <li class="list-group-item list-group-item-1 list-group-item-warning">Modifier une réservation</li>
                    <li class="list-group-item list-group-item-1 list-group-item-warning">Annuler une réservation</li>

                    <li class="list-group-item list-group-item-1 list-group-item-danger">Quitter</li>
                </ul>
            </div>
            <div class="col-4 menuSubmit">
                <ul class="list-group">
                    <li class="list-group-item">Choix</li>

                    <form action="" method="post">
                        <li class="list-group-item list-group-item-2 list-group-item-primary">
                            <button type="submit" class="btn btn-primary" formaction="">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-success">
                            <button type="button" class="btn btn-success">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-success">
                            <button type="button" class="btn btn-success">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-info">
                            <button type="button" class="btn btn-info">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-info">
                            <button type="button" class="btn btn-info">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-warning">
                            <button type="button" class="btn btn-warning">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-warning">
                            <button type="button" class="btn btn-warning">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-warning">
                            <button type="button" class="btn btn-warning">Let's Go</button>
                        </li>
                        <li class="list-group-item list-group-item-2 list-group-item-warning">
                            <button type="button" class="btn btn-warning">Let's Go</button>
                        </li>

                        <li class="list-group-item list-group-item-2 list-group-item-danger">
                            <button type="button" class="btn btn-danger">Let's Go</button>
                        </li>
                    </form>
                </ul>
            </div>
        </div>

        
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>