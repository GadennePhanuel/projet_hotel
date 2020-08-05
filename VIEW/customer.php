<?php

    session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CustomerRoom</title>
</head>
<body>


    <?php $customerRoom = $_SESSION['displayCustomerRoom'];
        foreach($customerRoom as $key => $value){?>
            <p> <?php echo $key. ' ' .$value. "<br>" ?></p>
        <?php } ?>




</body>
</html>