<?php $product = $this->getProduct(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Gallery</title>
</head>
<style>
    table {
        width: 100%;
    }
    th,
    td {
        padding: 4px;
    }
</style>

<body>

    <form action="<?php echo $this->getUrl('saveImage', null, ['id' => $product->id]) ?>" method="POST" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>Browse : </td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Upload"></td>
            </tr>
        </table>
    </form>
    <table border="1">
        <tr>
            <td>
                <form action="<?php echo $this->getUrl(''); ?>" method="post">
                    <input type="submit" value="Update">

            </td>
        </tr>
        <tr>
            <th>Image</th>
            <th>Base</th>
            <th>Thumbnail</th>
            <th>Small</th>
            <th>Exploaded From media</th>
        </tr>
        <?php
        $productImage = $this->getProductImage();
        if (!$productImage) :
        ?>
            <tr>
                <td>No Product Found!</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($productImage as $row) : ?>
            <tr>
                <td><?php echo $row->image_name; ?></td>
                <td><input type="radio" name="base[]"></td>
                <td><input type="radio" name="thumbnail[]"></td>
                <td><input type="radio" name="small[]"></td>
                <td><input type="checkbox" name="expload[]"></td>
            </tr>
        <?php endforeach; ?>

    </table>
    </form>

</body>

</html>