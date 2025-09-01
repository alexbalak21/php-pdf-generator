<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>wrapper</title>
</head>

<body>
    <div class="d-flex gap-0">
        <input type="text">
        <input type="text">
        <input type="text">
        <input type="text">
        <input type="text">
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const td = document.querySelector(`td[contenteditable="true"]`);
    td.textContent = "changed";
</script>




</html>