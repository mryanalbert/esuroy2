<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css" />
  <title>Hotels</title>

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

  <!-- View Hotel Modal -->
  <div class="modal fade" id="view-hotel-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
      <div class="modal-content rounded-0">
        <div class="modal-body p-0">
          <h1 id="hotel-name" class="my-5 text-center"></h1>
          <div class="hotel-img-container">
            <img src="" class="d-block mx-auto w-100 rounded-2" id="hotel-img" style="max-width:900px;height:500px;object-fit:cover;" alt="...">
          </div>

          <p class="m-0 mt-3 text-center small text-muted">
            Region:
            <span id="hotel-region">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="hotel-province">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="hotel-city">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="hotel-brgy">d</span>
          </p>

          <div class="hotel-caption-container mx-auto" style="max-width:900px;">
            <p id="hotel-caption" class="text-dark-emphasis my-5"></p>
          </div>

          <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
          <img src="" id="hotel-mayor-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="hotel-mayor-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="hotel-mayor-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="hotel-mayor-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="hotel-mayor-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="hotel-mayor-dob">d</span>
          </p>
          
          <h1 class="text-center my-3 lead fw-bold mt-5">Barangay Captain</h1>
          <img src="" id="hotel-captain-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="hotel-captain-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="hotel-captain-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="hotel-captain-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="hotel-captain-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="hotel-captain-dob">d</span>
          </p>
          <a href="#" class="fs-5 d-block my-5 text-center" id="close-modal">Back</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div id="data-wrapper" class="py-5 mx-auto" style="max-width:800px;">
      <h4 class="text-center text-secondary fst-italic">No Hotels.</h4>
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
      // $('#view-hotel-modal').modal('show')

      $('body').on('click', '.view-hotel', function(e) {
        let id = $(this).attr('id')
        id = id.substring(11)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            id,
            action: 'fetchHotel',
          },
          success: res => {
            let hotel = JSON.parse(res)
            console.log(hotel)

            $('#hotel-img').attr('src', `captain/assets/img/${hotel.hotel_main_img}`)
            $('#hotel-name').text(hotel.hotel_name)
            $('#hotel-caption').html(hotel.hotel_caption)

            $('#hotel-region').text(hotel.reg_desc)
            $('#hotel-province').text(hotel.prov_desc)
            $('#hotel-city').text(hotel.city_desc)
            $('#hotel-brgy').text(hotel.brgy_desc)

            // START MAYOR
            let mayorPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (hotel.mayor_pic) {
              mayorPic = `./admin/assets/img/${hotel.mayor_pic}`
            } 

            $('#hotel-mayor-pic').attr('src', mayorPic)
            $('#hotel-mayor-fname').text(hotel.fname ? hotel.fname : 'N/A')
            $('#hotel-mayor-mname').text(hotel.mname ? hotel.mname : 'None')
            $('#hotel-mayor-lname').text(hotel.lname ? hotel.lname : 'N/A')

            if (hotel.mayor_gen == null) {
              $('#hotel-mayor-gender').text('N/A')
            } else {
              if (hotel.mayor_gen == 1) {
                $('#hotel-mayor-gender').text('Male')
              } else {
                $('#hotel-mayor-gender').text('Female')
              }
            }

            if (hotel.mayor_dob) {
              $('#hotel-mayor-dob').text(hotel.mayor_dob)
            } else {
              $('#hotel-mayor-dob').text('N/A')
            }
            // END MAYOR

            // START CAPTAIN
            let captainPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (hotel.cap_pic) {
              captainPic = `./admin/assets/img/${hotel.cap_pic}`
            } 
            $('#hotel-captain-pic').attr('src', captainPic)
            $('#hotel-captain-fname').text(hotel.cap_fname)
            $('#hotel-captain-mname').text(hotel.cap_mname ? hotel.cap_mname : "None")
            $('#hotel-captain-lname').text(hotel.cap_lname)
            $('#hotel-captain-gender').text(hotel.cap_gender ? 'Male' : 'Female')
            $('#hotel-captain-dob').text(hotel.cap_dob ? hotel.cap_dob : 'N/A')
            // END CAPTAIN
          }
        })
      })

      $('#close-modal').click(function(e) {
        $('#view-hotel-modal').modal('hide')
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
                <h4 class="text-center text-secondary fst-italic">No Hotels.</h4>
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
                <h4 class="text-center text-secondary fst-italic">No Hotels.</h4>
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

      // Fetch Hotels Based On Cities
      function fetchHotelsBasedOnCities() {
        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            cityCode: $('#cities').val(),
            action: 'fetchHotelsBasedOnCities'
          },
          success: res => {
            let hotels = JSON.parse(res)
            // console.log(res)

            if (hotels.length < 1) {
              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Hotels.</h4>
              `)
              $('#filtering').text(``)
              return;
            }

            let hotelsMapped = hotels.map(hotel => `
              <tr>
                <td>${hotel.hotel_name}</td>
                <td>${hotel.brgy_desc}</td>
                <td>${hotel.hotel_offers_meal ? 'Yes' : 'No'}</td>
                <td>
                  <button title="View" class="view-hotel d-block mx-auto btn btn-sm btn-primary" id="view-hotel-${hotel.hotel_id}" data-bs-toggle="modal" data-bs-target="#view-hotel-modal">
                    View
                  </button>
                </td>
              </tr>
            `)
            let hotelsJoined = hotelsMapped.join('')
            let hotelTable = `
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="hotels-table">
                  <thead>
                    <tr>
                      <th>Tourist Spot</th>
                      <th>Barangay</th>
                      <th>Offers Meal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${hotelsJoined}
                  </tbody>
                </table>
              </div>
            `
            $('#data-wrapper').html(hotelTable)
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
        fetchHotelsBasedOnCities()
      })
    })
  </script>
</body>
</html>