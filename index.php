<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <main class="container mt-4">
        <form>
            <div class="mb-3">
                <label for="supplier" class="form-label">Fournisseur/Fabricant</label>
                <input type="text" name="supplier" class="form-control" id="supplier" value="NORDVIK">
            </div>
            <div class="mb-3">
                <label for="product" class="form-label">Nom du produit</label>
                <input type="text" name="product" class="form-control" id="product" value="Dos de cabillaud">
            </div>
            <div class="mb-3">
                <label for="packaging" class="form-label">Conditionnement</label>
                <input type="text" name="packaging" class="form-control" id="packaging" value="Vrac">
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Espèce</label>
                <input type="text" name="species" class="form-control" id="species" value="Gadus morhua">
            </div>
            <div class="mb-3">
                <label for="approval" class="form-label">Agrément</label>
                <input type="text" name="approval" class="form-control" id="approval" value="IS A676 EFTA">
            </div>
            <div class="mb-3">
                <label for="origin" class="form-label">Origine</label>
                <input type="text" name="origin" class="form-control" id="origin" value="Iceland">
            </div>
            <div class="mb-3">
                <label for="lot" class="form-label">Lot</label>
                <input type="text" name="lot" class="form-control" id="lot" value="5-227">
            </div>
            <div class="mb-3">
                <label for="packDate" class="form-label">Date d'emballage</label>
                <input type="text" name="packDate" class="form-control" id="packDate" value="Non indiqué">
            </div>
            <div class="mb-3">
                <label for="fishingType" class="form-label">Type de pêche</label>
                <input type="text" name="fishingType" class="form-control" id="fishingType" value="Chalut/lignes">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


</html>