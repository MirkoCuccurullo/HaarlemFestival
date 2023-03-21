<?php

class historyPageContent {
    public ?string $mainImageHeader;
    public ?string $tourCardHeader;
    public ?string $tourCardParagraph;
    public ?string $tourCardButtonText;

    /**
     * @return string
     */
    public function getMainImageHeader(): string
    {
        return $this->mainImageHeader;
    }

    /**
     * @param string $mainImageHeader
     */
    public function setMainImageHeader(string $mainImageHeader): void
    {
        $this->mainImageHeader = $mainImageHeader;
    }

    /**
     * @return string
     */
    public function getTourCardHeader(): string
    {
        return $this->tourCardHeader;
    }

    /**
     * @param string $tourCardHeader
     */
    public function setTourCardHeader(string $tourCardHeader): void
    {
        $this->tourCardHeader = $tourCardHeader;
    }

    /**
     * @return string
     */
    public function getTourCardParagraph(): string
    {
        return $this->tourCardParagraph;
    }

    /**
     * @param string $tourCardParagraph
     */
    public function setTourCardParagraph(string $tourCardParagraph): void
    {
        $this->tourCardParagraph = $tourCardParagraph;
    }

    /**
     * @return string
     */
    public function getTourCardButtonText(): string
    {
        return $this->tourCardButtonText;
    }

    /**
     * @param string $tourCardButtonText
     */
    public function setTourCardButtonText(string $tourCardButtonText): void
    {
        $this->tourCardButtonText = $tourCardButtonText;
    }

}