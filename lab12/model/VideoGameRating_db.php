<?php
class VideoGameDB {
    public static function getAllVideoGames() {
        $db = Database::getDB();
        global $error;
        $query = 'SELECT * FROM VideoGameRatings ORDER BY Title';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        foreach ($rows as $row) {
            $videoGame = new VideoGame($row['Title'], $row['Type'], $row['Platform'], $row['ESRB_Rating'], $row['Metacritic_User_Rating'], $row['IGN_Rating'], $row['Game_Spot_Rating'], $row['Composite_Rating']);
            $videoGame->setID($row['ID']);
            $videoGames[] = $videoGame;
        }
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && empty($videoGames)) {
            $sqlError = $statement->errorInfo();
            $error = 'SELECT error &rarr; The Video Games were not retrieved because: ' . $sqlError[2];
            logErrorMessage($error);
        }
        return $videoGames;
    }

    public static function addVideoGame(VideoGame $videoGame) {
        $db = Database::getDB();
        global $error, $successMessage;

        $videoGameTitle = $videoGame->getVideoGameTitle();
        $typeOfGame = $videoGame->getTypeOfGame();
        $platform = $videoGame->getPlatform();
        $videoGameRating = $videoGame->getVideoGameRating();
        $metacriticUserRating = $videoGame->getMetacriticUserRating();
        $ignRating = $videoGame->getIgnRating();
        $gamespotRating = $videoGame->getGamespotRating();
        $compositeRating = $videoGame->getCompositeRating();

        $query = 'INSERT INTO VideoGameRatings
                (Title, Type, Platform, ESRB_Rating, Metacritic_User_Rating, IGN_Rating, Game_Spot_Rating, Composite_Rating)
              VALUES
                (:Title, :Type, :Platform, :ESRB_Rating, :Metacritic_User_Rating, :IGN_Rating, :Game_Spot_Rating, :Composite_Rating)';
        $statement = $db->prepare($query);
        $statement->bindValue(':Title', $videoGameTitle);
        $statement->bindValue(':Type', $typeOfGame);
        $statement->bindValue(':Platform', $platform);
        $statement->bindValue(':ESRB_Rating', $videoGameRating);
        $statement->bindValue(':Metacritic_User_Rating', $metacriticUserRating);
        $statement->bindValue(':IGN_Rating', $ignRating);
        $statement->bindValue(':Game_Spot_Rating', $gamespotRating);
        $statement->bindValue(':Composite_Rating', $compositeRating);
        $success = $statement->execute();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorInfo();
            $error = 'INSERT error &rarr; The video game <strong>' . $videoGameTitle . '</strong> was not added because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The video game <strong>' . $videoGameTitle . '</strong> was successfully added to the database.';
            logSuccessMessage($successMessage);
        }
    }

    public static function getVideoGameInfo($id) {
        $db = Database::getDB();
        global $error;
        $query = 'SELECT * FROM VideoGameRatings WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch();
        $videoGame = new VideoGame($row['Title'], $row['Type'], $row['Platform'], $row['ESRB_Rating'], $row['Metacritic_User_Rating'], $row['IGN_Rating'], $row['Game_Spot_Rating'], $row['Composite_Rating']);
        $videoGame->setID($row['ID']);
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && empty($videoGame)) {
            $sqlError = $statement->errorInfo();
            $error = 'SELECT error &rarr; The Video Game with the ID <strong>' . $id . '</strong> was not retrieved because: ' . $sqlError[2];
            logErrorMessage($error);
        }
        return $videoGame;
    }

    public static function updateVideoGame(VideoGame $videoGame) {
        $db = Database::getDB();
        global $error, $successMessage;

        $id = $videoGame->getId();
        $videoGameTitle = $videoGame->getVideoGameTitle();
        $typeOfGame = $videoGame->getTypeOfGame();
        $platform = $videoGame->getPlatform();
        $videoGameRating = $videoGame->getVideoGameRating();
        $metacriticUserRating = $videoGame->getMetacriticUserRating();
        $ignRating = $videoGame->getIgnRating();
        $gamespotRating = $videoGame->getGamespotRating();
        $compositeRating = $videoGame->getCompositeRating();

        $query = 'UPDATE VideoGameRatings
                SET ID = :ID,
                    Title = :Title,
                    Type = :Type,
                    Platform = :Platform,
                    ESRB_Rating = :ESRB_Rating,
                    Metacritic_User_Rating = :Metacritic_User_Rating,
                    IGN_Rating = :IGN_Rating,
                    Game_Spot_Rating = :Game_Spot_Rating,
                    Composite_Rating = :Composite_Rating
                WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue(':ID', $id, PDO::PARAM_INT);
        $statement->bindValue(':Title', $videoGameTitle);
        $statement->bindValue(':Type', $typeOfGame);
        $statement->bindValue(':Platform', $platform);
        $statement->bindValue(':ESRB_Rating', $videoGameRating);
        $statement->bindValue(':Metacritic_User_Rating', $metacriticUserRating);
        $statement->bindValue(':IGN_Rating', $ignRating);
        $statement->bindValue(':Game_Spot_Rating', $gamespotRating);
        $statement->bindValue(':Composite_Rating', $compositeRating);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorInfo();
            $error = 'UPDATE error &rarr; The Video Game <strong>' . $videoGameTitle . '</strong> was not updated because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The Video Game <strong>' . $videoGameTitle . '</strong> was successfully updated.';
            logSuccessMessage($successMessage);
        }

    }

    public static function deleteVideoGame($id, $videoGameTitle) {
        $db = Database::getDB();
        global $error, $successMessage;
        $query = 'DELETE FROM VideoGameRatings WHERE ID = :ID';
        $statement = $db->prepare($query);
        $statement->bindValue('ID', $id, PDO::PARAM_INT);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($statement->errorCode() !== 0 && $success === false) {
            $sqlError = $statement->errorCode();
            $error = 'DELETE error &rarr; The Video Game <strong>' . $videoGameTitle . '</strong> was not deleted because: ' . $sqlError[2];
            logErrorMessage($error);
        } else {
            $successMessage = 'The Video Game <strong>' . $videoGameTitle . '</strong> was successfully deleted.';
            logSuccessMessage($successMessage);
        }
    }
}