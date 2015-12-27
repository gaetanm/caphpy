<?php use sys\helper\Html;?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php echo Html::css('default');?>
        <title>
            System error
        </title>
    </head>

    <body>
        <section>
            <div class="error">
                <p>
                    <?php echo $errorMessage;?>
                </p>
            </div>
        </section>
    </body>
</html>