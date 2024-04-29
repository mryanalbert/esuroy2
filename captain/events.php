<?php require_once './assets/php/header.php'; ?>
<main>
  <div class="container-fluid">
    <h1>Events</h1>
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

    <button class="btn btn-primary btn-sm mt-3 d-block" data-bs-toggle="modal" data-bs-target="#add-event-modal">Add Event</button>

    <!-- Add Event Modal -->
    <div class="modal fade" id="add-event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Add Event</h1>
            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-event-form">
              <input type="hidden" name="brgyId" value="<?=$brgyId?>">
              <label class="form-label h4">Event Name:</label>
              <input type="text" name="event-name" class="form-control mb-2" style="width: 320px;" required>

              <label class="form-label h4 mt-3 mb-3">Event body content:</label>
              <textarea name="event-content" id="event-content" class="form-control" cols="30" rows="10"></textarea>
              
              <input type="submit" id="add-event-btn" class="btn btn-primary d-block mx-auto mt-4" value="Add Event">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="edit-event-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Event</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit-event-form">
              <input type="hidden" name="edit-id" id="edit-id">
              <label class="form-label h4">Event Name:</label>
              <input type="text" name="edit-event-name" id="edit-event-name" class="form-control mb-2" required>
                 
              <label class="form-label h4 mt-3 mb-3">Event body content:</label>
              <textarea name="edit-event-content" id="edit-event-content" class="form-control" cols="30" rows="10"></textarea>

              <input type="submit" id="update-event-btn" class="btn btn-warning d-block mx-auto mt-4" value="Update Event">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card rounded-0 shadow-sm mt-5">
          <div class="card-header bg-primary rounded-0">
            <span class="fs-5 text-white">Events</span>
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
    function swal(icon, title, text) {
      Swal.fire({
        icon,
        title,
        text
      })
    }

    // Summernote rich text editor
    $('#event-content').summernote({
      height: 600
    })
    $('#edit-event-content').summernote({
      height: 600
    })

    // Fetch Events
    function fetchEvents() {
      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          brgyId: '<?= $brgyId ?>',
          action: 'fetchEvents'
        },
        success: res => {
          let events = JSON.parse(res)
          // console.log(events)

          if (events.length < 1) {
            $("#data-wrapper").html(`
              <h4 class="text-center text-secondary fst-italic">No Events.</h4>
            `)
            return;
          }

          let eventsMapped = events.map(event => `
            <tr>
              <td>${event.event_name}</td>
              <td>
                <a href="#" title="Edit" class="edit-event text-decoration-none" id="edit-event-${event.event_id}" data-bs-toggle="modal" data-bs-target="#edit-event-modal">
                  <i class="bi bi-pencil-square text-warning fs-5"></i>
                </a>
                <a href="#" title="Delete" class="del-event text-decoration-none" id="del-event-${event.event_id}">
                  <i class="bi bi-trash-fill text-danger fs-5"></i>
                </a>
              </td>
            </tr>
          `)
          let eventsJoined = eventsMapped.join('')
          let eventTable = `
            <table class="table table-striped table-bordered w-100" id="events-table">
              <thead>
                <tr>
                  <th>Event</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                ${eventsJoined}
              </tbody>
            </table>
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
    fetchEvents()

    // Add Event
    $('#add-event-btn').click(function(e) {
      if ($('#add-event-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Adding Event...')
        $(this).prop('disabled', true)

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          data: $('#add-event-form').serialize() + '&action=addEvent',
          success: res => {
            // console.log(res)

            if (res === '1') {
              swal('success', 'Added!', 'Event was successfully added.')
              $('#add-event-form')[0].reset()
              $('#add-event-modal').modal('hide')
              $('.note-editable').html('<p><br></p>')
              fetchEvents()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#add-event-btn').val('Add Event')
            $('#add-event-btn').prop('disabled', false)
          }
        })
      }
    })

    // Delete Event
    $('body').on('click', '.del-event', function(e) {
      let eventId = $(this).attr('id')
      eventId = eventId.substring(10)

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
              action: 'delEvent',
              eventId
            },
            success: function(res) {
              // console.log(res)
              if (res === '1') {
                fetchEvents()
                swal('success', 'Deleted!', 'Event was successfully deleted.')
              } else {
                swal('error', 'Oops!', 'Something went wrong, try again.')
              }
            }
          })
        }
      })
    })

    // Edit Event
    $('body').on('click', '.edit-event', function(e) {
      let eventId = $(this).attr('id')
      eventId = eventId.substring(11)

      $.ajax({
        url: './assets/php/action.php',
        method: 'post',
        data: {
          eventId,
          action: 'fetchEvent'
        },
        success: res => {
          let event = JSON.parse(res)
          // console.log(event)

          $('#edit-id').val(event.event_id)
          $('#edit-event-name').val(event.event_name)
          $('#edit-event-content').summernote('code', event.event_caption)
        }
      })
    })

    // Update Event
    $('#update-event-btn').click(function(e) {
      if ($('#edit-event-form')[0].checkValidity()) {
        e.preventDefault()

        $(this).val('Updating Event...')
        $(this).prop('disabled', true)

        $.ajax({
          url: './assets/php/action.php',
          method: 'post',
          data: $('#edit-event-form').serialize() + '&action=updateEvent',
          success: res => {
            // console.log(res)

            if (res === '1') {
              swal('success', 'Updated!', 'Event was successfully updated.')
              $('#edit-event-modal').modal('hide')
              $('#edit-event-form')[0].reset()
              $('.note-editable').html('<p><br></p>')
              fetchEvents()
            } else {
              swal('error', 'Oops...', 'Something went wrong, please try again.')
            }
            $('#update-event-btn').val('Update Event')
            $('#update-event-btn').prop('disabled', false)
          }
        })
      }
    })
  })
</script>