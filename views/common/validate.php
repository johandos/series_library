<?php if (isset($_SESSION['errors'])){ ?>
    <div>
        <?php foreach ($_SESSION['errors']['value'] as $errors){ ?>
            <?php foreach ($errors as $error){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>


