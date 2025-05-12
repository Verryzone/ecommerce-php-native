<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title fw-bold h2">Products</h4>
            <button class="btn btn-primary" onclick="window.location.href='?page=products&section=new'">+ Add</button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $args = "SELECT * FROM products";
                    $query = mysqli_query($dbconnect, $args);
                    $no = 1;
                    ?>

                    <?php if(mysqli_num_rows($query) > 0) : ?>
                        <?php while($data = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td>
                                <?php if (!empty($data['image_url'])) : ?>
                                        <img src="uploads/thumbnails/thumb_<?= $data['image_url'] ?>" alt="Product Image" class="product-image" style="width: 50px; cursor: pointer;" data-image="uploads/images/<?= $data['image_url'] ?>">
                                <?php else : ?>
                                        <img src="assets/images/thumb_imgdefault.png" alt="Default image" class="product-image" style="width: 50px; cursor: pointer;" data-image="assets/images/imgdefault.png">
                                <?php endif; ?>
                            </td>
                            <td><?= $data['name'] ?></td>
                            <td><?= $data['description'] ?></td>
                            <td><?= categoryName($data['category_id']) ?></td>
                            <td><?= rupiah($data['price']) ?></td>
                            <td><?= $data['stock'] ?></td>
                            <td>
                                <button class="btn rounded-pill btn-icon btn-warning" onclick="window.location.href='?page=products&section=edit&id=<?= $data['id'] ?>'">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="btn rounded-pill btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter" onclick="showPopDelete(<?= $data['id'] ?>)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endwhile ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Popup for Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="img-fluid" alt="Product Image">
            </div>
        </div>
    </div>
</div>

<!-- modal delete -->
<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Warning!</h5>
                    </div>
                    <div class="modal-body" >
                        <p>Are yout sure to delete this data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <input type="hidden" id="id_todelete" value="">
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
