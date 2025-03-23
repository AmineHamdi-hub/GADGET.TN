<?php
class Category {
    const MEN = 'homme';
    const WOMEN = 'femme';
    const ELECTRONICS = 'electronics';
    const SPORT = 'sport';
    const HOME = 'pour-maison';
    const BEAUTY = 'cosmetiques';
    // You can also create a method to get all categories
    public static function getAllCategories() {
        return [
            self::MEN,
            self::WOMEN,
            self::ELECTRONICS,
            self::SPORT,
            self::HOME,
            self::BEAUTY
        ];
    }
}
?>
