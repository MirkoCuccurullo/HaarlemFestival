<?php

class historyPageCard {
    public string $title;
    public ?string $image;
    public string $content;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}