<?php if (isset($_SESSION['success']) && $_SESSION['success']['timeout'] > time()){ ?>
    <div>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']['value'] ?>
        </div>
    </div>
<?php } ?>