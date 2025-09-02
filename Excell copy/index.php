<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel to Table</title>
</head>

<body>
    <h1>Input Table</h1>
    <form action="post.php" method="POST">
        <div id="input" contenteditable="true">

        </div>
        <input type="hidden" name="input" id="input-hidden">
        <button type="submit">Submit</button>
    </form>

</body>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    td[contenteditable="true"]:focus {
        outline: 2px solid blue;
    }

    #input {
        border: #ccc 1px solid;
        min-height: 300px;
        min-width: 300px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputDiv = document.getElementById("input");
        const hiddenInput = document.getElementById("input-hidden");

        inputDiv.addEventListener("input", function() {
            hiddenInput.value = inputDiv.innerHTML;
        });
    });
</script>

</html>