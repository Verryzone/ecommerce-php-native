<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title fw-bold h2">Categories</h4>
            <button class="btn btn-primary" onclick="window.location.href='?page=categories&section=new'">+ Add</button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <!-- <th colspan="2">Code</th> -->
                        <th>Code</th>
                        <th>Name</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $args = "WITH RECURSIVE category_hierarchy AS (
                                SELECT id, code, name, parent_id, created_at, name AS path
                                FROM categories
                                WHERE parent_id = 0
                                UNION ALL
                                SELECT c.id, c.code, c.name, c.parent_id, c.created_at, CONCAT(ch.path, ' > ', c.name) AS path
                                FROM categories c
                                INNER JOIN category_hierarchy ch ON c.parent_id = ch.id
                            )
                            SELECT * FROM category_hierarchy ORDER BY path;";
                    $query = mysqli_query($dbconnect, $args);
                    $no = 1;
                    ?>

                    <?php if(mysqli_num_rows($query) > 0) : ?>
                        <?php while($data = mysqli_fetch_array($query)) : ?>
                        <?php 
                        
                        $tr_parent = 'tr_parent';
                        if($data['parent_id'] > 0) {
                            $tr_parent = '';
                        }
                        ?>
                        <tr class="<?= $tr_parent ?>">
                            <th scope="row"><?= $no++ ?></th>
                            <?php if($data['parent_id'] > 0) : ?>
                                <!-- <td></td> -->
                                <td><span style="margin-left: 1rem;"><?= $data['code'] ?></span></td>
                            <?php else : ?>
                                <td><?= $data['code'] ?></td>
                            <?php endif ?>
                            <td><?= $data['name'] ?></td>
                            <td>
                                <button class="btn rounded-pill btn-icon btn-warning" onclick="window.location.href='?page=categories&section=edit&id=<?= $data['id'] ?>'">
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
                        <input type="hidden" id="product_id_todelete" value="">
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
