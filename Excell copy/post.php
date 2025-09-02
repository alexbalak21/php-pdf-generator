<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["input"])) {
    $input = $_POST["input"];

    // Clean unwanted attributes
    $attributes = ["style", "class", "align", "valign", "width", "height", "bgcolor", "cellspacing", "cellpadding", "border", "span"];
    $cleaned = deleteUnwantedAttributes($input, $attributes);

    // Extract table rows
    $rows = extractTableData($cleaned);

    // Convert to column-based associative array
    $data = convertRowsToColumns($rows); // ✅ This is your final $data structure

    // Display JSON for verification
    echo "<h2>Column-Based JSON</h2>";
    echo '<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';

    // ✅ Example usage
    echo "<h2>Accessing PHP \$data</h2>";
    foreach ($data as $header => $values) {
        echo "<strong>$header</strong>: " . implode(", ", $values) . "<br>";
    }
} else {
    echo "No input received.";
}

// 🔧 Remove unwanted attributes
function deleteUnwantedAttributes($input, $attributes = [])
{
    foreach ($attributes as $attribute) {
        $input = preg_replace('/\s*' . preg_quote($attribute) . '="[^"]*"/i', '', $input);
    }
    return $input;
}

// 📊 Extract table rows
function extractTableData($html)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $rows = $dom->getElementsByTagName('tr');
    $data = [];
    foreach ($rows as $row) {
        $cells = $row->getElementsByTagName('td');
        $rowData = [];
        foreach ($cells as $cell) {
            $rowData[] = trim($cell->nodeValue);
        }
        if (!empty($rowData)) {
            $data[] = $rowData;
        }
    }
    return $data;
}

// 🔄 Convert rows to columns
function convertRowsToColumns($rows)
{
    $columns = [];
    $numCols = count($rows[0]);

    for ($i = 0; $i < $numCols; $i++) {
        $header = $rows[0][$i] ?? "Column_$i";
        $columns[$header] = [];

        for ($j = 1; $j < count($rows); $j++) {
            $columns[$header][] = $rows[$j][$i] ?? null;
        }
    }

    return $columns;
}
