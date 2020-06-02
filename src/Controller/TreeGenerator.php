<?php
require_once 'ShapeGenerator.php';

/**
 * @author agnes
 */
class TreeGenerator extends ShapeGenerator {
    public function generateShape(int $user_input_size): string {        
        // We start with one "x" at the top of the tree
        $number_chars_per_line = 1;
        $rows = [$number_chars_per_line];
        
        $number_of_rows = $user_input_size - 1; // -1 for the first row with "+"
        
        for($i = 1; $i < $number_of_rows; $i++) {
            $number_chars_per_line += 2;
            array_push($rows, $number_chars_per_line);
        }
                
        $tree = $this->drawShape($rows, max($rows));
        return $tree;
    }
    
    protected function drawShape(array $rows, int $max_chars): string {
        $spaces_per_line = $this->deduceSpacesForEachLine($rows, $max_chars);
        $tree .= $this->drawShapeHead(max($rows));
        $tree .= $this->drawShapeBody($rows, $spaces_per_line, $max_chars); 
        return $tree;
    }
    
    private function drawShapeHead(int $max_chars): string {
        $tree .= str_repeat(SPACE_CHAR, ($max_chars - 1) / 2)  . PLUS_CHAR . str_repeat(SPACE_CHAR, ($max_chars - 1) / 2) . "\n";
        return $tree;
    }
    
    protected function drawShapeBody(array $rows, array $spaces_per_line, int $max_chars): string {
        for ($x = 0; $x < count($rows); $x++) {
            $tree .= str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2) . str_repeat(X_CHAR, $rows[$x]) . str_repeat(SPACE_CHAR, $spaces_per_line[$x] / 2) . PHP_EOL;
        }
        
        return $tree;
    }
}