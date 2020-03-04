<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        table {

            width: 100%;
        }

        th,
        td {
            padding: 4px;
        }
    </style>
</head>

<body>
    <?php
    $product = $this->getProduct();
    ?>
    <form action="<?php echo $this->getUrl('save', null, ['id' => $product->id]) ?>" method="post">
        <table border="1">
            <tr>
                <th>Name</th>
                <td><input type="text" name="name" value="<?php echo $product->name; ?>"></td>
            </tr>
            <tr>
                <th>SKU</th>
                <td><input type="text" name="sku" value="<?php echo $product->sku; ?>"></td>
            </tr>
            <tr>
                <th>URL Key</th>
                <td><input type="text" name="url_key" value="<?php echo $product->url_key; ?>"></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <select name="status">
                        <?php foreach ($status as $lable => $value) : ?>
                            <option value="<?php echo $value; ?>"><?php echo $lable; ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea name="description" cols="19" 
                    rows="10"><?php echo $product->name; ?></textarea>
                </td>
            </tr>
            <tr>
                <th>Short Description</th>
                <td><input type="text" name="short_description" value="<?php echo $product->short_description; ?>"></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><input type="number" name="price" value="<?php echo $product->price; ?>"></td>
            </tr>
            <tr>
                <th>Stock</th>
                <td><input type="number" name="stock" value="<?php echo $product->stock; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Add"></td>
            </tr>
        </table>
    </form>
</body>

</html>