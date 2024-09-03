<?php
include('header_admin.php'); ?>


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

            <h2>Create  Order</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form action="create_product.php" id="create-form" enctype="multipart/form-data"  method="POST">
                        
                            <p style="color:red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    } ?></p>
                            <div class="form-group mt-2">
                                <label>Product name</label>
                                <input type="text" id="product_name" value="product_name" name="product_name"/>
                            </div>


                            <div class="form-group mt-2">
                                <label>Product Description</label>
                                <input type="text" id="product_description" value="product_description" name="product_description"/>
                            </div>

                            <div class="form-group mt-2">
                                <label>Product Price</label>
                                <input type="text" id="product_price" value="product_price" name="product_price"/>
                            </div>


                            <div class="form-group mt-2">
                                <label>Product Category</label>
                                <select name="product_category" class="form-select" required>
                                    <option value="perfume" >Perfume</option>
                                    
                                    
                                    <option value="best_sellers" >Best Sellers</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label>Product Image</label>
                                <input type="file" id="product_image" value="product_image" name="product_image"/>
                            </div>

                            

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary"  name="create_product" value="Create">
                        </div>
                        
                </form>
            </div>
        </div>
    </main>
</div>
<?php include('footer_admin.php'); ?>
