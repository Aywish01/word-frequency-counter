<?php

/**
 * Calculate the total price of items in a shopping cart.
 *
 * @param array<array{name: string, price: float}> $items An array of items, each with a `name` and `price` property.
 * @return float The total price of the items.
 */
function calculateTotalPrice(array $items): float
{
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

/**
 * Modify a string by removing spaces and converting it to lowercase.
 *
 * @param string $string The string to modify.
 * @return string The modified string.
 */
function modifyString(string $string): string
{
    // Remove spaces and convert to lowercase
    $string = str_replace(' ', '', $string);
    $string = strtolower($string);
    return $string;
}

/**
 * Check if a number is even or odd.
 *
 * @param int $number The number to check.
 * @return bool True if the number is even, false otherwise.
 */
function checkIfEvenOrOdd(int $number): bool
{
    if ($number % 2 == 0) {
        return true;
    } else {
        return false;
    }
}

// Usage examples:

$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$totalPrice = calculateTotalPrice($items);
echo "Total price: $" . $totalPrice;

$string = "This is a poorly written program with little
structure and readability.";

$modifiedString = modifyString($string);
echo "\nModified string: " . $modifiedString;

$number = 42;

if (checkIfEvenOrOdd($number)) {
    echo "\nThe number " . $number . " is even.";
} else {
    echo "\nThe number " . $number . " is odd.";
}
