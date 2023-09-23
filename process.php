<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Frequency Analyzer</title>
    <link rel="stylesheet" type="text/css" href="styles2.css">

</head>
<body>
    <div class="container">
        <h1>Word Frequency Analyzer</h1>

        

        <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $text = $_POST["text"];
        $sort = $_POST["sort"];
        $limit = (int)$_POST["limit"];

        // Check if the input text is empty
        if (empty($text)) {
            echo "<p>Please enter text.</p>";
            exit();
        }

        // Check if the input limit is valid
        if ($limit < 1) {
            echo "<p>The limit must be at least 1.</p>";
            exit();
        }

        // Sanitize the input text
        $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

        // Process the input text
        $wordCounts = calculateWordFrequencies($text, $sort, $limit);

        // Display the results
        if (!empty($wordCounts)) {
            echo "<h2>Word Frequencies</h2>";
            echo "<ul>";
            foreach ($wordCounts as $word => $frequency) {
                echo "<li>$word: $frequency</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No words found.</p>";
        }
    }

    // Function to calculate word frequencies
    function calculateWordFrequencies($text, $sort, $limit) {
        // Define common stop words to filter out
        $stopWords = ["the", "and", "in", "of", "to", "with"];

        // Tokenize the input text into words
        $words = preg_split('/[\s.,:;]+/', strtolower($text));

        // Count word frequencies and filter out stop words
        $wordCounts = array_diff_assoc(array_count_values($words), array_flip($stopWords));

        // Sort based on the user's choice (ascending or descending order)
        if ($sort == "asc") {
            asort($wordCounts);
        } else {
            arsort($wordCounts);
        }

        // Limit the number of displayed words
        if ($limit > 0) {
            $wordCounts = array_slice($wordCounts, 0, $limit);
        }

        return $wordCounts;
    }

    ?>

    </div>
</body>
</html>