<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <h1>Captains</h1>
    <div class="d-flex justify-content-between mt-3">
      <div class="d-flex">
        <select name="regions" class="form-select form-select-sm" id="regions" style="max-width:160px">
          <option value="" selected disabled class="d-none">-- Select Region --</option>
        </select>
        <select name="provinces" class="form-select form-select-sm ms-2" id="provinces" style="max-width:170px">
          <option value="" selected disabled class="d-none">-- Select Province --</option>
        </select>
        <select name="cities" class="form-select form-select-sm ms-2" id="cities" style="max-width:140px">
          <option value="" selected disabled class="d-none">-- Select City --</option>
        </select>
        <span id="loading-captains" class="ms-3"></span>
      </div>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-captain-modal">Add Captain</button>
    </div>

    <!-- Add Captain Modal -->
    <div class="modal fade" id="add-captain-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Captain</h1>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-captain-form">
              <div class="row">
                <div class="col-md-3 mb-2">
                  <label class="form-label">Region:</label>
                  <select name="regions-form" id="regions-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select Region --</option>
                  </select>
                </div>
                <div class="col-md-3 mb-2">
                  <label class="form-label">Province:</label>
                  <select name="provinces-form" id="provinces-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select Province --</option>
                  </select>
                </div>
                <div class="col-md-3 mb-2">
                  <label class="form-label">City/Municipality:</label>
                  <select name="cities-form" id="cities-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select City --</option>
                  </select>
                </div>
                <div class="col-md-3 mb-2">
                  <label class="form-label">Barangay:</label>
                  <select name="brgys-form" id="brgys-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select barangay --</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">First name:</label>
                  <input type="text" name="fname" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Middle name:</label>
                  <input type="text" name="mname" class="form-control mb-2">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Last name:</label>
                  <input type="text" name="lname" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Birthdate:</label>
                  <input type="date" name="dob" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender:</label>
                  <select name="gen" class="form-select">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Picture:</label>
                  <input type="file" accept="image/*" name="pic" class="form-control mb-2">
                </div>
              </div>

              <input type="submit" id="add-captain-btn" class="btn btn-primary d-block mx-auto" value="Add Captain">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Captain Modal -->
    <div class="modal fade" id="edit-captain-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Captain</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit-captain-form">
              <div class="row">
                <div class="col-md-4">
                  <input type="hidden" name="cap-id" id="cap-id">
                  <label class="form-label">First name:</label>
                  <input type="text" name="edit-fname" id="edit-fname" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Middle name:</label>
                  <input type="text" name="edit-mname" id="edit-mname" class="form-control mb-2">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Last name:</label>
                  <input type="text" name="edit-lname" id="edit-lname" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Birthdate:</label>
                  <input type="date" name="edit-dob" id="edit-dob" class="form-control mb-2" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Gender:</label>
                  <select name="edit-gen" id="edit-gen" class="form-select">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Picture:</label>
                  <input type="file" accept="image/*" name="edit-pic" id="edit-pic" class="form-control mb-2">
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <label class="form-label">Password:</label>
                  <input type="text" name="edit-pass" id="edit-pass" class="form-control mb-2">
                </div>
              </div>

              <input type="submit" id="update-captain-btn" class="btn btn-warning d-block mx-auto" value="Update Captain">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card rounded-0 shadow-sm mt-5">
          <div class="card-header bg-primary rounded-0">
            <span class="fs-5 text-white">Captains</span>
          </div>
          <div class="card-body rounded-0 table-responsive" id="data-wrapper">
            <h4 class="text-center text-secondary fst-italic">No Captains.</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require_once './assets/php/footer.php'; ?>
<script>
  $(document).ready(function() {
    function swal(icon, title, text) {
      Swal.fire({
        icon,
        title,
        text
      })
    }

    // Fetch Regions
    function fetchRegions() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          action: 'fetchRegions',
        },
        success: res => {
          let regions = JSON.parse(res)
          // console.log(regions)

          let regionsMapped = regions.map(reg => `
            <option value="${reg.reg_code}">${reg.reg_desc}</option>
          `)

          let regionsMappedJoined = regionsMapped.join('')
          $('#regions').html(`
            <option value="" selected disabled class="d-none">-- Select Region --</option>
            ${regionsMappedJoined}
          `)
          $('#regions-form').html(`
            <option value="" selected disabled class="d-none">-- Select Region --</option>
            ${regionsMappedJoined}
          `)
        }
      })
    }
    fetchRegions()

    // Fetch Provinces Based On Region
    function fetchProvincesBasedOnRegion(elementToBeChanged, elementOutput, elementOutput2, elementOutput3 = '') {
      elementToBeChanged.change(function(e) {
        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          data: {
            regCode: elementToBeChanged.val(),
            action: 'fetchProvincesBasedOnRegion'
          },
          success: res => {
            let provinces = JSON.parse(res)
            // console.log(provinces)

            let provincesMapped = provinces.map(prov => `
              <option value="${prov.prov_code}">${prov.prov_desc}</option>
            `)

            let provincesMappedJoined = provincesMapped.join('')

            elementOutput.html(`
              <option value="" selected disabled class="d-none">-- Select Province --</option>
              ${provincesMappedJoined}
            `)

            elementOutput2.html(`
              <option value="" selected disabled class="d-none">-- Select City --</option>
            `)

            if (elementOutput3) {
              elementOutput3.html(`
                <option value="" selected disabled class="d-none">-- Select barangays --</option>
              `)
            }
          }
        })
      })
    }
    fetchProvincesBasedOnRegion($('#regions'), $('#provinces'), $('#cities'))
    fetchProvincesBasedOnRegion($('#regions-form'), $('#provinces-form'), $('#cities-form'), $('#brgys-form'))

    // Fetch Cities Based On Provinces
    function fetchCitiesBasedOnProvince(elementToBeChanged, elementOutput, elementOutput2 = '') {
      elementToBeChanged.change(function(e) {
        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          data: {
            provCode: elementToBeChanged.val(),
            action: 'fetchCitiesBasedOnProvince'
          },
          success: res => {
            let cities = JSON.parse(res)
            // console.log(cities)

            let citiesMapped = cities.map(city => `
            <option value="${city.city_code}">${city.city_desc}</option>
          `)

            let citiesMappedJoined = citiesMapped.join('')

            elementOutput.html(`
              <option value="" selected disabled class="d-none">-- Select City --</option>
              ${citiesMappedJoined}
            `)

            if (elementOutput2) {
              elementOutput2.html(`
                <option value="" selected disabled class="d-none">-- Select barangay --</option>
              `)
            }
          }
        })
      })
    }
    fetchCitiesBasedOnProvince($('#provinces'), $('#cities'))
    fetchCitiesBasedOnProvince($('#provinces-form'), $('#cities-form'), $('#brgys-form'))

    // Fetch Brgys Based On Cities
    $('#cities-form').change(function(e) {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          cityCode: $('#cities-form').val(),
          action: 'fetchBrgysBasedOnCities'
        },
        success: res => {
          let brgys = JSON.parse(res)
          // console.log(brgys)

          let brgysMapped = brgys.map(brgy => `
            <option value="${brgy.brgy_code}">${brgy.brgy_desc}</option>
          `)

          let brgysMappedJoined = brgysMapped.join('')

          $('#brgys-form').html(`
            <option value="" selected disabled class="d-none">-- Select barangay --</option>
            ${brgysMappedJoined}
          `)
        }
      })
    })

    // Add Captain
    $('#add-captain-btn').click(function(e) {
      if ($('#add-captain-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Adding Captain...')
        $(this).attr('disabled', true)

        data = new FormData($('#add-captain-form')[0])
        data.append('action', 'addCaptain')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          cache: false,
          contentType: false,
          data,
          success: res => {
            console.log(res)
            if (res === '1') {
              swal('success', 'Added', 'Captain was successfully added!')
              $('#add-captain-form')[0].reset()
              $('#add-captain-modal').modal('hide')
              fetchCaptainsBasedOnCities()
            } else if (res === '2') {
              swal('error', 'Oops...', 'There is already a captain for this barangay.')
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#add-captain-btn').val('Add Captain')
            $('#add-captain-btn').attr('disabled', false)
          }
        })
      }
    })

    // Fetch Captains Based On Cities
    function fetchCaptainsBasedOnCities() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          cityCode: $('#cities').val(),
          action: 'fetchCaptainsBasedOnCities'
        },
        success: res => {
          let captains = JSON.parse(res)
          // console.log(captains)

          if (captains.length < 1) {
            $("#data-wrapper").html(`
              <h4 class="text-center text-secondary fst-italic">No Captains.</h4>
            `)
            $('#loading-captains').text(``)
            return;
          }

          let captainsMapped = captains.map(brgy => `
            <tr>
              <td>${brgy.brgy_desc}</td>
              <td>${brgy.cap_fname} ${brgy.cap_lname}</td>
              <td>
                <a href="#" title="Edit" class="edit-cap text-decoration-none" id="edit-cap-${brgy.cap_id}" data-bs-toggle="modal" data-bs-target="#edit-captain-modal">
                  <i class="bi bi-pencil-square text-warning fs-5"></i>
                </a>
                <a href="#" title="Delete" class="del-cap text-decoration-none" id="del-cap-${brgy.brgy_code}" data-cap-uniqid="${brgy.cap_uniqid}">
                  <i class="bi bi-trash-fill text-danger fs-5"></i>
                </a>
              </td>
            </tr>
          `)
          let captainsJoined = captainsMapped.join('')
          let captainTable = `
            <table class="table table-striped table-bordered w-100" id="captains-table">
              <thead>
                <tr>
                  <th>Barangay</th>
                  <th>Captain</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                ${captainsJoined}
              </tbody>
            </table>
          `
          $('#data-wrapper').html(captainTable)
          // *******
          // *******
          // Setup - add a text input to each footer cell
          $('#captains-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#captains-table thead');

          var table = $('#captains-table').DataTable({
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

          $('#loading-captains').text(``)
        }
      })
    }

    $('#cities').change(function(e) {
      $('#loading-captains').text(`Loading...`)
      fetchCaptainsBasedOnCities()
    })

    // Delete Captain
    $('body').on('click', '.del-cap', function(e) {
      let brgyCode = $(this).attr('id')
      brgyCode = brgyCode.substring(8)

      let uniqId = $(this).attr('data-cap-uniqid')

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
              action: 'delCaptain',
              uniqId,
              brgyCode
            },
            success: function(res) {
              console.log(res)
              if (res == '1') {
                fetchCaptainsBasedOnCities()
                swal('success', 'Deleted!', 'Captain was successfully deleted.')
              } else {
                swal('error', 'Oops!', 'Something went wrong, try again.')
              }
            }
          })
        }
      })
    })

    // Edit Captain
    $('body').on('click', '.edit-cap', function(e) {
      let capId = $(this).attr('id')
      capId = capId.substring(9)

      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          capId,
          action: 'fetchCaptain'
        },
        success: res => {
          let captain = JSON.parse(res)
          // console.log(captain)

          $('#cap-id').val(captain.cap_id)
          $('#edit-fname').val(captain.cap_fname)
          $('#edit-mname').val(captain.cap_mname)
          $('#edit-lname').val(captain.cap_lname)
          $('#edit-dob').val(captain.cap_dob)
          $('#edit-gen').val(captain.cap_gen)
          $('#edit-pass').val(captain.cap_pw)
        }
      })
    })

    // Update Captain
    $('#update-captain-btn').click(function(e) {
      if ($('#edit-captain-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).attr('disabled', true)
        $(this).val('Updating Captain...')

        data = new FormData($('#edit-captain-form')[0])
        data.append('action', 'updateCaptain')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          cache: false,
          contentType: false,
          data,
          success: res => {
            // console.log(res)
            if (res === '1') {
              swal('success', 'Updated', 'Captain was successfully updated!')
              $('#edit-captain-form')[0].reset()
              $('#edit-captain-modal').modal('hide')
              fetchCaptainsBasedOnCities()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#update-captain-btn').attr('disabled', false)
            $('#update-captain-btn').val('Update Captain')
          }
        })
      }
    })
  })
</script>