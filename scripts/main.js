$(document).ready(function () {
      // showNotification(1, 'System error!!');

      $('.product-image').on('click', function() {
            console.log('Image clicked');
        // Ambil URL gambar dari atribut data-image
        var imageUrl = $(this).data('image');
        // Set src untuk gambar di modal
        $('#modalImage').attr('src', imageUrl);
        // Tampilkan modal
        $('#imageModal').modal('show');
    });
});

$('#product_image').on('change', function(event) {
    const file = event.target.files[0]; 
    const $preview = $('#imagePreview'); 

    if (file) {
        if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
            alert('Please select a valid image (JPEG, PNG, or GIF)');
            $(this).val(''); 
            $preview.attr('src', 'themes/assets/img/elements/2.jpg');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            $preview.attr('src', e.target.result);
        };
        reader.readAsDataURL(file); 
        $preview.attr('src', 'themes/assets/img/elements/2.jpg');
    }
});

function authLogin(e) {
      e.preventDefault();
      var email = $('#email').val();
      var password = $('#password').val();

      if(email == '') {
            showNotification(0, 'username or email is required');
            return;
      }
      if(password == '') {
            showNotification(0, 'Password is required');
            return;
      }

      var formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);
      formData.append('auth_login_serial', 'user_token');

      $.ajax({
            url: '../engine/auth.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                  console.log(response);
                  var data = JSON.parse(response);

                  showNotification(data.status, data.message);
                  if(data.status == 1) {
                        setTimeout(function() {
                              window.location.reload();
                        }, 2000);
                  }
            },
            error: function(xhr, status, error) {
                  console.error('Error:', error);
            }
      });
}

function authLogout() {
      var formData = new FormData();
      formData.append('auth_logout_serial', 'user_token');

      $.ajax({
            url: 'engine/auth.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                  console.log(response);
                  var data = JSON.parse(response);

                  showNotification(data.status, data.message);
                  if(data.status == 1) {
                        setTimeout(function() {
                              window.location.reload();
                        }, 2000);
                  }
            },
            error: function(xhr, status, error) {
                  console.error('Error:', error);
            }
      });
}

function saveProduct(request_ = 'new') {
      var id = 0;
      if(request_ == 'edit') {
            id = $('#id').val();
      }
      var name = $('#name').val();
      var description = $('#description').val();
      var price = $('#price').val();
      var stock = $('#stock').val();
      var category_id = $('#category_id').val();
      var product_image = $('#product_image')[0].files[0];

      if(name == '') {
            showNotification(0, 'Product name is required');
            return;
      }
      if(description == '') {
            showNotification(0, 'Product description is required');
            return;
      }
      if(price == '') {
            showNotification(0, 'Product price is required');
            return;
      }
      if(stock == '') {
            showNotification(0, 'Product stock is required');
            return;
      }
      if(category_id == '') {
            showNotification(0, 'Product category is required');
            return;
      }
      if(isNaN(price)) {
            showNotification(0, 'Product price must be a number');
            return;
      }
      if(isNaN(stock)) {
            showNotification(0, 'Product stock must be a number');
            return;
      }
      if(price < 0) {
            showNotification(0, 'Product price must be greater than 0');
            return;
      }
      if(stock < 0) {
            showNotification(0, 'Product stock must be greater than 0');
            return;
      }

      var formData = new FormData();
      formData.append('request_', request_);
      formData.append('id', id);
      formData.append('name', name);
      formData.append('description', description);
      formData.append('price', price);
      formData.append('stock', stock);
      formData.append('category_id', category_id);
      formData.append('product_image', product_image); // File gambar
      formData.append('save_product_serial', 'user_token');

      $.ajax({
            url: 'engine/ajax.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                  console.log(response);
                  var data = JSON.parse(response);

                  showNotification(data.status, data.message);
                  if(data.status == 1) {
                        setTimeout(function() {
                              window.location.href = '?page=products';
                        }, 2000);
                  }
            },
            error: function(xhr, status, error) {
                  console.error('Error:', error);
            }
      });

}

function showNotification(success = 1, message) {

      if(success == 1) {
            title = "Success";
      }else if(success == 0) {
            title = "Error";
      } else {
            title = "System error!!";
      }
      
      if(success == 1) {
            $("#notif_icon").html(`<i class="bi bi-check-circle-fill text-success" style="margin-right: 1rem; font-size: 2rem;" ></i>`)
      } else {
            $("#notif_icon").html(`<i class="bi bi-exclamation-circle-fill text-danger" style="margin-right: 1rem; font-size: 2rem;"></i>`)
      }

      $("#notificationModalLabel").text(title);
      $("#notificationMessage").text(message);

      const modal = new bootstrap.Modal(document.getElementById("notificationModal"));
      modal.show();
}

function showPopDelete(id) {
      $("#id_todelete").val(id);
}

function deleteProduct() {
      var id = $("#id_todelete").val();

      var formData = new FormData();
      formData.append('id', id);
      formData.append('delete_product_serial', 'user_token');

      $.ajax({
            url: 'engine/ajax.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                  console.log(response);
                  var data = JSON.parse(response);

                  showNotification(data.status, data.message);
                  if(data.status == 1) {
                        setTimeout(function() {
                              window.location.reload();
                        }, 2000);
                  }
            },
            error: function(xhr, status, error) {
                  console.error('Error:', error);
            }
      });
}

// save category
function saveCategory(request_ = 'new') {
      var id = 0;
      if(request_ == 'edit') {
            id = $('#id').val();
      }
      var code = $('#code').val();
      var name = $('#name').val();
      var parent_id = $('#parent_id').val();
      
      if(code == '') {
            showNotification(0, 'Category name is required');
            return;
      }
      if(name == '') {
            showNotification(0, 'Category name is required');
            return;
      }
      // if(parent_id == '') {
      //       showNotification(0, 'Product price is required');
      //       return;
      // }

      var formData = new FormData();
      formData.append('request_', request_);
      formData.append('id', id);
      formData.append('code', code);
      formData.append('name', name);
      formData.append('parent_id', parent_id);
      formData.append('save_category_serial', 'user_token');

      $.ajax({
            url: 'engine/ajax.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                  console.log(response);
                  var data = JSON.parse(response);

                  showNotification(data.status, data.message);
                  if(data.status == 1) {
                        setTimeout(function() {
                              window.location.href = '?page=categories';
                        }, 2000);
                  }
            },
            error: function(xhr, status, error) {
                  console.error('Error:', error);
            }
      });

}
