<?php include 'header.php'; ?>
<h1 class="text-center">Add Video Game</h1>
<form action="." method="post" class="col-lg-6 mx-auto">
    <hr>
    <div class="form-group">
        <label for="video-game-title">Video Game Title</label>
        <input type="text" class="form-control<?php echo (!empty($videoGameTitleError)) ? ' is-invalid' : ''; ?>" name="video-game-title" id="video-game-title" placeholder="Video Game Title"
               value="<?php if (!is_null($videoGameTitle)) echo $videoGameTitle; ?>" autofocus>
        <?php if (!empty($videoGameTitleError)) echo $videoGameTitleError; ?>
    </div>
    <div class="form-group">
        <label for="type-of-game">Type of Game</label>
        <input type="text" class="form-control<?php echo (!empty($typeOfGameError)) ? ' is-invalid' : ''; ?>" name="type-of-game" id="type-of-game" placeholder="Type of Game"
               value="<?php if (!is_null($typeOfGame)) echo $typeOfGame; ?>">
        <?php if (!empty($typeOfGameError)) echo $typeOfGameError; ?>
    </div>
    <div class="form-group">
        <label for="platform">Platform</label>
        <input type="text" class="form-control<?php echo (!empty($platformError)) ? ' is-invalid' : ''; ?>" name="platform" id="platform" placeholder="Platform"
               value="<?php if (!is_null($platform)) echo $platform; ?>">
        <?php if (!empty($platformError)) echo $platformError; ?>
    </div>
    <div class="form-group">
        <label for="video-game-rating">ESRB Rating</label>
        <select class="custom-select<?php echo (!empty($videoGameRatingError)) ? ' is-invalid' : ''; ?>" name="video-game-rating" id="video-game-rating">
            <option value="choose">Specify Rating</option>
            <option value="E"<?php if ($videoGameRating === 'E') echo ' selected'; ?>>E</option>
            <option value="E10+"<?php if ($videoGameRating === 'E10+') echo ' selected'; ?>>E10+</option>
            <option value="T"<?php if ($videoGameRating === 'T') echo ' selected'; ?>>T</option>
            <option value="M"<?php if ($videoGameRating === 'M') echo ' selected'; ?>>M</option>
            <option value="AO"<?php if ($videoGameRating === 'AO') echo ' selected'; ?>>AO</option>
            <option value="RP"<?php if ($videoGameRating === 'RP') echo ' selected'; ?>>RP</option>
        </select>
        <?php if (!empty($videoGameRatingError)) echo $videoGameRatingError; ?>
    </div>
    <div class="form-group">
        <label for="metacritic-user-rating">Metacritic User Rating</label>
        <input type="text" class="form-control<?php echo (!empty($metacriticUserRatingError)) ? ' is-invalid' : ''; ?>" name="metacritic-user-rating" id="metacritic-user-rating" placeholder="Metacritic User Rating"
               value="<?php if (!is_null($metacriticUserRating)) echo $metacriticUserRating; ?>">
        <?php if (!empty($metacriticUserRatingError)) echo $metacriticUserRatingError; ?>
    </div>
    <div class="form-group">
        <label for="ign-rating">IGN Rating</label>
        <input type="text" class="form-control<?php echo (!empty($ignRatingError)) ? ' is-invalid' : ''; ?>" name="ign-rating" id="ign-rating" placeholder="IGN Rating"
               value="<?php if (!is_null($ignRating)) echo $ignRating; ?>">
        <?php if (!empty($ignRatingError)) echo $ignRatingError; ?>
    </div>
    <div class="form-group">
        <label for="gamespot-rating">Game Spot Rating</label>
        <input type="text" class="form-control<?php echo (!empty($gamespotRatingError)) ? ' is-invalid' : ''; ?>" name="gamespot-rating" id="gamespot-rating" placeholder="Game Spot Rating"
               value="<?php if (!is_null($gamespotRating)) echo $gamespotRating; ?>">
        <?php if (!empty($gamespotRatingError)) echo $gamespotRatingError; ?>
    </div>
    <div class="form-group">
        <label for="composite-rating">Composite Rating</label>
        <input type="text" class="form-control<?php echo (!empty($compositeRatingError)) ? ' is-invalid' : ''; ?>" name="composite-rating" id="composite-rating" placeholder="Composite Rating"
               value="<?php if (!is_null($compositeRating)) echo $compositeRating; ?>">
        <?php if (!empty($compositeRatingError)) echo $compositeRatingError; ?>
    </div>
    <div class="form-group text-center">
        <input type="hidden" name="action" value="add-video-game">
        <input type="submit" class="btn btn-secondary" value="Add Video Game">
        <a href="." class="btn btn-secondary">Cancel</a>
    </div>
</form>
<?php include 'footer.php'; ?>
