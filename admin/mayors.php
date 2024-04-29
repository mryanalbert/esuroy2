<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <h1>Mayors</h1>
    <div class="d-flex mt-3 justify-content-between">
      <div class="d-flex align-items-center">
        <select name="regions" class="form-select form-select-sm" id="regions" style="max-width:160px">
          <option value="" selected disabled class="d-none">--Select Region --</option>
        </select>
        <select name="provinces" class="form-select form-select-sm ms-2" id="provinces" style="max-width:170px">
          <option value="" selected disabled class="d-none">-- Select Province --</option>
        </select>
        <span id="loading-mayors" class="ms-3"></span>
      </div>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-mayor-modal">Add Mayor</button>
    </div>

    <!-- Add Mayor Modal -->
    <div class="modal fade" id="add-mayor-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Mayor</h1>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-mayor-form">
              <div class="row">
                <div class="col-md-4 mb-2">
                  <label class="form-label">Region:</label>
                  <select name="regions-form" id="regions-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select Region --</option>
                  </select>
                </div>
                <div class="col-md-4 mb-2">
                  <label class="form-label">Province:</label>
                  <select name="provinces-form" id="provinces-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select Province --</option>
                  </select>
                </div>
                <div class="col-md-4 mb-2">
                  <label class="form-label">City/Municipality:</label>
                  <select name="cities-form" id="cities-form" class="form-select" required>
                    <option value="" selected disabled class="d-none">-- Select City --</option>
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

              <input type="submit" id="add-mayor-btn" class="btn btn-primary d-block mx-auto" value="Add Mayor">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Mayor Modal -->
    <div class="modal fade" id="edit-mayor-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Mayor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit-mayor-form">
              <div class="row">
                <div class="col-md-4">
                  <input type="hidden" name="edit-mayor-id" id="edit-mayor-id">
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

              <input type="submit" id="update-mayor-btn" class="btn btn-warning d-block mx-auto" value="Update Mayor">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card rounded-0 shadow-sm mt-5">
          <div class="card-header bg-primary rounded-0">
            <span class="fs-5 text-white">Mayors</span>
          </div>
          <div class="card-body rounded-0 table-responsive" id="data-wrapper">
            <h4 class="text-center text-secondary fst-italic">No Mayors.</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require_once './assets/php/footer.php'; ?>
<script>
  $(document).ready(function() {
    // Sweetalert
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
    function fetchProvincesBasedOnRegion(elementToBeChanged, elementOutput, elementOutput2 = '') {
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

            if (elementOutput2) {
              elementOutput2.html(`
                <option value="" selected disabled class="d-none">-- Select City --</option>
              `)
            }
          }
        })
      })
    }
    fetchProvincesBasedOnRegion($('#regions'), $('#provinces'))
    fetchProvincesBasedOnRegion($('#regions-form'), $('#provinces-form'), $('#cities-form'))

    // Fetch Cities Based On Provinces
    $('#provinces-form').change(function(e) {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          provCode: $('#provinces-form').val(),
          action: 'fetchCitiesBasedOnProvince'
        },
        success: res => {
          let cities = JSON.parse(res)
          // console.log(cities)

          let citiesMapped = cities.map(city => `
            <option value="${city.city_id}">${city.city_desc}</option>
          `)

          let citiesMappedJoined = citiesMapped.join('')

          $('#cities-form').html(`
            <option value="" selected disabled class="d-none">-- Select City --</option>
            ${citiesMappedJoined}
          `)
        }
      })
    })

    $('#add-mayor-btn').click(function(e) {
      if ($('#add-mayor-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Adding Mayor...')
        $(this).attr('disabled', true)

        data = new FormData($('#add-mayor-form')[0])
        data.append('action', 'addMayor')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          success: res => {
            console.log(res)

            if (res === '1') {
              swal('success', 'Successfully Added!', 'A mayor was added.')
              $('#add-mayor-modal').modal('hide')
              $('#add-mayor-form')[0].reset()
            } else if (res === '2') {
              swal('info', 'Oops...', 'This city has a mayor already.')
            } else {
              swal('error', 'Oops...', 'Something went wrong. Please try again later.')
            }
            $('#add-mayor-btn').val('Add Mayor')
            $('#add-mayor-btn').attr('disabled', false)
          }
        })
      }
    })

    function fetchMayorsBasedOnProvinces() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          // regionCode: $('#regions').val(),
          provCode: $('#provinces').val(),
          action: 'fetchMayorsBasedOnProvinces'
        },
        success: res => {
          let mayors = JSON.parse(res)
          // console.log(mayors)

          if (mayors.length < 1) {
            $("#data-wrapper").html(`
              <h4 class="text-center text-secondary fst-italic">No Mayors.</h4>
            `)
            $('#loading-mayors').text(``)

            return;
          }

          let mayorsMapped = mayors.map(mayor => `
            <tr>
              <td>${mayor.city_desc}</td>
              <td>${mayor.mayor_fname} ${mayor.mayor_lname}</td>
              <td>
                <a href="#" title="Edit" class="edit-mayor text-decoration-none" id="edit-mayor-${mayor.mayor_uniqid}" data-bs-toggle="modal" data-bs-target="#edit-mayor-modal">
                  <i class="bi bi-pencil-square text-warning fs-5"></i>
                </a>
                <a href="#" title="Delete" class="del-mayor text-decoration-none" id="del-mayor-${mayor.mayor_uniqid}" data-city-id="${mayor.city_id}">
                  <i class="bi bi-trash-fill text-danger fs-5"></i>
                </a>
              </td>
            </tr>
          `)
          let mayorsJoined = mayorsMapped.join('')
          let mayorTable = `
            <table class="table table-striped table-bordered w-100" id="mayors-table">
              <thead>
                <tr>
                  <th>City</th>
                  <th>Mayor</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                ${mayorsJoined}
              </tbody>
            </table>
          `
          $('#data-wrapper').html(mayorTable)
          // *******
          // *******
          // Setup - add a text input to each footer cell
          $('#mayors-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#mayors-table thead');

          var table = $('#mayors-table').DataTable({
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

          $('#loading-mayors').text(``)
        }
      })
    }

    $('#provinces').change(function(e) {
      $('#loading-mayors').text(`Loading...`)
      fetchMayorsBasedOnProvinces()
    })

    // Edit Mayor
    $('body').on('click', '.edit-mayor', function(e) {
      let uniqId = $(this).attr('id')
      uniqId = uniqId.substring(11)

      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          uniqId,
          action: 'fetchMayor'
        },
        success: res => {
          let mayor = JSON.parse(res)
          // console.log(mayor)

          $('#edit-mayor-id').val(mayor.mayor_id)
          $('#edit-fname').val(mayor.mayor_fname)
          $('#edit-mname').val(mayor.mayor_mname)
          $('#edit-lname').val(mayor.mayor_lname)
          $('#edit-dob').val(mayor.mayor_dob)
          $('#edit-gen').val(mayor.mayor_gen)
        }
      })
    })

    // Updating Mayor
    $('#update-mayor-btn').click(function(e) {
      if ($('#edit-mayor-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Updating Mayor...')
        $(this).attr('disabled', true)

        data = new FormData($('#edit-mayor-form')[0])
        data.append('action', 'updateMayor')

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          success: res => {
            console.log(res)

            if (res === '1') {
              swal('success', 'Successfully updated!', 'A mayor was updated.')
              $('#edit-mayor-modal').modal('hide')
              $('#edit-mayor-form')[0].reset()
              fetchMayorsBasedOnProvinces()
            } else {
              swal('error', 'Oops...', 'Something went wrong. Please try again later.')
            }

            $('#update-mayor-btn').val('Update Mayor')
            $('#update-mayor-btn').attr('disabled', false)
          }
        })
      }
    })

    // Delete Mayor
    $('body').on('click', '.del-mayor', function(e) {
      let uniqId = $(this).attr('id')
      uniqId = uniqId.substring(10)

      let dataCityId = $(this).attr('data-city-id')

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
              action: 'delMayor',
              uniqId,
              cityId: dataCityId
            },
            success: function(res) {
              console.log(res)
              if (res == '1') {
                fetchMayorsBasedOnProvinces()
                swal('success', 'Deleted!', 'Mayor was successfully deleted.')
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