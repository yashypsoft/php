<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
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
    <table border="1">
        <tr>
            <th>
                <form action="<?php echo $this->getUrl('delete'); ?>" method="post">
                    <input type="submit" value="Delete">
                
            </th>
            <th>Name</th>
            <th>Sku</th>
            <th>url Key</th>
            <th>status</th>
            <th>description</th>
            <th>Short Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Media Gallery</th>
            <th>Action</th>
        </tr>
        <?php
        $products = $this->getProducts();
        if (!$products) :
        ?>
            <tr>
                <td>No Record Found!</td>
            </tr>
            <?php
        else :
            foreach ($products as $row) :
            ?>
                <tr>
                    <td><input type="checkbox" name="deleteId[]" value="<?php echo $row->id ?>"></td>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $row->sku ?></td>
                    <td><?php echo $row->url_key ?></td>
                    <td><?php echo $row->status ?></td>
                    <td><?php echo $row->description ?></td>
                    <td><?php echo $row->short_description ?></td>
                    <td><?php echo $row->price ?></td>
                    <td><?php echo $row->stock ?></td>
                    <td><a href="<?php echo $this->getUrl('mediaGallery', null, ['id' => $row->id]); ?>">
                        Media</a></td>
                    <td><a href="<?php echo $this->getUrl('edit', null, ['id' => $row->id]); ?>">
                        Edit</a></td>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
        </tr>

    </table>
    </form>

</body>

</html>