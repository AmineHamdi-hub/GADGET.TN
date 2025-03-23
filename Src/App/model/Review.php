<?php

class Review {
    private int $reviewID;
    private int $userID;
    private int $productID;
    private float $rating;  // Rating between 1 and 5
    private string $comment;
    private string $dateCreated;

    public function __construct(int $reviewID, int $userID, int $productID, float $rating, string $comment) {
        $this->reviewID = $reviewID;
        $this->userID = $userID;
        $this->productID = $productID;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->dateCreated = date('Y-m-d H:i:s');  // Automatically set the creation date
    }

    // Getters and setters
    public function getReviewID(): int {
        return $this->reviewID;
    }

    public function getUserID(): int {
        return $this->userID;
    }

    public function getProductID(): int {
        return $this->productID;
    }

    public function getRating(): float {
        return $this->rating;
    }

    public function getComment(): string {
        return $this->comment;
    }

    public function getDateCreated(): string {
        return $this->dateCreated;
    }

    public function setRating(float $rating): void {
        $this->rating = $rating;
    }

    public function setComment(string $comment): void {
        $this->comment = $comment;
    }
}
?>
