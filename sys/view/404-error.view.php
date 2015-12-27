<?php use sys\helper\Html;?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php echo Html::css('default');?>
        <title>
            Ressource not found
        </title>
    </head>

    <body>
        <section>
            <div class="error">
                <h1>Page not found</h1>
                <p>
                    <?php 
                    if(isset($errorMessage)) echo $errorMessage;
                    else {?>

                    The requested ressource was not found on this server.
                    
                    }?>
                </p>
            </div>
        </section>
    </body>
</html>