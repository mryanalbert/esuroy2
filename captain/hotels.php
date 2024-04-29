<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <h1>Hotels</h1>
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

    <button class="btn btn-primary btn-sm mt-3 d-block" data-bs-toggle="modal" data-bs-target="#add-hotel-modal">Add Hotel</button>

    <!-- Add Hotel Modal -->
    <div class="modal fade" id="add-hotel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Hotel</h1>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-hotel-form">
              <div class="row">
                <div class="row">
                  <div class="col-md-4">
                    <label class="form-label h4">Hotel Name:</label>
                    <input type="text" name="hotel-name" class="form-control mb-2" required>

                    <label class="form-label mt-3 h4">Street:</label>
                    <input type="text" name="street" class="form-control mb-2" required>

                    <label class="form-label mt-3 h4">Offers Meal:</label>
                    <select name="offer-meal" id="offer-meal" class="form-select">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>

                    <label class="form-label mt-4 h4">Main Picture:</label>
                    <input type="file" accept="image/*" name="pic" id="pic" class="form-control mb-2" required>
                  </div>
                  <div class="col-md-8">
                    <img src="./assets/img/no-image.webp" alt="" class="img-thumbnail w-100" id="pic-show" style="height:400px;object-fit:cover;">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label h4 mt-5 mb-3">Hotel body content:</label>
                    <textarea name="hotel-content" id="hotel-content" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
              </div>

              <input type="submit" id="add-hotel-btn" class="btn btn-primary d-block mx-auto mt-4" value="Add Hotel">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Hotel Modal -->
    <div class="modal fade" id="edit-hotel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Hotel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit-hotel-form">
              <div class="row">
                <div class="row">
                  <div class="col-md-4">
                    <input type="hidden" name="edit-id" id="edit-id">
                    <label class="form-label h4">Hotel Name:</label>
                    <input type="text" name="edit-hotel-name" id="edit-hotel-name" class="form-control mb-2" required>

                    <label class="form-label mt-3 h4">Street:</label>
                    <input type="text" name="edit-street" id="edit-street" class="form-control mb-2" required>

                    <label class="form-label mt-3 h4">Offers Meal:</label>
                    <select name="edit-offer-meal" id="edit-offer-meal" class="form-select">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>

                    <label class="form-label mt-4 h4">Main Picture:</label>
                    <input type="file" accept="image/*" name="edit-pic" id="edit-pic" class="form-control mb-2">
                  </div>
                  <div class="col-md-8">
                    <img src="./assets/img/no-image.webp" alt="" class="img-thumbnail w-100" id="edit-pic-show" style="height:400px;object-fit:cover;">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label h4 mt-5 mb-3">Hotel body content:</label>
                    <textarea name="edit-hotel-content" id="edit-hotel-content" class="form-control" cols="30" rows="10"></textarea>
                  </div>
                </div>
              </div>

              <input type="submit" id="update-hotel-btn" class="btn btn-warning d-block mx-auto mt-4" value="Update Hotel">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card rounded-0 shadow-sm mt-5">
          <div class="card-header bg-primary rounded-0">
            <span class="fs-5 text-white">Hotels</span>
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
    $('#hotel-content').summernote({
      height: 600
    })
    $('#edit-hotel-content').summernote({
      height: 600
    })

    // Fetch Hotels
    function fetchHotels() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          brgyId: '<?= $brgyId ?>',
          action: 'fetchHotels'
        },
        success: res => {
          let hotels = JSON.parse(res)
          // console.log(hotels)

          if (hotels.length < 1) {
            $("#data-wrapper").html(`
              <h4 class="text-center text-secondary fst-italic">No Hotels.</h4>
            `)
            return;
          }

          let hotelsMapped = hotels.map(hotel => `
            <tr>
              <td>${hotel.hotel_name}</td>
              <td>
                <a href="#" title="Edit" class="edit-hotel text-decoration-none" id="edit-hotel-${hotel.hotel_id}" data-bs-toggle="modal" data-bs-target="#edit-hotel-modal">
                  <i class="bi bi-pencil-square text-warning fs-5"></i>
                </a>
                <a href="#" title="Delete" class="del-hotel text-decoration-none" id="del-hotel-${hotel.hotel_id}">
                  <i class="bi bi-trash-fill text-danger fs-5"></i>
                </a>
              </td>
            </tr>
          `)
          let hotelsJoined = hotelsMapped.join('')
          let captainTable = `
            <table class="table table-striped table-bordered w-100" id="hotels-table">
              <thead>
                <tr>
                  <th>Hotel name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                ${hotelsJoined}
              </tbody>
            </table>
          `
          $('#data-wrapper').html(captainTable)
          // *******
          // *******
          // Setup - add a text input to each footer cell
          $('#hotels-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#hotels-table thead');

          var table = $('#hotels-table').DataTable({
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
    fetchHotels()

    // Add Hotel
    $('#add-hotel-btn').click(function(e) {
      if ($('#add-hotel-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Adding Hotel...')
        $(this).prop('disabled', true)

        data = new FormData($('#add-hotel-form')[0])
        data.append('brgyId', '<?= $brgyId ?>')
        data.append('action', 'addHotel')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data,
          success: res => {
            // console.log(res)

            if (res === '1') {
              swal('success', 'Added!', 'Hotel was successfully added.')
              $('#add-hotel-form')[0].reset()
              $('#add-hotel-modal').modal('hide')
              $('.note-editable').html('<p><br></p>')
              $('#pic-show').attr('src', './assets/img/no-image.webp')
              fetchHotels()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#add-hotel-btn').val('Add Hotel')
            $('#add-hotel-btn').prop('disabled', false)
          }
        })
      }
    })

    // Edit Hotel
    $('body').on('click', '.edit-hotel', function(e) {
      let hotelId = $(this).attr('id')
      hotelId = hotelId.substring(11)

      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          hotelId,
          action: 'fetchHotel'
        },
        success: res => {
          let hotel = JSON.parse(res)
          // console.log(hotel)

          $('#edit-id').val(hotel.hotel_id)
          $('#edit-hotel-name').val(hotel.hotel_name)
          $('#edit-street').val(hotel.hotel_street)
          $('#edit-offer-meal').val(hotel.hotel_offers_meal)
          $('#edit-pic-show').attr('src', `./assets/img/${hotel.hotel_main_img}`)
          $('#edit-hotel-content').summernote('code', hotel.hotel_caption)
        }
      })
    })

    // Update Hotel
    $('#update-hotel-btn').click(function(e) {
      if ($('#edit-hotel-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Updating Hotel...')
        $(this).prop('disabled', true)

        data = new FormData($('#edit-hotel-form')[0])
        data.append('action', 'updateHotel')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data,
          success: res => {
            // console.log(res)

            if (res === '1') {
              swal('success', 'Updated!', 'Hotel was successfully updated.')
              $('#edit-hotel-modal').modal('hide')
              $('#edit-hotel-form')[0].reset()
              $('.note-editable').html('<p><br></p>')
              $('#edit-pic-show').attr('src', './assets/img/no-image.webp')
              fetchHotels()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#update-hotel-btn').val('Update Hotel')
            $('#update-hotel-btn').prop('disabled', false)
          }
        })
      }
    })

    // Delete Hotel
    $('body').on('click', '.del-hotel', function(e) {
      let hotelId = $(this).attr('id')
      hotelId = hotelId.substring(10)

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
              action: 'delHotel',
              hotelId
            },
            success: function(res) {
              // console.log(res)
              if (res === '1') {
                fetchHotels()
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