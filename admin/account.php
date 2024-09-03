<?php
include('header_admin.php');

$adminData = []; // Initialize the variable

if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_id = :admin_id");
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();

    $adminData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debugging statements
    echo "<pre>";
    print_r($adminData);
    echo "</pre>";
}
?>

<div class="container-fluid">
    <div class="row" style="min-height: 1000px;">
        <?php include('side_bar.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Admin Account</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>

            <div class="container">
                <?php if ($adminData) { ?>
                    <p>Id: <?php echo $adminData['admin_id']; ?></p>
                    <p>Name: <?php echo $adminData['admin_name']; ?></p>
                    <p>Email: <?php echo $adminData['admin_email']; ?></p>
                <?php } else { ?>
                    <p>No admin data found.</p>
                <?php } ?>
            </div>
        </main>
    </div>
</div>

<?php
include('footer_admin.php');
?>
