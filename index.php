<?php include("header.php") ?>
      <!-- Content -->
      <?php
      if (isset($_GET["page"])) {
            $page = $_GET["page"];
            include("pages/$page/main.php");
      } else {
            include("pages/dashboard/main.php");
      }
      ?>
      <!-- / Content -->
      <!-- Modal Notifikasi -->
      <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <div class="d-flex align-items-center">
                <div id="notif_icon"></div>
                <h5 class="modal-title fw-bold" id="notificationModalLabel">Notifikasi</h5>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="notificationMessage">Pesan notifikasi akan muncul di sini.</p>
            </div>
            <div class="modal-footer">
              <!-- <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div> -->
              <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button> -->
            </div>
          </div>
        </div>
      </div>
<?php include("footer.php") ?>