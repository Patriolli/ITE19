<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script> 
    <title>Add Products</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addproducts.php">Add products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_order.php">Create Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_contact.php">Create Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_agent.php">Create Agent</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2>Add a New Vehicle</h2>
    <form method="post" action="add_products_process.php" class="border border-primary p-4">
        <div class="mb-4">
            <label for="vin" class="form-label">Vehicle Identification Number (VIN)</label>
            <input type="text" class="form-control" id="vin" name="vin" required>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <select class="form-select" id="brand" name="brand" onchange="updateModels()" required>
                <option value="" selected disabled>Select Brand</option>
                <option value="Chevrolet">Chevrolet</option>
                <option value="Ford">Ford</option>
                <option value="Toyota">Toyota</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="model" class="form-label">Model</label>
            <select class="form-select" id="model" name="model" required>
                <option value="" disabled selected>Select a Brand First</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="options" class="form-label">Options (Color)</label>
            <input type="text" class="form-control" id="options" name="options" required>
        </div>
        <!-- Other input fields... -->
        <input type="submit" class="btn btn-primary" value="Add Vehicle">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    function updateModels() {
        var brandSelect = document.getElementById('brand');
        var modelSelect = document.getElementById('model');
        var brand = brandSelect.value;

        // Clear previous options
        modelSelect.innerHTML = '<option value="" selected disabled>Select Brand First</option>';

        // Populate models based on selected brand
        switch (brand) {
            case 'Chevrolet':
                modelSelect.innerHTML += '<option value="Cruze">Cruze</option>';
                modelSelect.innerHTML += '<option value="Malibu">Malibu</option>';
                modelSelect.innerHTML += '<option value="Equinox">Equinox</option>';
                break;
            case 'Ford':
                modelSelect.innerHTML += '<option value="Fusion">Fusion</option>';
                modelSelect.innerHTML += '<option value="Escape">Escape</option>';
                modelSelect.innerHTML += '<option value="Explorer">Explorer</option>';
                break;
            case 'Toyota':
                modelSelect.innerHTML += '<option value="Camry">Camry</option>';
                modelSelect.innerHTML += '<option value="Corolla">Corolla</option>';
                modelSelect.innerHTML += '<option value="RAV4">RAV4</option>';
                break;
        }
    }
</script>

</body>
</html>
