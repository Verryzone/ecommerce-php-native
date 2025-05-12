<?php 
$id = $_GET['id'];

$args = "SELECT * FROM products WHERE id = $id";
$query = mysqli_query($dbconnect, $args);
$data = mysqli_fetch_array($query);
?>
<div class="container-xxl flex-grow-1 container-p-y">
      <div class="card-header">
            <div class="w-100 d-flex justify-content-end">
                  <button class="btn btn-secondary" onclick="window.history.back()"><< Back</button>
            </div>
      </div>
      <div class="row">
            <div class="col-md-6">
                  <div class="card mb-4">
                        <h5 class="card-header fw-bold h3">Edit Product</h5>
                        <div class="card-body">
                              <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Shoes" value="<?= $data['name'] ?>"/>
                              </div>
                              <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3"><?= $data['description'] ?></textarea>
                              </div>
                              <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" placeholder="129000" value="<?= $data['price'] ?>"/>
                              </div>
                              <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" placeholder="129000" value="<?= $data['stock'] ?>"/>
                              </div>
                              <div class="mb-3">
                                    <label for="parent_id" class="form-label">Category's</label>
                                    <select class="form-select" id="parent_id" aria-label="Default select example">
                                          <option <?php autoselect($data['category_id'], '0') ?> value="0">Set As Parent</option>
                                          <?php 
                                          $args = "SELECT * FROM categories WHERE parent_id = 0";
                                          $query = mysqli_query($dbconnect, $args);
                                          ?>
                                          <?php while($category = mysqli_fetch_array($query)) : ?>
                                                <option <?php autoselect($data['category_id'], $category['id']) ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                          <?php endwhile ?>
                                    </select>
                              </div>
                              <div class="mb-3">
                                    <input type="hidden" id="id" value="<?= $data['id'] ?>" />
                                    <button class="btn btn-primary" onclick="saveProduct('edit')">Save</button>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                        <div class="card-header h-75 d-flex align-items-center">
                              <?php if(!empty($data['image_url'])) : ?>
                                    <img class="card-img-top" id="imagePreview" src="uploads/images/<?= $data['image_url'] ?>" alt="Card image cap" />
                              <?php else : ?>
                                    <img class="card-img-top" id="imagePreview" src="assets/images/imgdefault.png" alt="Card image cap" />
                              <?php endif ?>
                        </div>
                        <div class="card-body">
                              <h5 class="card-title">Product Image</h5>
                              <div class="mb-3">
                                    <input class="form-control" type="file" id="product_image" />
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>