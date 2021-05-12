<?php include 'header.php'; ?>
<h1 class="text-center">Delete Video Game Confirmation</h1>
<h4 class="text-center text-secondary">Are you sure you want to delete <?php echo $videoGame->getVideoGameTitle(); ?>?</h4>
<form action="." method="post" class="col-lg-6 mx-auto">
    <hr>
    <div class="form-group">
        <p><strong>Video Game ID:</strong></p>
        <p><?php echo $videoGame->getId(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Video Game Title:</strong></p>
        <p><?php echo $videoGame->getVideoGameTitle(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Type of Game:</strong></p>
        <p><?php echo $videoGame->getTypeOfGame(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Platform:</strong></p>
        <p><?php echo $videoGame->getPlatform(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>ESRB Rating:</strong></p>
        <p><?php echo $videoGame->getVideoGameRating(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Metacritic User Rating:</strong></p>
        <p><?php echo $videoGame->getMetacriticUserRating(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>IGN Rating:</strong></p>
        <p><?php echo $videoGame->getIgnRating(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Game Spot Rating:</strong></p>
        <p><?php echo $videoGame->getGamespotRating(); ?></p>
    </div>
    <div class="form-group">
        <p><strong>Composite Rating:</strong></p>
        <p><?php echo $videoGame->getCompositeRating(); ?></p>
    </div>
    <div class="form-group text-center">
        <input type="hidden" name="ID" value="<?php echo $videoGame->getId(); ?>">
        <input type="hidden" name="Title" value="<?php echo $videoGame->getVideoGameTitle(); ?>">
        <input type="hidden" name="action" value="delete-video-game">
        <input type="submit" class="btn btn-secondary" value="Yes, Delete Video Game">
        <a href="." class="btn btn-secondary">No, Do Not Delete Video Game</a>
    </div>
</form>
<?php include 'footer.php'; ?>

