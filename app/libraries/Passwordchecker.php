<?php
class Passwordchecker {
    //password length
    public $length;

    public function detect_any_uppercase($string) {
        //Comparison operator. Returns true if lowercase changes string
        return strtolower($string) != $string;
    }


    public function detect_any_lowercase($string) {
        //true if uppercase changes string
        return strtoupper($string) != $string;
    }


    public function count_numbers($string) {
        return preg_match_all('/[0-9]/', $string);
    }

    public function count_symbols($string) {
        // You have to decide which symbols count
        // Regex /W is any non-letter, non-number: but this could be too broad
        // Better to list the ones that count
        // To write a regex here, you start with '', then inside that some square brackets [], then inside the square brackets is everything you want to include
        // Escape regex symbols to get their literal values - preg_quote helps facilitate that
        $regex = '/[' . preg_quote('!@£$%^&*-_+=?') . ']/';
        return preg_match_all($regex, $string);
    }


    public function password_strength($password) {
        $strength = 0;
        $possible_points = 12;
        $this->length = strlen($password);


        if($this->detect_any_uppercase($password)) {
            $strength += 1;
        }

        if($this->detect_any_lowercase($password)) {
            $strength += 1;
        }

            // echo $this->count_numbers($password);
            // echo $this->count_symbols($password);

        // this adds points for numbers but limits the total possible to 2
        $strength += min($this->count_numbers($password), 2);

        // same again for symbols
        $strength += min($this->count_symbols($password), 2);


        if($this->length >= 8) {
            $strength += 2;
            $strength += min(($this->length - 8) * 0.5, 4);
        }


        $strength_percent = $strength / (float) $possible_points;
        $rating = floor($strength_percent * 10);
        return $rating;

    }
}