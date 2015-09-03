<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: login.php");
        die("Redirecting to login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christophe Delaere">

    <title>Nemrod's Dashboard</title>

    <?php include "stdHeaders.html"; ?>

</head>

<body>

    <div id="wrapper">

        <?php include "navigation.html"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
			<h1 class="page-header">Lorem ipsum dolor sit amet</h1>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu gravida justo, id fermentum orci. Morbi tincidunt lectus vitae lacus semper rhoncus. Phasellus placerat urna at enim condimentum, sit amet facilisis nisi aliquam. Phasellus vulputate id nibh a sagittis. Nulla eleifend ac massa non vehicula. Nunc dui dui, gravida vel lectus at, varius malesuada urna. Suspendisse placerat auctor lobortis. Donec at orci non orci placerat eleifend eu id felis. Morbi ultrices tellus nibh. Integer et massa interdum neque tempus vestibulum. In a auctor est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque tincidunt aliquam odio in rhoncus.
</p><p>
Morbi dapibus, nulla in blandit aliquet, ipsum magna scelerisque metus, non malesuada elit massa in nibh. Mauris et tellus mollis, dignissim urna id, vestibulum mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sit amet ipsum porttitor, venenatis ligula sed, luctus velit. Maecenas a maximus nunc. Nam tincidunt odio sit amet metus facilisis rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam varius enim gravida libero viverra, nec aliquam mauris sodales. Duis elementum sodales euismod. Ut diam nibh, congue ac lectus vel, efficitur tristique sem. Integer nulla neque, mattis congue leo id, egestas iaculis tellus. Duis nec eros pulvinar, interdum mauris quis, dictum nisi. Donec ut nunc erat. Nam non molestie mauris, nec accumsan elit. Donec nunc elit, blandit non iaculis sit amet, rutrum gravida justo. Suspendisse viverra nisl vitae eros pulvinar convallis.
</p><p>
Curabitur ac tellus enim. Vivamus auctor tempor semper. Proin tincidunt lectus id efficitur sodales. Mauris aliquet, ex ac rutrum rutrum, nibh tellus dapibus sapien, ut porta quam nisl ac nulla. Nam orci nisl, auctor vitae suscipit nec, bibendum id arcu. Nulla scelerisque eget odio a fermentum. Fusce eros arcu, imperdiet id ullamcorper quis, sodales vel nisi. Sed felis ex, ultricies eu eleifend ac, ultrices vel lacus. Vestibulum semper diam vel turpis vestibulum faucibus. Morbi ut consectetur leo. Suspendisse ut erat mauris. Nam non urna venenatis, efficitur nisi vitae, dictum mauris. Sed fringilla vel orci at cursus. Aenean at orci cursus, cursus neque a, congue ante. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut ut dui placerat, rhoncus libero nec, eleifend nunc.
</p><p>
Vestibulum ac faucibus nisl. Sed at facilisis diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nulla, accumsan convallis imperdiet sed, interdum ut leo. Fusce viverra sapien sed purus porttitor, vel mattis lorem consectetur. Sed efficitur, metus eget hendrerit dignissim, ante erat consequat nisl, a luctus velit lectus non erat. Aenean lacinia porttitor mi eget lobortis.
</p><p>
Aenean convallis tortor eu odio ornare, non condimentum quam condimentum. Etiam molestie, magna vel accumsan efficitur, sapien tellus porta mauris, id faucibus neque nulla ut massa. Nunc in purus eros. Duis vel velit sed enim sagittis pellentesque. Aliquam ac congue erat. Sed a ex auctor, posuere elit a, ornare ante. Nam eleifend nulla quis dolor gravida dignissim. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse finibus ipsum tellus, venenatis faucibus nisi volutpat fermentum.
</p>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "stdScripts.html"; ?>

</body>

</html>
