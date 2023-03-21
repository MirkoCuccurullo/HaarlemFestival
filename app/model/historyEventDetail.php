<?php

class historyEventDetail {
    public string $title;
    public ?string $image;
    public string $additionalContent;

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
    public function getAdditionalContent(): string
    {
        return $this->additionalContent;
    }

}