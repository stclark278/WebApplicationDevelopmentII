<?php
class VideoGame {
    private $id, $videoGameTitle, $typeOfGame, $platform, $videoGameRating, $metacriticUserRating, $ignRating, $gamespotRating, $compositeRating;

    public function __construct($videoGameTitle, $typeOfGame, $platform, $videoGameRating, $metacriticUserRating, $ignRating, $gamespotRating, $compositeRating) {
        $this->videoGameTitle = $videoGameTitle;
        $this->typeOfGame = $typeOfGame;
        $this->platform = $platform;
        $this->videoGameRating = $videoGameRating;
        $this->metacriticUserRating = $metacriticUserRating;
        $this->ignRating = $ignRating;
        $this->gamespotRating = $gamespotRating;
        $this->compositeRating = $compositeRating;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getVideoGameTitle()
    {
        return $this->videoGameTitle;
    }

    /**
     * @param mixed $videoGameTitle
     */
    public function setVideoGameTitle($videoGameTitle)
    {
        $this->videoGameTitle = $videoGameTitle;
    }

    /**
     * @return mixed
     */
    public function getTypeOfGame()
    {
        return $this->typeOfGame;
    }

    /**
     * @param mixed $typeOfGame
     */
    public function setTypeOfGame($typeOfGame)
    {
        $this->typeOfGame = $typeOfGame;
    }

    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    /**
     * @return mixed
     */
    public function getVideoGameRating()
    {
        return $this->videoGameRating;
    }

    /**
     * @param mixed $videoGameRating
     */
    public function setVideoGameRating($videoGameRating)
    {
        $this->videoGameRating = $videoGameRating;
    }

    /**
     * @return mixed
     */
    public function getMetacriticUserRating()
    {
        return $this->metacriticUserRating;
    }

    /**
     * @param mixed $metacriticUserRating
     */
    public function setMetacriticUserRating($metacriticUserRating)
    {
        $this->metacriticUserRating = $metacriticUserRating;
    }

    /**
     * @return mixed
     */
    public function getIgnRating()
    {
        return $this->ignRating;
    }

    /**
     * @param mixed $ignRating
     */
    public function setIgnRating($ignRating)
    {
        $this->ignRating = $ignRating;
    }

    /**
     * @return mixed
     */
    public function getGamespotRating()
    {
        return $this->gamespotRating;
    }

    /**
     * @param mixed $gamespotRating
     */
    public function setGamespotRating($gamespotRating)
    {
        $this->gamespotRating = $gamespotRating;
    }

    /**
     * @return mixed
     */
    public function getCompositeRating()
    {
        return $this->compositeRating;
    }

    /**
     * @param mixed $compositeRating
     */
    public function setCompositeRating($compositeRating)
    {
        $this->compositeRating = $compositeRating;
    }


}