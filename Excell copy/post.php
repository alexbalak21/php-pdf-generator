<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["input"])) {
    $input = $_POST["input"];

    echo "<h2>Formatted HTML Output</h2>";
    echo '<div style="border:1px solid #ccc; padding:10px; background:#f9f9f9;">';
    echo $input;
    echo '</div><br>';

    echo "<h2>Cleaned & Beautified HTML</h2>";
    $attributes = ["style", "class", "align", "valign", "width", "height", "bgcolor", "cellspacing", "cellpadding", "border", "span"];
    $cleaned = deleteUnwantedAttributes($input, $attributes);
    $formatted = formatHtml($cleaned);
    echo '<pre>' . htmlspecialchars($formatted) . '</pre>';

    echo "<h2>Extracted Table Data (JSON)</h2>";
    $tableData = extractTableData($cleaned);
    echo '<pre>' . json_encode($tableData, JSON_PRETTY_PRINT) . '</pre>';
} else {
    echo "No input received.";
}

// 🔧 Remove unwanted attributes
function deleteUnwantedAttributes($input, $attributes = ["style", "class", "align"])
{
    foreach ($attributes as $attribute) {
        $input = preg_replace('/\s*' . preg_quote($attribute) . '="[^"]*"/i', '', $input);
    }
    return $input;
}

// 🎨 Beautify HTML using DOMDocument
function formatHtml($html)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadHTML($html);
    libxml_clear_errors();
    return $dom->saveHTML();
}

// 📊 Extract table data into array
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
