<?php
require_once './includes/autoload.php';

$enquetemapper = new Mapper\EnqueteMapper();
$listEnquetes = $enquetemapper->getAllEnquete();

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Accueil - Répondants</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <body>
        <div class="index container">
            
            <div class="page-header">
                <h1 class="">Les enquetes disponibles</h1>
            </div>
                        
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h4><span class="glyphicon glyphicon-edit"></span> Listes des enquetes</h4>
        <?php if ($listEnquetes) : ?>
                <div class="table-container">
                    <table class="table table-striped">
                        <?php foreach ($listEnquetes as $value) : ?>
                            <tr>
                                <td class='col-md-10'><?= htmlspecialchars($value['TITRE']) ?></td>
                                <td class='col-lg-offset-10 col-md-2'><a class="btn btn-success btn-sm" href="enquete.php?idenquete=<?= htmlspecialchars($value['ID_ENQUETE']) ?>">Répondre à l'enquête</a></td>
                                </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </body>
</html>
