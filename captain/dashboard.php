<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <!-- Loading modal -->
    <div class="modal" id="dashboard-loading-modal" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-0">
          <div class="modal-body text-center">
            <h2 class="text-primary mt-2 mb-3">Loading...</h2>
            <div class="spinner-border text-primary mb-2" style="width:80px;height:80px;">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p>Please wait...</p>
          </div>
        </div>
      </div>
    </div>

    <div id="dashboard-content-wrapper" class="mt-4">
      <div class="row gy-3">
        <div class="col-md-4 col-6">
          <div class="card bg-primary rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="elec-count">Loading...</div>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card bg-warning rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="course-count">Loading...</div>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card bg-primary rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="voter-count">Loading...</div>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card bg-danger rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="party-count">Loading...</div>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card bg-info rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="position-count">Loading...</div>
          </div>
        </div>
        <div class="col-md-4 col-6">
          <div class="card bg-dark rounded-0 border-0">
            <div class="card-body mx-auto">
              <i class="bi bi-people text-white" style="font-size: 50px;"></i>
            </div>
            <div class="card-footer text-white text-center" id="candidate-count">Loading...</div>
          </div>
        </div>
      </div>

      <br>

      <!-- Population of voters bar chart & Current Election Event -->
      <div class="row">
        <div class="col-md-7">
          <div class="card rounded-0">
            <div class="card-header">
              <h5>Population of Voters by Department</h5>
            </div>
            <div class="card-body" id="card-body-dep-pops">
              <canvas id="dep-populations"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card rounded-0">
            <div class="card-header bg-light rounded-0">
              <h5>Current Election Event</h5>
            </div>
            <div class="card-body">
              <form id="cur-elec-form">
                <label class="form-label">Current Election Event:</label>
                <select name="cur-elec" id="cur-elec" class="form-select"></select>
                <small id="empty-elec-current" class="text-danger d-block ms-2"></small>

                <input type="submit" value="Update Current Election Event" id="update-cur-elec-btn" class="mt-3 btn btn-outline-secondary w-100">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require_once './assets/php/footer.php'; ?>
<script>
  $(document).ready(function() {

  })
</script>