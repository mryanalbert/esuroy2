<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css" />
  <title>Tourist Spots</title>

  <style>
    .heading {
      font-size: 100px;
    }

    .quote {
      font-size: 24px;
    }

    @media (max-width: 576px) {
      .heading {
        font-size: 43px;
      }

      .quote {
        font-size: 17px;
      }
    }
  </style>
</head>
<body>
  <?php
    require_once './landing-page.php';
  ?>
  <div class="bg-dark py-4 d-flex flex-column flex-md-row justify-content-center gap-4 align-items-center">
    <select id="regions" class="bg-dark form-select" data-bs-theme="dark" style="max-width:190px">
      <option value="">-- Select Region --</option>
    </select>
    <select id="provinces" class="bg-dark form-select" data-bs-theme="dark" style="max-width:190px">
      <option value="">-- Select Province --</option>
    </select>
    <select id="cities" class="bg-dark form-select" data-bs-theme="dark" style="max-width:260px">
      <option value="">-- Select City/Municipality --</option>
    </select>
    <span id="filtering" class="fs-5 text-warning"></span>
  </div>

  <!-- View Spot Modal -->
  <div class="modal fade" id="view-spot-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
      <div class="modal-content rounded-0">
        <div class="modal-body p-2">
          <h1 id="spot-name" class="my-5 text-center"></h1>
          <div class="spot-img-container">
            <img src="" class="d-block mx-auto w-100 rounded-2" id="spot-img" style="max-width:900px;height:500px;object-fit:cover;" alt="...">
          </div>

          <p class="m-0 mt-3 text-center small text-muted">
            Region:
            <span id="spot-region">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="spot-province">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="spot-city">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="spot-brgy">d</span>
          </p>

          <div class="spot-caption-container mx-auto" style="max-width:900px;">
            <p id="spot-caption" class="text-dark-emphasis my-5"></p>
          </div>
          
          <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
          <img src="" id="spot-mayor-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="spot-mayor-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="spot-mayor-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="spot-mayor-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="spot-mayor-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="spot-mayor-dob">d</span>
          </p>
          
          <h1 class="text-center my-3 lead fw-bold mt-5">Barangay Captain</h1>
          <img src="" id="spot-captain-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="spot-captain-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="spot-captain-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="spot-captain-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="spot-captain-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="spot-captain-dob">d</span>
          </p>
          <a href="#" class="fs-5 d-block my-5 text-center" id="close-modal">Back</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div id="data-wrapper" class="py-5 mx-auto" style="max-width:800px;">
      <h4 class="text-center text-secondary fst-italic">No Spots.</h4>
    </div>
  </div>

  <script src="./libs/jquery.min.js"></script>
  <script src="./libs/bootstrap.bundle.min.js"></script>
  <script src="./libs/sweetalert2.all.min.js"></script>
  <script src="./libs/DataTables/datatables.min.js"></script>
  <script src="./libs/DataTables/FixedHeader-3.4.0/js/dataTables.fixedHeader.js"></script>
  <script src="./libs/chart.min.js"></script>
  <script src="./libs/summernote/summernote-lite.js"></script>
  <script>
    $(document).ready(function() {
      // $('#view-spot-modal').modal('show')

      $('body').on('click', '.view-spot', function(e) {
        let id = $(this).attr('id')
        id = id.substring(10)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            id,
            action: 'fetchSpot',
          },
          success: res => {
            let spot = JSON.parse(res)
            // console.log(spot)

            $('#spot-img').attr('src', `captain/assets/img/${spot.spot_main_img}`)
            $('#spot-name').text(spot.spot_name)
            $('#spot-caption').html(spot.spot_caption)

            $('#spot-region').text(spot.reg_desc)
            $('#spot-province').text(spot.prov_desc)
            $('#spot-city').text(spot.city_desc)
            $('#spot-brgy').text(spot.brgy_desc)

            // START MAYOR
            let mayorPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (spot.mayor_pic) {
              mayorPic = `./admin/assets/img/${spot.mayor_pic}`
            } 

            $('#spot-mayor-pic').attr('src', mayorPic)
            $('#spot-mayor-fname').text(spot.fname ? spot.fname : 'N/A')
            $('#spot-mayor-mname').text(spot.mname ? spot.mname : 'None')
            $('#spot-mayor-lname').text(spot.lname ? spot.lname : 'N/A')

            if (spot.mayor_gen == null) {
              $('#spot-mayor-gender').text('N/A')
            } else {
              if (spot.mayor_gen == 1) {
                $('#spot-mayor-gender').text('Male')
              } else {
                $('#spot-mayor-gender').text('Female')
              }
            }

            if (spot.mayor_dob) {
              $('#spot-mayor-dob').text(spot.mayor_dob)
            } else {
              $('#spot-mayor-dob').text('N/A')
            }
            // END MAYOR

            // START CAPTAIN
            let captainPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (spot.cap_pic) {
              captainPic = `./admin/assets/img/${spot.cap_pic}`
            } 
            $('#spot-captain-pic').attr('src', captainPic)
            $('#spot-captain-fname').text(spot.cap_fname)
            $('#spot-captain-mname').text(spot.cap_mname ? spot.cap_mname : "None")
            $('#spot-captain-lname').text(spot.cap_lname)
            $('#spot-captain-gender').text(spot.cap_gender ? 'Male' : 'Female')
            $('#spot-captain-dob').text(spot.cap_dob ? spot.cap_dob : 'N/A')
            // END CAPTAIN
          }
        })
      })

      $('#close-modal').click(function(e) {
        $('#view-spot-modal').modal('hide')
      })
      
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
          url: './admin/assets/php/action.php',
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
          }
        })
      }
      fetchRegions()

      // Fetch Provinces Based On Region
      function fetchProvincesBasedOnRegion(elementToBeChanged, elementOutput, elementOutput2, elementOutput3 = '') {
        elementToBeChanged.change(function(e) {
          $.ajax({
            url: './admin/assets/php/action.php',
            method: 'post',
            data: {
              regCode: elementToBeChanged.val(),
              action: 'fetchProvincesBasedOnRegion'
            },
            success: res => {
              let provinces = JSON.parse(res)
              // console.log(provinces)

              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Spots.</h4>
              `)

              let provincesMapped = provinces.map(prov => `
                <option value="${prov.prov_code}">${prov.prov_desc}</option>
              `)

              let provincesMappedJoined = provincesMapped.join('')

              elementOutput.html(`
                <option value="" selected disabled class="d-none">-- Select Province --</option>
                ${provincesMappedJoined}
              `)

              elementOutput2.html(`
                <option value="" selected disabled class="d-none">-- Select City/Municipality --</option>`)

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

      // Fetch Cities Based On Provinces
      function fetchCitiesBasedOnProvince(elementToBeChanged, elementOutput, elementOutput2 = '') {
        elementToBeChanged.change(function(e) {
          $.ajax({
            url: './admin/assets/php/action.php',
            method: 'post',
            data: {
              provCode: elementToBeChanged.val(),
              action: 'fetchCitiesBasedOnProvince'
            },
            success: res => {
              let cities = JSON.parse(res)
              // console.log(cities)

              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Spots.</h4>
              `)

              let citiesMapped = cities.map(city => `
              <option value="${city.city_code}">${city.city_desc}</option>
            `)

              let citiesMappedJoined = citiesMapped.join('')

              elementOutput.html(`
                <option value="" selected disabled class="d-none">-- Select City/Municipality --</option>
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

      // Fetch Spots Based On Cities
      function fetchSpotsBasedOnCities() {
        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            cityCode: $('#cities').val(),
            action: 'fetchSpotsBasedOnCities'
          },
          success: res => {
            let spots = JSON.parse(res)
            // console.log(res)

            if (spots.length < 1) {
              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Spots.</h4>
              `)
              $('#filtering').text(``)
              return;
            }

            let spotsMapped = spots.map(spot => `
              <tr>
                <td>${spot.spot_name}</td>
                <td>${spot.brgy_desc}</td>
                <td>
                  <button title="View" class="view-spot d-block mx-auto btn btn-sm btn-primary" id="view-spot-${spot.spot_id}" data-bs-toggle="modal" data-bs-target="#view-spot-modal">
                    View
                  </button>
                </td>
              </tr>
            `)
            let spotsJoined = spotsMapped.join('')
            let spotTable = `
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="spots-table">
                  <thead>
                    <tr>
                      <th>Tourist Spot</th>
                      <th>Barangay</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${spotsJoined}
                  </tbody>
                </table>
              </div>
            `
            $('#data-wrapper').html(spotTable)
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
                    $(cell).html(`<input type="text" placeholder="${title}" class="form-control form-control-sm ${title == 'Action' ? 'd-none' : ''}" />`);

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

            $('#filtering').text(``)
          }
        })
      }

      $('#cities').change(function(e) {
        $('#filtering').text(`Loading...`)
        fetchSpotsBasedOnCities()
      })
    })
  </script>
</body>
</html>