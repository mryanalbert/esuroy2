<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css" />
  <title>Home</title>

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
  <div id="landing-page">
    <!-- <div class="fixed-top">
      <nav class="navbar navbar-expand-lg text-white py-3" data-bs-theme="dark">
        <div class="container">
          <a class="navbar-brand" href="index.php">ESUROY</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item px-3">
                <a class="nav-link active fs-5 link-opacity-100" aria-current="page" href="spots.php">Spots</a>
              </li>
              <li class="nav-item px-3">
                <a class="nav-link active fs-5" aria-current="page" href="brgys.php">Hotels</a>
              </li>
              <li class="nav-item px-3">
                <a class="nav-link active fs-5" aria-current="page" href="events.php">Events</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div> -->

    <div id="carouselExampleCaptions" class="carousel slide">
      <!-- <div class="carousel-indicators">
        <button type="button" style="width:40px;height:6px;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" style="width:40px;height:6px;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" style="width:40px;height:6px;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div> -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img/magpupungko-rock-pools.jpg" style="object-fit:cover;height:100vh;" class="d-block w-100" alt="...">
          <div class="carousel-caption h-100 d-flex justify-content-center align-items-center">
            <div style="transform: translate(0px, 60px);">
              <h1 class="heading">EXPLORE</h1>
              <p class="quote fst-italic">"Magpupungko Rock Pools on Siargao Island."</p>
            </div>  
          </div>
        </div>
        <div class="carousel-item">
          <img src="./img/mountain view black.jpg" style="object-fit:cover;height:100vh;" class="d-block w-100" alt="...">
          <div class="carousel-caption h-100 d-flex justify-content-center align-items-center">
            <div style="transform: translate(0px, 60px);">
              <h1 class="heading">DISCOVER</h1>
              <p class="quote fst-italic">Some representative placeholder content for the first slide.</p>
            </div>  
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/surf black.jpg" style="object-fit:cover;height:100vh;" class="d-block w-100" alt="...">
          <div class="carousel-caption h-100 d-flex justify-content-center align-items-center">
            <div style="transform: translate(0px, 60px);">
              <h1 class="heading">EXPERIENCE</h1>
              <p class="quote fst-italic">Some representative placeholder content for the first slide.</p>
            </div>  
          </div>
        </div>
      </div>
      <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button> -->
    </div>
  </div>

  <div class="bg-dark py-4 d-flex flex-column flex-md-row justify-content-center gap-4 align-items-center">
    <div>
      <label class="text-center d-block text-white mb-2">Region:</label>
      <select id="regions" class="bg-dark form-select" data-bs-theme="dark" style="max-width:190px">
        <option value="">-- Select Region --</option>
      </select>
    </div>
    <div>
      <label class="text-center d-block text-white mb-2">Province:</label>
      <select id="provinces" class="bg-dark form-select" data-bs-theme="dark" style="max-width:190px">
        <option value="">-- Select Province --</option>
      </select>
    </div>
    <div>
      <label class="text-center d-block text-white mb-2">City/Municipality:</label>
      <select id="cities" class="bg-dark form-select" data-bs-theme="dark" style="max-width:260px">
        <option value="">-- Select City/Municipality --</option>
      </select>
    </div>
    <span id="filtering" class="fs-5 text-warning"></span>
  </div>

  <!-- Spots Modal -->
  <div class="modal" id="spots-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-header bg-warning rounded-0">
          <h1 class="modal-title fs-5">Spots</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="spot-modal-wrapper">
          <h3 class="text-center italic text-muted text-secondary">Loading...</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Spot Modal -->
  <div class="modal fade" id="view-spot-modal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content rounded-0">
        <div class="modal-body p-2">
          <h1 id="spot-name" class="my-5 text-center"></h1>
          <div class="spot-img-container">
            <img src="" class="d-block mx-auto w-100 rounded-2" id="spot-img" style="max-width:900px;height:500px;object-fit:cover;" alt="...">
          </div>

          <p class="m-0 mt-3 text-center small text-muted">
            Region:
            <span id="spot-region"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="spot-province"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="spot-city"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="spot-brgy"></span>
          </p>

          <div class="spot-caption-container mx-auto" style="max-width:900px;">
            <p id="spot-caption" class="text-dark-emphasis my-5"></p>
          </div>
          
          <!-- <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
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
          </p> -->
          <a href="#" class="fs-5 d-block my-5 text-center" data-bs-dismiss="modal" id="close-modal-spot">Back</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Hotels Modal -->
  <div class="modal" id="hotels-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-header bg-primary rounded-0">
          <h1 class="modal-title fs-5 text-white">Hotels</h1>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="hotel-modal-wrapper">
          <h3 class="text-center italic text-muted text-secondary">Loading...</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Hotel Modal -->
  <div class="modal fade" id="view-hotel-modal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content rounded-0">
        <div class="modal-body p-2">
          <h1 id="hotel-name" class="my-5 text-center"></h1>
          <div class="hotel-img-container">
            <img src="" class="d-block mx-auto w-100 rounded-2" id="hotel-img" style="max-width:900px;height:500px;object-fit:cover;" alt="...">
          </div>

          <p class="m-0 mt-3 text-center small text-muted">
            Region:
            <span id="hotel-region"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="hotel-province"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="hotel-city"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="hotel-brgy"></span>
          </p>
          <p class="mt-3 text-center small text-muted">
            Offers meal:
            <span id="hotel-offers-meal"></span>
          </p>

          <div class="hotel-caption-container mx-auto" style="max-width:900px;">
            <p id="hotel-caption" class="text-dark-emphasis my-5"></p>
          </div>
          
          <!-- <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
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
          </p> -->
          <a href="#" class="fs-5 d-block my-5 text-center" data-bs-dismiss="modal" id="close-modal-hotel">Back</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Events Modal -->
  <div class="modal" id="events-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-header bg-success rounded-0">
          <h1 class="modal-title fs-5 text-white">Events</h1>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="event-modal-wrapper">
          <h3 class="text-center italic text-muted text-secondary">Loading...</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Event Modal -->
  <div class="modal fade" id="view-event-modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content rounded-0">
        <div class="modal-body p-2">
          <h1 id="event-name" class="my-5 text-center"></h1>
          <!-- <div class="event-img-container">
            <img src="" class="d-block mx-auto w-100 rounded-2" id="event-img" style="max-width:900px;height:500px;object-fit:cover;" alt="...">
          </div> -->

          <p class="m-0 mt-3 text-center small text-muted">
            Region:
            <span id="event-region"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Province:
            <span id="event-province"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            City/Municipality:
            <span id="event-city"></span>
          </p>
          <p class="m-0 text-center small text-muted">
            Barangay:
            <span id="event-brgy"></span>
          </p>

          <div class="event-caption-container mx-auto" style="max-width:900px;">
            <p id="event-caption" class="text-dark-emphasis my-5"></p>
          </div>
          
          <!-- <h1 class="text-center my-3 lead fw-bold">City/Municipality Mayor</h1>
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
          </p> -->
          <a href="#" class="fs-5 d-block my-5 text-center" data-bs-dismiss="modal" id="close-modal-event">Back</a>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div id="data-wrapper" class="py-5 mx-auto" style="max-width:800px;">
      <h4 class="text-center text-secondary fst-italic">No Barangays.</h4>
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
      // SWEETALERT2
      function swal(icon, title, text) {
        Swal.fire({
          icon,
          title,
          text
        })
      }

      const myModal = new bootstrap.Modal('#spots-modal', {
        backdrop: false
      })

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

            $('#regions').val(16).trigger('change')
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
                <h4 class="text-center text-secondary fst-italic">No Barangays.</h4>
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

              $('#provinces').val(1667).trigger('change')
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
                <h4 class="text-center text-secondary fst-italic">No Barangays.</h4>
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
              $('#cities').val(166716).trigger('change')
            }
          })
        })
      }
      fetchCitiesBasedOnProvince($('#provinces'), $('#cities'))

      $('#cities').change(function(e) {
        $('#filtering').text(`Loading...`)
        // fetchHotelsBasedOnCities()
      })

      // Fetch Brgys Based On Cities
      $('#cities').change(function(e) {
        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            cityCode: $('#cities').val(),
            action: 'fetchBrgysBasedOnCities'
          },
          success: res => {
            let brgys = JSON.parse(res)
            // console.log(brgys)

            if (brgys.length < 1) {
              $("#data-wrapper").html(`
                <h4 class="text-center text-secondary fst-italic">No Barangays.</h4>
              `)
              $('#filtering').text(``)
              return;
            }

            let brgysMapped = brgys.map(brgy => `
              <tr class="text-center">
                <td>${brgy.brgy_desc}</td>
                <td>
                  <button class="view-spots btn btn-sm btn-outline-warning" id="spot-${brgy.brgy_id}" data-bs-target="#spots-modal" data-bs-toggle="modal">
                    Spots
                  </button>
                  <button class="view-hotels btn btn-sm btn-outline-primary" id="hotel-${brgy.brgy_id}" data-bs-target="#hotels-modal" data-bs-toggle="modal">
                    Hotels
                  </button>
                  <button class="view-events btn btn-sm btn-outline-success" id="event-${brgy.brgy_id}" data-bs-target="#events-modal" data-bs-toggle="modal">
                    Events
                  </button>
                </td>
              </tr>
            `)
            let brgysJoined = brgysMapped.join('')
            let brgyTable = `
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="brgys-table">
                  <thead>
                    <tr class="text-center">
                      <th>Barangay</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${brgysJoined}
                  </tbody>
                </table>
              </div>
            `
            $('#data-wrapper').html(brgyTable)
            // *******
            // *******
            // Setup - add a text input to each footer cell
            $('#brgys-table thead tr')
              .clone(true)
              .addClass('filters')
              .appendTo('#brgys-table thead');

            var table = $('#brgys-table').DataTable({
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
      })

      // View Spots
      $('body').on('click', '.view-spots', function() {
        let id = $(this).attr('id')
        id = id.substr(5)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            id,
            action: 'fetchSpotsBasedOnCities'
          },
          success: res => {
            let spots = JSON.parse(res)
            // console.log(spots)

            if (spots.length < 1) {
              $('#spot-modal-wrapper').html(`
                <h3 class="text-center fst-italic text-secondary">No Spots.</h3>
              `)
              return
            }

            let spotsMapped = spots.map(spot => `
              <tr>
                <td class="h6 text-secondary">${spot.spot_name}</td>
                <td>
                  <u class="text-primary view-spot" id="view-spot-${spot.spot_id}" data-bs-toggle="modal" data-bs-target="#view-spot-modal" style="cursor:pointer">View</u>
                </td>
              </tr>
            `)

            let spotsMappedJoined = spotsMapped.join('')

            let spotsTable = `
              <table id="spots-table" class="table table-bordered text-center">
                <thead>
                  <th>Spots</th>
                  <th>Action</th>
                </th>
                <tbody>${spotsMappedJoined}</tbody>
              </table>
            `

            $('#spot-modal-wrapper').html(spotsTable)
          }
        })
      })

      // View Spot
      $('body').on('click', '.view-spot', function(e) {
        let spotId = $(this).attr('id')
        spotId = spotId.substr(10)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            spotId,
            action: 'fetchSpot'
          },
          success: res => {
            let spot = JSON.parse(res)
            // console.log(spot)

            $('#spot-name').text(spot.spot_name)
            $('#spot-img').attr('src', `./captain/assets/img/${spot.spot_main_img}`)
            $('#spot-region').text(spot.reg_desc)
            $('#spot-province').text(spot.prov_desc)
            $('#spot-city').text(spot.city_desc)
            $('#spot-brgy').text(spot.brgy_desc)
            $('#spot-caption').html(spot.spot_caption)
          }
        })
      })

      // View Hotels
      $('body').on('click', '.view-hotels', function() {
        let id = $(this).attr('id')
        id = id.substr(6)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            id,
            action: 'fetchHotelsBasedOnCities'
          },
          success: res => {
            let hotels = JSON.parse(res)
            // console.log(hotels)

            if (hotels.length < 1) {
              $('#hotel-modal-wrapper').html(`
                <h3 class="text-center fst-italic text-secondary">No Hotels.</h3>
              `)
              return
            }

            let hotelsMapped = hotels.map(hotel => `
              <tr>
                <td class="h6 text-secondary">${hotel.hotel_name}</td>
                <td class="h6 text-secondary">${hotel.hotel_offers_meal ? 'Yes' : 'No'}</td>
                <td>
                  <u class="text-primary view-hotel" id="view-hotel-${hotel.hotel_id}" data-bs-toggle="modal" data-bs-target="#view-hotel-modal" style="cursor:pointer">View</u>
                </td>
              </tr>
            `)

            let hotelsMappedJoined = hotelsMapped.join('')

            let hotelsTable = `
              <table id="hotels-table" class="table table-bordered text-center">
                <thead>
                  <th>hotels</th>
                  <th>Offes meal</th>
                  <th>Action</th>
                </th>
                <tbody>${hotelsMappedJoined}</tbody>
              </table>
            `

            $('#hotel-modal-wrapper').html(hotelsTable)
          }
        })
      })

      // View Hotel
      $('body').on('click', '.view-hotel', function(e) {
        let hotelId = $(this).attr('id')
        hotelId = hotelId.substr(11)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            hotelId,
            action: 'fetchHotel'
          },
          success: res => {
            let hotel = JSON.parse(res)
            // console.log(hotel)

            $('#hotel-name').text(hotel.hotel_name)
            $('#hotel-img').attr('src', `./captain/assets/img/${hotel.hotel_main_img}`)
            $('#hotel-region').text(hotel.reg_desc)
            $('#hotel-province').text(hotel.prov_desc)
            $('#hotel-city').text(hotel.city_desc)
            $('#hotel-brgy').text(hotel.brgy_desc)
            $('#hotel-offers-meal').text(hotel.hotel_offers_meal ? 'Yes' : 'No')
            $('#hotel-caption').html(hotel.hotel_caption)
          }
        })
      })

      // View Events
      $('body').on('click', '.view-events', function() {
        let eventId = $(this).attr('id')
        eventId = eventId.substr(6)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            eventId,
            action: 'fetchEventsBasedOnCities'
          },
          success: res => {
            let events = JSON.parse(res)
            // console.log(events)

            if (events.length < 1) {
              $('#event-modal-wrapper').html(`
                <h3 class="text-center fst-italic text-secondary">No Events.</h3>
              `)
              return
            }

            let eventsMapped = events.map(event => `
              <tr>
                <td class="h6 text-secondary">${event.event_name}</td>
                <td>
                  <u class="text-primary view-event" id="view-event-${event.event_id}" data-bs-toggle="modal" data-bs-target="#view-event-modal" style="cursor:pointer">View</u>
                </td>
              </tr>
            `)

            let eventsMappedJoined = eventsMapped.join('')

            let eventsTable = `
              <table id="events-table" class="table table-bordered text-center">
                <thead>
                  <th>events</th>
                  <th>Action</th>
                </th>
                <tbody>${eventsMappedJoined}</tbody>
              </table>
            `

            $('#event-modal-wrapper').html(eventsTable)
          }
        })
      })

      // View Event
      $('body').on('click', '.view-event', function(e) {
        let eventId = $(this).attr('id')
        eventId = eventId.substr(11)

        $.ajax({
          url: './admin/assets/php/action.php',
          method: 'post',
          data: {
            eventId,
            action: 'fetchEvent'
          },
          success: res => {
            let event = JSON.parse(res)
            // console.log(event)

            $('#event-name').text(event.event_name)
            $('#event-region').text(event.reg_desc)
            $('#event-province').text(event.prov_desc)
            $('#event-city').text(event.city_desc)
            $('#event-brgy').text(event.brgy_desc)
            $('#event-caption').html(event.event_caption)
          }
        })
      })
    })
  </script>
</body>
</html>