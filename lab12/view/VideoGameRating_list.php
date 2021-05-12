<?php include 'header.php'; ?>
<table class="table table-hover">
    <caption><h1>Video Game Ratings List</h1></caption>
    <thead>
    <tr>
        <th scope="col">Video Game Title</th>
        <th scope="col">Type of Game</th>
        <th scope="col">Platform</th>
        <th scope="col">ESRB Rating</th>
        <th scope="col">Metacritic User Rating</th>
        <th scope="col">IGN Rating</th>
        <th scope="col">Game Spot Rating</th>
        <th scope="col">Composite Rating</th>
        <?php if (isset($_SESSION['username'])) : ?>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($videoGames as $videoGame) : ?>
    <tr>
        <td><?php echo $videoGame->getVideoGameTitle(); ?></td>
        <td><?php echo $videoGame->getTypeOfGame(); ?></td>
        <td><?php echo $videoGame->getPlatform(); ?></td>
        <td><?php echo $videoGame->getVideoGameRating(); ?></td>
        <td><?php echo $videoGame->getMetacriticUserRating(); ?></td>
        <td><?php echo $videoGame->getIgnRating(); ?></td>
        <td><?php echo $videoGame->getGamespotRating(); ?></td>
        <td><?php echo $videoGame->getCompositeRating() ?></td>
        <?php if (isset($_SESSION['username'])) : ?>
        <td>
            <form action="." method="post">
                <input type="hidden" name="action" value="show-update-video-game">
                <input type="hidden" name="ID" value="<?php echo $videoGame->getId(); ?>">
                <input type="submit" class="btn btn-secondary" value="Update" aria-label="Update <?php echo $videoGame->getVideoGameTitle(); ?>">
            </form>
        </td>
        <td>
            <form action="." method="post">
                <input type="hidden" name="action" value="show-delete-video-game">
                <input type="hidden" name="ID" value="<?php echo $videoGame->getId(); ?>">
                <input type="submit" class="btn btn-secondary" value="Delete" aria-label="Delete <?php echo $videoGame->getVideoGameTitle(); ?>">
            </form>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="form-group text-center">
    <form action="." method="post" class="btn-group">
        <input type="hidden" name="action" value="show-add-video-game">
        <input type="submit" class="btn btn-secondary" value="Add Video Game">
    </form>
    <form action="." method="post" class="btn-group">
        <input type="hidden" name="action" value="clear-message">
        <input type="submit" class="btn btn-secondary" value="Clear Message">
    </form>
</div>
<?php include 'footer.php'; ?>

