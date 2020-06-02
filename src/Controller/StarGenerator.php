<?php
require_once 'ShapeGenerator.php';

/**
 * @author agnes
 */
class StarGenerator extends ShapeGenerator {
    public function generateShape(int $user_input_size): string {
         // We start with a "+" at the top of the star.
        $number_chars_per_line = 1;
        $rows = [$number_chars_per_line]; 
        
        $number_of_rows = $user_input_size - 2; // -2 for the first and last rows with "+"
        $middle_of_rows = floor($number_of_rows / 2); //find the index representing the middle of the elemtents array.
        
        // Large stars are built differently
        if ($user_input_size === ShapeGenerator::LARGE_SIZE_ROWS) {
            $rows = $this->generateLargeStarRows($number_of_rows, $middle_of_rows, $number_chars_per_line, $rows);
        } else {
            $rows = $this->generateBasicStarRows($number_of_rows, $middle_of_rows, $number_chars_per_line, $rows);
        }

        $max_chars = max($rows) + 2;
        $star = $this->drawShape($rows, $max_chars);
       
        return $star;
    }
    
    protected function drawShape(array $rows, int $max_chars): string {
        $spaces_per_line = $this->deduceSpacesForEachLine($rows, $max_chars);
        
        $head_and_foot_char = $this->drawShapeHeadAndFoot($max_chars);
        $star .= $head_and_foot_char;
        
        // body of the star.
        $star .= $this->drawShapeBody($rows, $spaces_per_line, $max_chars);
       
        // "+" at the bottom of the star.
        $star .= $head_and_foot_char;
        
        return $star;
    }
    
    private function drawShapeHeadAndFoot($max_chars): string {
        return str_repeat(SPACE_CHAR, ($max_chars - 1) / 2)  . PLUS_CHAR . str_repeat(SPACE_CHAR, ($max_chars - 1) / 2) . "\n";
    }
    
    protected function drawShapeBody(array $rows, array $spaces_per_line, int $max_chars): string {
        for ($x = 0; $x < count($rows); $x++) {
            if ($rows[$x] + 2 === $max_chars) {
                $star .=  PLUS_CHAR
                        . str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2 - 1)
                        . str_repeat(X_CHAR, $rows[$x])
                        . str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2 - 1)
                        . PLUS_CHAR
                        . "\n";
            } else {
                $star .=  str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2)
                        . str_repeat(X_CHAR, $rows[$x])
                        . str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2)
                        . "\n";
            }
        }
        return $star;
    }
    
    private function generateBasicStarRows(int $number_of_rows, int $middle_of_rows, int $number_chars_per_line, array $rows): array {
        // We start at index 1 since first row is reserved for "+".
        for($i = 1; $i < $number_of_rows; $i++) {
            $i <= $middle_of_rows ? $number_chars_per_line += 4 : $number_chars_per_line -= 4;
            array_push($rows, $number_chars_per_line);
        }
        
        return $rows;
    }
    
    private function generateLargeStarRows(int $number_of_rows, int $middle_of_rows, int $number_chars_per_line, array $rows): array {
        // We start at index 1 since first row is reserved for "+".
        for($i = 1; $i < $number_of_rows; $i++) {
            if ($i === 1 || $i === $number_of_rows - 1) {
                $i === 1 ? $number_chars_per_line += 2 : $number_chars_per_line -= 2;
            } else {
                $i <= $middle_of_rows ? $number_chars_per_line += 4 : $number_chars_per_line -= 4;
            }

            array_push($rows, $number_chars_per_line);
        }
            
        return $rows;    
    }
}