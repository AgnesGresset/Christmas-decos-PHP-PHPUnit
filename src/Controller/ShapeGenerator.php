<?php
/**
 * @author agnes
 */
abstract class ShapeGenerator {
    public const SMALL_SIZE = "s";
    public const MEDIUM_SIZE = "m";
    public const LARGE_SIZE = "l";
    
    public const SMALL_SIZE_ROWS = 5;
    public const MEDIUM_SIZE_ROWS = 7;
    public const LARGE_SIZE_ROWS = 11;
    
    public const TREE_SHAPE = "tree";
    public const STAR_SHAPE = "star";
    
    abstract protected function generateShape(int $user_input_size): string;
    
    abstract protected function drawShape(array $rows, int $max_chars): string;

    abstract protected function drawShapeBody(array $rows, array $spaces_per_line, int $max_chars): string;

    protected function deduceSpacesForEachLine(array $rows, int $max_chars): array {
        $spaces_per_line = array_map(function($chars_per_line) use ($max_chars) {
            return $max_chars - $chars_per_line;
        }, $rows);

        if (count($rows) !== count($spaces_per_line)) {
            throw new \Exception("Error in calculation of rows.");
        };
        
        return $spaces_per_line;
    }
}