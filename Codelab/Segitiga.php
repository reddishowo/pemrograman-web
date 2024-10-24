<?php
// Function to generate triangle pattern
function printTriangle($rows) {
    echo "1. SEGITIGA SAMA SISI\n";
    for ($i = 1; $i <= $rows; $i++) {
        // Print spaces
        for ($j = 1; $j <= $rows - $i; $j++) {
            echo " ";
        }
        // Print stars
        for ($k = 1; $k <= $i; $k++) {
            echo "* ";
        }
        echo "\n";
    }
    
    echo "\n2. SEGITIGA SAMA SISI TERBALIK\n";
    for ($i = $rows; $i >= 1; $i--) {
        // Print spaces
        for ($j = 1; $j <= $rows - $i; $j++) {
            echo " ";
        }
        // Print stars
        for ($k = 1; $k <= $i; $k++) {
            echo "* ";
        }
        echo "\n";
    }
}

// Call the function with 5 rows
printTriangle(5);
?>