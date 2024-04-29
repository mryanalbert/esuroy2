<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css" />
  <title>Events</title>

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

  <!-- View Event Modal -->
  <div class="modal fade" id="view-event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
      <div class="modal-content rounded-0">
        <div class="modal-body p-2">
          <h1 id="event-name" class="my-2 text-center"></h1>

          <p class="m-0 text-center small text-muted">
            Region:
            <span id="event-region">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="event-province">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="event-city">d</span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="event-brgy">d</span>
          </p>

          <div class="event-caption-container mx-auto" style="max-width:900px;">
            <p id="event-caption" class="text-dark-emphasis my-5"></p>
          </div>
          
          <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
          <img src="" id="event-mayor-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="event-mayor-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="event-mayor-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="event-mayor-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="event-mayor-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="event-mayor-dob">d</span>
          </p>
          
          <h1 class="text-center my-3 lead fw-bold mt-5">Barangay Captain</h1>
          <img src="" id="event-captain-pic" class="mx-auto d-block img-thumbnail" style="max-width:350px;height:350px;object-fit:cover;" alt="">
          <p class="m-0 mt-3 text-center">
            First name:
            <span id="event-captain-fname">d</span>
          </p>
          <p class="m-0 text-center">
            Middle name:
            <span id="event-captain-mname">d</span>
          </p>
          <p class="m-0 text-center">
            Last name:
            <span id="event-captain-lname">d</span>
          </p>
          <p class="m-0 text-center">
            Gender:
            <span id="event-captain-gender">d</span>
          </p>
          <p class="m-0 text-center">
            Birthdate:
            <span id="event-captain-dob">d</span>
          </p>
          <a href="#" class="fs-5 d-block my-5 text-center" id="close-modal">Back</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div id="data-wrapper" class="py-5 mx-auto" style="max-width:800px;">
      <h4 class="text-center text-secondary fst-italic">No Events.</h4>
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
      // $('#view-event-modal').modal('show')

      $('body').on('click', '.view-event', function(e) {
        let id = $(this).attr('id')
        id = id.substring(11)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            id,
            action: 'fetchEvent',
          },
          success: res => {
            let event = JSON.parse(res)
            // console.log(event)

            $('#event-name').text(event.event_name)
            $('#event-caption').html(event.event_caption)

            $('#event-region').text(event.reg_desc)
            $('#event-province').text(event.prov_desc)
            $('#event-city').text(event.city_desc)
            $('#event-brgy').text(event.brgy_desc)

            // START MAYOR
            let mayorPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (event.mayor_pic) {
              mayorPic = `./admin/assets/img/${event.mayor_pic}`
            } 

            $('#event-mayor-pic').attr('src', mayorPic)
            $('#event-mayor-fname').text(event.fname ? event.fname : 'N/A')
            $('#event-mayor-mname').text(event.mname ? event.mname : 'None')
            $('#event-mayor-lname').text(event.lname ? event.lname : 'N/A')

            if (event.mayor_gen == null) {
              $('#event-mayor-gender').text('N/A')
            } else {
              if (event.mayor_gen == 1) {
                $('#event-mayor-gender').text('Male')
              } else {
                $('#event-mayor-gender').text('Female')
              }
            }

            if (event.mayor_dob) {
              $('#event-mayor-dob').text(event.mayor_dob)
            } else {
              $('#event-mayor-dob').text('N/A')
            }
            // END MAYOR

            // START CAPTAIN
            let captainPic = './admin/assets/img/istockphoto-908340438-612x612.jpg'
            if (event.cap_pic) {
              captainPic = `./admin/assets/img/${event.cap_pic}`
            } 
            $('#event-captain-pic').attr('src', captainPic)
            $('#event-captain-fname').text(event.cap_fname)
            $('#event-captain-mname').text(event.cap_mname ? event.cap_mname : "None")
            $('#event-captain-lname').text(event.cap_lname)
            $('#event-captain-gender').text(event.cap_gender ? 'Male' : 'Female')
            $('#event-captain-dob').text(event.cap_dob ? event.cap_dob : 'N/A')
            // END CAPTAIN
          }
        })
      })

      $('#close-modal').click(function(e) {
        $('#view-event-modal').modal('hide')
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
                <h4 class="text-center text-secondary fst-italic">No Events.</h4>
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
                <h4 class="text-center text-secondary fst-italic">No Events.</h4>
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

      // Fetch Events Based On Cities
      function fetchEventsBasedOnCities() {
        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            cityCode: $('#cities').val(),
            action: 'fetchEventsBasedOnCities'
          },
          success: res => {
            let events = JSON.parse(res)
            // console.log(res)

            if (events.length < 1) {
              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Events.</h4>
              `)
              $('#filtering').text(``)
              return;
            }

            let eventsMapped = events.map(event => `
              <tr>
                <td>${event.event_name}</td>
                <td>${event.brgy_desc}</td>
                <td>
                  <button title="View" class="view-event d-block mx-auto btn btn-sm btn-primary" id="view-event-${event.event_id}" data-bs-toggle="modal" data-bs-target="#view-event-modal">
                    View
                  </button>
                </td>
              </tr>
            `)
            let eventsJoined = eventsMapped.join('')
            let eventTable = `
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="events-table">
                  <thead>
                    <tr>
                      <th>Event</th>
                      <th>Barangay</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${eventsJoined}
                  </tbody>
                </table>
              </div>
            `
            $('#data-wrapper').html(eventTable)
            // *******
            // *******
            // Setup - add a text input to each footer cell
            $('#events-table thead tr')
              .clone(true)
              .addClass('filters')
              .appendTo('#events-table thead');

            var table = $('#events-table').DataTable({
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
        fetchEventsBasedOnCities()
      })
    })
  </script>
</body>
</html>