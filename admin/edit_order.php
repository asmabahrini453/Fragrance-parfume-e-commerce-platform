<?php
include('header_admin.php');

if (isset($_GET['order_id'])) {
    // get the product ID from the query string
    $order_id = $_GET['order_id'];

    // prepare the SQL statement and bind the parameter
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bindParam(1, $order_id, PDO::PARAM_INT);
    $stmt->execute();

    // fetch the product from the result set
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
} else if (isset($_POST['edit_order'])) {
    $order_status = $_POST['order_status'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bindParam(1, $order_status, PDO::PARAM_STR);
    $stmt->bindParam(2, $order_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('location: index.php?order_updated=order has been updated successfully!');
        exit;
    } else {
        header('location: index.php?order_failed=Try again!');
        exit;
    }
} else {
    header('location: index.php');
    exit;
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('side_bar.php'); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>

            <h2>Edit Order</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form action="edit_order.php" id="edit-order-form" method="POST">
                        <?php if ($order) { ?>
                            <p style="color:red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    } ?></p>
                            <div class="form-group my-3">
                                <label>OrderId</label>
                                <p class="my-4"><?php echo $order['order_id']; ?></p>
                            </div>
                            <div class="form-group my-3">
                                <label>OrderPrice</label>
                                <p class="my-4"><?php echo $order['order_cost']; ?></p>
                            </div>

                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">

                            <div class="form-group my-3">
                                <label>Order Status</label>
                                <select name="order_status" class="form-select" required>
                                    <option value="not paid" <?php if ($order['order_status'] == 'not paid') {
                                                                    echo "selected";
                                                                } ?>>Not Paid</option>
                                    <option value="paid" <?php if ($order['order_status'] == 'paid') {
                                                                echo "selected";
                                                            } ?>>Paid</option>
                                    <option value="shipped" <?php if ($order['order_status'] == 'shipped') {
                                                                    echo "selected";
                                                                } ?>>Shipped</option>
                                    <option value="delivered" <?php if ($order['order_status'] == 'delivered') {
                                                                    echo "selected";
                                                                } ?>>Delivered</option>
                                </select>
                            </div>
                            <div class="form-group my-3">
                            <label>OrderDate</label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary"  name="edit_order" value="Edit">
                        </div>
                    <?php } else { ?>
                        <p>No order found.</p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </main>
</div>
<?php include('footer_admin.php'); ?>

