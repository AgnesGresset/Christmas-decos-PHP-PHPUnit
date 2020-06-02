<?php
require_once 'src/constants.php';
require_once 'src/Model/UserData.php';
require_once 'ShapeGenerator.php';
require_once 'TreeGenerator.php';
require_once 'StarGenerator.php';

/**
 * @author agnes
 */
class ShapeFactory {
    public $errors = [];
    private $fake_user_data = [];
    
    public function __construct(array $fake_user_data) {
        $this->fake_user_data = $fake_user_data;
    }
    
    public function createShapes(): array {
        $size_generator_mapping = $this->getSizeGeneratorMapping();
        $generated_shapes = [];
        
        foreach($this->fake_user_data as $user => $data) {
            foreach($data as $index => $shapes_sizes_mapping) {
                $shape = array_keys($shapes_sizes_mapping)[0];
                $size = array_values($shapes_sizes_mapping)[0];

                // If the user hasn't chosen any size, or if their input is incorrect, we pick a random size.
                if (array_search($size, $size_generator_mapping)) {
                    $converted_size = array_search($size, $size_generator_mapping);
                } else {
                    $converted_size = array_rand($size_generator_mapping, 1);
                    $wrong_item = $index + 1;
                    $this->errors[] = $this->printSizeErrorMessage($size, $wrong_item);
                }
                
                $selected_shapes = $this->getSelectedShapes($shape);

                if (!$selected_shapes) {
                    $this->errors[] = $this->printShapeErrorMessage($shape);
                } else {
                    $generator = array_values($selected_shapes)[0];
                    $generated_shapes[] = $generator->generateShape($converted_size);
                }
            }
        }
        return $generated_shapes;
    }
    
    private function getSelectedShapes(string $shape): array {
        return array_filter($this->getShapeGeneratorMapping(), function($shape_key) use ($shape) {
            return $shape_key === $shape;
        }, ARRAY_FILTER_USE_KEY);
    }
    
    private function printSizeErrorMessage(string $size, int $wrong_item): string {
        return "\nThe size '$size' (item $wrong_item)"
            . " does not correspond to any possible sizes, so here you are,"
            . " we picked a random size for you!"
            . " Possible sizes: 's', 'm', 'l'.";
    }
    
    private function printShapeErrorMessage(string $shape): string {
        return "\nThe shape '$shape' does not correspond to any possible shapes."
            . " Please choose one of following shapes: 'tree', 'star'.";
    }
    
    private function getShapeGeneratorMapping(): array {
        return [
            ShapeGenerator::TREE_SHAPE => new TreeGenerator(),
            ShapeGenerator::STAR_SHAPE => new StarGenerator()
        ];
    }
    
    private function getSizeGeneratorMapping(): array {
        return [
            ShapeGenerator::SMALL_SIZE_ROWS => ShapeGenerator::SMALL_SIZE,
            ShapeGenerator::MEDIUM_SIZE_ROWS => ShapeGenerator::MEDIUM_SIZE,
            ShapeGenerator::LARGE_SIZE_ROWS => ShapeGenerator::LARGE_SIZE
        ];
    }
}