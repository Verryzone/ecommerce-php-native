<?php 
$id = $_GET['id'];

$args = "SELECT * FROM categories WHERE id = $id";
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
                        <h5 class="card-header fw-bold h3">New Category</h5>
                        <div class="card-body">
                              <div class="mb-3">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="code" disabled placeholder="Shoes" value="<?= $data['code'] ?>" />
                              </div>
                              <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Furnitures" value="<?= $data['name'] ?>" />
                              </div>
                              <div class="mb-3">
                                    <label for="parent_id" class="form-label">Parent's</label>
                                    <select class="form-select" id="parent_id" aria-label="Default select example">
                                          <option <?php autoselect($data['parent_id'], '0') ?> value="0">Set As Parent</option>
                                          <?php 
                                          $args = "SELECT * FROM categories WHERE parent_id = 0";
                                          $query = mysqli_query($dbconnect, $args);
                                          ?>
                                          <?php while($category = mysqli_fetch_array($query)) : ?>
                                                <option <?php autoselect($data['parent_id'], $category['id']) ?> value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                          <?php endwhile ?>
                                    </select>
                              </div>
                              <div class="mb-3">
                                    <input type="hidden" id="id" value="<?= $data['id'] ?>" />
                                    <button class="btn btn-primary" onclick="saveCategory('edit')">Save</button>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>