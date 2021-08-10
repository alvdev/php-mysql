<?php 

include_once 'partials/header.php';

$conn = new PDO('mysql:host=localhost; dbname=php-music-crud; charset=utf8mb4', 'root', 'pass');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = $conn->prepare("SELECT * FROM products ORDER BY created_date DESC");

$sql->execute();

$products = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<main>
    
    <h1>Music products CRUD</h1>
    
    <p>
        <a href="create.php" class="btn bg-green">Create new product</a>
    </p>
    
    <table>
        <thead>
            <tr>
                <td class="center">#</td>
                <td class="center">Image</td>
                <td>Title</td>
                <td>Description</td>
                <td>Price</td>
                <td>Date</td>
                <td class="actions">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td class="center"><?= $product['id'] ?></td>
                    <td class="center">
                        <img src="<?= $product['image'] ?>" height="100">
                    </td>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['created_date'] ?></td>
                    <td class="actions">
                        
                        <a href="edit.php" class="btn bg-blue">Edit</a>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn bg-red">Delete</button>
                        </form>
                        
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php include_once 'partials/footer.php' ?>