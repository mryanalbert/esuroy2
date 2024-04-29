<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <h1>Tourist Spots</h1>
    <div class="my-2">
      <span class="h6 text-secondary ms-2">Region:</span>
      <span class="text-muted"><?= $regionName ?></span>
    </div>
    <div class="my-2">
      <span class="h6 text-secondary ms-2">Province:</span>
      <span class="text-muted"><?= $provinceName ?></span>
    </div>
    <div class="my-2">
      <span class="h6 text-secondary ms-2">City/Municipality:</span>
      <span class="text-muted"><?= $cityName ?></span>
    </div>
    <div class="my-2">
      <span class="h6 text-secondary ms-2">Barangay:</span>
      <span class="text-muted"><?= $brgyName ?></span>
    </div>

    <button class="btn btn-primary btn-sm mt-3 d-block" data-bs-toggle="modal" data-bs-target="#add-spot-modal">Add Spot</button>

    <!-- Add Spot Modal -->
    <div class="modal fade" id="add-spot-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Spot</h1>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-spot-form">
              <div class="row">
                <div class="row">
                  <div class="col-md-4">
                    <label class="form-label h4">Spot Name:</label>
                    <input type="text" name="spot-name" class="form-control mb-2" required>

                    <label class="form-label mt-4 h4">Main Picture:</label>
                    <input type="file" accept="image/*" name="pic" id="pic" class="form-control mb-2" required>
                  </div>
                  <div class="col-md-8">
                    <img src="./assets/img/no-image.webp" alt="" class="img-thumbnail w-100" id="pic-show" style="height:400px;object-fit:cover;">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label h4 mt-5 mb-3">Spot body content:</label>
                    <textarea name="spot-content" id="spot-content" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
              </div>

              <input type="submit" id="add-spot-btn" class="btn btn-primary d-block mx-auto mt-4" value="Add Spot">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Spot Modal -->
    <div class="modal fade" id="edit-spot-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Spot</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit-spot-form">
              <div class="row">
                <div class="row">
                  <div class="col-md-4">
                    <input type="hidden" name="edit-spot-id" id="edit-spot-id">
                    <label class="form-label h4">Spot Name:</label>
                    <input type="text" name="edit-spot-name" id="edit-spot-name" class="form-control mb-2" required>

                    <label class="form-label mt-4 h4">Main Picture:</label>
                    <input type="file" accept="image/*" name="edit-pic" id="edit-pic" class="form-control mb-2">
                  </div>
                  <div class="col-md-8">
                    <img src="./assets/img/no-image.webp" alt="" class="img-thumbnail w-100" id="edit-pic-show" style="height:400px;object-fit:cover;">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label h4 mt-5 mb-3">Spot body content:</label>
                    <textarea name="edit-spot-content" id="edit-spot-content" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
              </div>

              <input type="submit" id="update-spot-btn" class="btn btn-warning d-block mx-auto mt-4" value="Update Spot">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card rounded-0 shadow-sm mt-5">
          <div class="card-header bg-primary rounded-0">
            <span class="fs-5 text-white">Spots</span>
          </div>
          <div class="card-body rounded-0 table-responsive" id="data-wrapper">
            <div class="d-flex align-items-center justify-content-center">
              <div class="spinner-border text-secondary" role="status"></div>
              <h2 class="text-secondary ms-2">Loading...</h2>
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
    // $('#add-spot-modal').modal('show')

    function swal(icon, title, text) {
      Swal.fire({
        icon,
        title,
        text
      })
    }

    function viewImg(candImgInp, candImgShow) {
      candImgInp.change(function(e) {
        e.preventDefault()

        let [file] = this.files
        if (file) {
          candImgShow.attr('src', URL.createObjectURL(file))
        }
      })
    }

    viewImg($('#pic'), $('#pic-show'))
    viewImg($('#edit-pic'), $('#edit-pic-show'))

    // Summernote rich text editor
    $('#spot-content').summernote({
      height: 600
    })
    $('#edit-spot-content').summernote({
      height: 600
    })

    // Add Spot
    $('#add-spot-btn').click(function(e) {
      if ($('#add-spot-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Adding Spot...')
        $(this).prop('disabled', true)

        data = new FormData($('#add-spot-form')[0])
        data.append('brgyId', '<?= $brgyId ?>')
        data.append('action', 'addSpot')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data,
          success: res => {
            console.log(res)

            if (res === '1') {
              swal('success', 'Added!', 'Spot was successfully added.')
              $('#add-spot-form')[0].reset()
              $('#add-spot-modal').modal('hide')
              fetchSpots()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#add-spot-btn').val('Add Spot')
            $('#add-spot-btn').prop('disabled', false)
          }
        })
      }
    })

    // Fetch Spots
    function fetchSpots() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          brgyId: '<?= $brgyId ?>',
          action: 'fetchSpots'
        },
        success: res => {
          let spots = JSON.parse(res)
          // console.log(spots)

          if (spots.length < 1) {
            $("#data-wrapper").html(`
              <h4 class="text-center text-secondary fst-italic">No Spots.</h4>
            `)
            return;
          }

          let spotsMapped = spots.map(spot => `
            <tr>
              <td>${spot.spot_name}</td>
              <td>
                <a href="#" title="Edit" class="edit-spot text-decoration-none" id="edit-spot-${spot.spot_id}" data-bs-toggle="modal" data-bs-target="#edit-spot-modal">
                  <i class="bi bi-pencil-square text-warning fs-5"></i>
                </a>
                <a href="#" title="Delete" class="del-spot text-decoration-none" id="del-spot-${spot.spot_id}">
                  <i class="bi bi-trash-fill text-danger fs-5"></i>
                </a>
              </td>
            </tr>
          `)
          let spotsJoined = spotsMapped.join('')
          let captainTable = `
            <table class="table table-striped table-bordered w-100" id="spots-table">
              <thead>
                <tr>
                  <th>Spot name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                ${spotsJoined}
              </tbody>
            </table>
          `
          $('#data-wrapper').html(captainTable)
          // *******
          // *******
          // Setup - add a text input to each footer cell
          $('#spots-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#spots-table thead');

          var table = $('#spots-table').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
              var api = this.api();

              // For each column
              api
                .columns()
                .eq(0)
                .each(function(colIdx) {
                  // Set the header cell to contain the input element
                  var cell = $('.filters th').eq(
                    $(api.column(colIdx).header()).index()
                  );
                  var title = $(cell).text();
                  $(cell).html(`<input type="text" placeholder="${title}" class="form-control form-control-sm ${title == 'Actions' ? 'd-none' : ''}" />`);

                  // On every keypress in this input
                  $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                    .off('keyup change')
                    .on('change', function(e) {
                      // Get the search value
                      $(this).attr('title', $(this).val());
                      var regexr = '({search})'; //$(this).parents('th').find('select').val();

                      var cursorPosition = this.selectionStart;
                      // Search the column for that value
                      api
                        .column(colIdx)
                        .search(
                          this.value != '' ?
                          regexr.replace('{search}', '(((' + this.value + ')))') :
                          '',
                          this.value != '',
                          this.value == ''
                        )
                        .draw();
                    })
                    .on('keyup', function(e) {
                      e.stopPropagation();

                      $(this).trigger('change');
                      $(this)
                        .focus()[0]
                      // .setSelectionRange(cursorPosition, cursorPosition);
                    });
                });
            },
          });
        }
      })
    }
    fetchSpots()

    // Fetch Spot
    $('body').on('click', '.edit-spot', function(e) {
      let spotId = $(this).attr('id')
      spotId = spotId.substring(10)

      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          spotId,
          action: 'fetchSpot',
        },
        success: res => {
          let spot = JSON.parse(res)
          // console.log(spot)

          $('#edit-spot-id').val(spot.spot_id)
          $('#edit-spot-name').val(spot.spot_name)
          $('#edit-pic-show').attr('src', `./assets/img/${spot.spot_main_img}`)
          $('#edit-spot-content').summernote('code', spot.spot_caption)
        }
      })
    })

    // Update Spot
    $('#update-spot-btn').click(function(e) {
      if ($('#edit-spot-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Updating Spot...')
        $(this).prop('disabled', true)

        data = new FormData($('#edit-spot-form')[0])
        data.append('action', 'updateSpot')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data,
          success: res => {
            console.log(res)
            if (res === '1') {
              swal('success', 'Updated!', 'Spot was successfully updated.')
              fetchSpots()
              $('#edit-spot-form')[0].reset()
              $('#edit-spot-modal').modal('hide')
            } else {
              swal('error', 'Oops...', 'Something went wrong, try again.')
            }
            $('#update-spot-btn').val('Update Spot')
            $('#update-spot-btn').prop('disabled', false)
          }
        })
      }
    })

    // Delete Spot
    $('body').on('click', '.del-spot', function(e) {
      let spotId = $(this).attr('id')
      spotId = spotId.substring(9)

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: './assets/php/action.php',
            method: 'post',
            data: {
              action: 'delSpot',
              spotId
            },
            success: function(res) {
              // console.log(res)
              if (res === '1') {
                fetchSpots()
                swal('success', 'Deleted!', 'Spot was successfully deleted.')
              } else {
                swal('error', 'Oops!', 'Something went wrong, try again.')
              }
            }
          })
        }
      })
    })
  })
</script>