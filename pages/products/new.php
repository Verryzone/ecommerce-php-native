<div class="container-xxl flex-grow-1 container-p-y">
      <div class="card-header">
            <div class="w-100 d-flex justify-content-end">
                  <button class="btn btn-secondary" onclick="window.history.back()"><< Back</button>
            </div>
      </div>
      <div class="row">
            <div class="col-md-6">
                  <div class="card mb-4">
                        <h5 class="card-header fw-bold h3">New Product</h5>
                        <div class="card-body">
                              <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Shoes" />
                              </div>
                              <div>
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" rows="3"></textarea>
                              </div>
                              <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" placeholder="129000" />
                              </div>
                              <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" placeholder="129000" />
                              </div>
                              <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id"
                                          aria-label="Default select example">
                                          <option value="1">One</option>
                                          <option value="2">Two</option>
                                          <option value="3">Three</option>
                                    </select>
                              </div>
                              <div class="mb-3">
                                    <button class="btn btn-primary" onclick="saveProduct()">Save</button>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                        <div class="card-header h-75 d-flex align-items-center">
                              <img class="card-img-top" id="imagePreview" src="assets/images/imgdefault.png" alt="Card image cap" />
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