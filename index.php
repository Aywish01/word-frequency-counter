<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="process.php" method="post">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>

    <?php

    // Validate input
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
</body>
</html>