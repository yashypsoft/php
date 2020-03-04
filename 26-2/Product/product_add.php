<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/js/uikit-icons.min.js"></script>
    <!-- Jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>ADD Product</title>
</head>

<body>
    <h1>Add product</h1>
    <div class="uk-container uk-container-small uk-margin-medium-top">
        <form action="../Controller/Products.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="productName">Name</label>
                <input type="text" name="name" id="productName" value="" class="uk-input">
            </div>
            <div>
                <label for="sku">SKU</label>
                <input type="text" name="sku" id="sku" value="" class="uk-input">
            </div>
            <div>

                <label for="urlKey">Url Key</label>
                <input type="text" name="url_key" id="urlKey" value="" class="uk-input" {{disabled}}>

            </div>
            <div>
                <label for="status">Status</label>
                <input type="radio" class="uk-radio" value="ON" name="status" id="status">ON
                <input type="radio" class="uk-radio" value="OFF" name="status" id="status">OFF

            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="uk-textarea"></textarea>
            </div>
            <div>
                <label for="shortDescription">Short Description</label>
                <textarea name="short_description" id="shortDescription" cols="30" rows="10" class="uk-textarea"></textarea>

            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="" class="uk-input">
            </div>
            <div>
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" value="" class="uk-input">
            </div>
            <input type="submit" value="Add Product" class="uk-button uk-margin-small-top 
            uk-button-primary">
        </form>
    </div>

</body>

</html>