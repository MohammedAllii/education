<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <title>Education</title>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .fc-day-number {
      text-align: left;
    }
    .center-image {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
    #calendar {
      max-width: 800px;
      margin: 40px auto;
    }
    .timetable {
      display: grid;
      grid-template-columns: auto repeat(6, 1fr);
      grid-auto-rows: 40px;
      gap: 1px;
      background-color: #ddd;
    }
    .timetable-corner,
    .timetable-header,
    .timetable-hour {
      background-color: #f0f0f0;
      text-align: center;
      padding: 5px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .timetable-header:hover,
    .timetable-hour:hover {
      background-color: #e0e0e0;
    }
    .timetable-cell {
      background-color: #fff;
      border: 1px solid #ccc;
      cursor: pointer;
      position: relative;
    }
    .timetable-cell:hover {
      background-color: #f9f9f9;
    }
    .timetable-event {
      background-color: #2e778f;
      color: white;
      text-align: center;
      padding: 5px;
      margin: 2px;
      border-radius: 10px;
      position: absolute;
      width: calc(100% - 4px);
      height: calc(100% - 4px);
      left: 0;
      top: 0;
    }

    .form-row {
  display: flex;
  justify-content: space-between; 
}

.timetable-pause {
    background-color: #a8a7a7;
    color: white;
    text-align: center;
    border-radius: 10px;
    font-weight: bold;
    line-height: 40px;
    pointer-events: none;
    grid-column: 2 / span 6;
  }


.card {
  border-radius: 0.5rem;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.modal-body {
  padding: 1.5rem;
}

.modal-footer .btn {
  border-radius: 0.5rem;
}

.timetable-event {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 5px;
    font-size: 15px;
    line-height: 1.2;
}

.timetable-event .classroom {
    align-self: flex-end;
    font-size: 13px;
    font-style: italic;
}

.disabled-cell {
    background-color: #f0f0f0;
    grid-row: span 5;
    display: flex;
    justify-content: center;
    align-items: center;
    writing-mode: vertical-rl;
    text-orientation: mixed;
    transform: rotate(180deg);
    font-weight: bold;
    color: #999;
    border: 1px solid #ddd;
}

.disabled-cell:hover {
    background-color: #f0f0f0;
}

/* Ajuster la hauteur des cellules du samedi après-midi si nécessaire */
.timetable-cell[data-day="6"][data-hour="13"],
.timetable-cell[data-day="6"][data-hour="14"],
.timetable-cell[data-day="6"][data-hour="15"],
.timetable-cell[data-day="6"][data-hour="16"],
.timetable-cell[data-day="6"][data-hour="17"] {
    display: none;
}

  </style>
</head>

<body class="g-sidenav-show bg-gray-200">
  @include('layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbar">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="navbarText font-weight-bolder mb-0">Dashboard / Teachers Management</h6>
        </nav>
        @guest
        @else
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span><img src="{{ asset('user.png') }}" alt="profile_image" id="navbarImage"> {{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
          </li>
        </ul>
        @endguest
      </div>
    </nav>

    <div class="container">
      <h3 class="navbarText font-weight-bolder mb-0" style="text-align: center;"><span class="badge badge-sm text-white" style="background-color: #5999af;margin:20px">Calendrier de l'enseignant(e)<span style="color: black"> {{ $teacher->name }}</span></span></h3>
      <div id="timetable" class="timetable">
        <div class="timetable-corner"></div>
        <div class="timetable-header" data-day="1" style="color: black">Lundi</div>
        <div class="timetable-header" data-day="2" style="color: black">Mardi</div>
        <div class="timetable-header" data-day="3" style="color: black">Mercredi</div>
        <div class="timetable-header" data-day="4" style="color: black">Jeudi</div>
        <div class="timetable-header" data-day="5" style="color: black">Vendredi</div>
        <div class="timetable-header" data-day="6" style="color: black">Samedi</div>
        @for ($hour = 8; $hour < 18; $hour++)
          <div class="timetable-hour" data-hour="{{ $hour }}" ><span class="badge badge-sm text-dark font-weight-bolder" style="font-size: 14px;">{{ sprintf('%02d:00 - %02d:00', $hour, $hour + 1) }}</span></div>
          @if ($hour == 12)
            <div class="navbarText timetable-cell timetable-pause" style="font-weight:bold">Pause</div>
          @else
            @for ($day = 1; $day <= 6; $day++)
              <div class="navbarText timetable-cell" data-day="{{ $day }}" data-hour="{{ $hour }}"style="font-weight:bold;font-size:20px" ></div>
            @endfor
          @endif
        @endfor
      </div>
    </div>

    <!-- Assurez-vous d'inclure Font Awesome dans votre <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Modal pour les détails de l'événement -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title" id="eventDetailsModalLabel"><i class="fas fa-calendar-alt mr-2"></i>Détails de l'événement</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <div class="text-center mb-4">
              <div class="class-icon mb-2">
                <img src="{{ asset('classe.png') }}" alt="profile_image" style="width: 60px; height: 60px;">
              </div>
              <h5>
                <span id="event-class"></span>
              </h5>
            </div>
            <h5><i class="fas fa-door-open mr-2"></i><strong style="color: black">Salle:</strong> <span id="event-classroom"></span></h5>
            <h5><i class="far fa-calendar mr-2"></i><strong style="color: black">Jour:</strong> <span id="event-day"></span></h5>
            <div class="time-range d-flex align-items-center justify-content-center">
              <div class="time-item">
                <img src="{{ asset('start.png') }}" alt="Début" style="width: 30px; height: 30px;">
                <span id="event-start-time" style="color: black;font-weight:bold;"></span>
              </div>
              <img src="{{ asset('fleche.png') }}" alt="Flèche" style="width: 30px; height: 30px; margin: 0 15px;">
              <div class="time-item">
                <img src="{{ asset('end.png') }}" alt="Fin" style="width: 30px; height: 30px;">
                <span id="event-end-time" style="color: black;font-weight:bold;"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Fermer</button>
        <button type="button" class="btn btn-danger" id="delete-event"><i class="fas fa-trash-alt mr-2"></i>Supprimer</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal pour créer un nouvel événement -->
<div class="modal fade" id="classModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-white text-white">
        <h5 class="modal-title" id="classModalLabel"><i class="fas fa-plus-circle mr-2"></i>Créer un horaire de classe</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="classForm">
          <div class="form-group">
            <label for="class-name"><i class="fas fa-chalkboard mr-2"></i>Nom de la classe</label>
            <select class="form-control" id="class-name" required style="border: 1px solid;padding:10px;height:50px"></select>
          </div>
          <div class="form-group">
            <label for="day"><i class="far fa-calendar-alt mr-2"></i>Jour</label>
            <input type="text" class="form-control" id="day" readonly>
          </div>
            <div class="form-group">
              <label for="start-time"><i class="far fa-clock mr-2"></i>Heure de début</label>
              <input type="text" class="form-control" id="start-time" readonly>
            </div>
            <div class="form-group">
              <label for="end-time"><i class="far fa-clock mr-2"></i>Heure de fin</label>
              <input type="text" class="form-control" id="end-time" readonly>
            </div>
          
          <input type="hidden" id="user-id">
          <button type="submit" class="btn btn-dark btn-block"><i class="fas fa-save mr-2"></i>Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
</div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script>
    $(document).ready(function () {
      const urlPath = window.location.pathname;
      const userId = urlPath.split('/')[2];

      function loadModalData(day, startTime, endTime) {
        $.ajax({
          url: '/get-teacher-data',
          method: 'GET',
          data: { user_id: userId },
          success: function (response) {
            let classOptions = '';
            response.classes.forEach(function (classData) {
              classOptions += `<option value="${classData.id}">${classData.grade_level} ${classData.class_name}</option>`;
            });
            $('#class-name').html(classOptions);
            $('#user-id').val(response.user_id);
            $('#day').val(getDayName(day));
            $('#start-time').val(moment(startTime, 'H:mm').format('HH:mm'));
            $('#end-time').val(moment(endTime, 'H:mm').format('HH:mm'));

          },
          error: function (error) {
            console.error('Error fetching data:', error);
          }
        });
      }

      function getDayIndex(day) {
    const daysMap = {
        'Lundi': 1,
        'Mardi': 2,
        'Mercredi': 3,
        'Jeudi': 4,
        'Vendredi': 5,
        'Samedi': 6,
    };
    
    return daysMap[day] || 0; 
}

function loadTimetable() {
    $.ajax({
        url: '/teachers/' + userId + '/schedule',
        method: 'GET',
        success: function (response) {
            $('.timetable-event').remove();

            if (Array.isArray(response)) {
                response.forEach(function (event) {
                    let dayIndex = getDayIndex(event.day);
                    let startTime = moment(event.start, 'HH:mm:ss').hour();
                    let endTime = moment(event.end, 'HH:mm:ss').hour();
                    let duration = endTime - startTime;
                    let cell = $(`.timetable-cell[data-day="${dayIndex}"][data-hour="${startTime}"]`);

                    let eventDiv = $('<div>', {
                        class: 'timetable-event',
                        html: `<div>${event.title}</div><div class="classroom">Salle :${event.classroom}</div>`,
                        css: {
                            height: (cell.height() * duration) + 'px'
                        },
                        data: {
                            eventId: event.id,
                            classId: event.class_id,
                            className: event.title,
                            classRoom: event.classroom,
                            day: event.day,
                            startTime: event.start,
                            endTime: event.end
                        }
                    });

                    eventDiv.on('click', function(e) {
                        e.stopPropagation(); 
                        showEventDetails($(this).data());
                    });

                    cell.append(eventDiv);
                });
            } else {
                console.error('Response is not an array');
            }
        },
    });
}

function showEventDetails(eventData) {
    $('#event-class').text(eventData.className);
    $('#event-classroom').text(eventData.classRoom);
    $('#event-day').text(eventData.day);
    $('#event-start-time').text(eventData.startTime);
    $('#event-end-time').text(eventData.endTime);
    $('#delete-event').data('eventId', eventData.eventId);
    $('#eventDetailsModal').modal('show');
}

$('#delete-event').on('click', function() {
        const eventId = $(this).data('eventId');
        if (eventId === undefined) {
            console.error('L\'ID de l\'événement est indéfini');
            return;
        }
        $.ajax({
            url: '/delete-schedule/' + eventId, 
            method: 'POST', 
            data: {
                _method: 'DELETE', 
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#eventDetailsModal').modal('hide'); 
                Toastify({
                    text: "L'événement a été supprimé avec succès",
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
                loadTimetable(); 
            },
            error: function(xhr, status, error) {
                Toastify({
                    text: "Erreur lors de la suppression de l'événement",
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                }).showToast();
                console.error('Erreur de suppression de l\'événement:', error);
            }
        });
    });




      $('.timetable-cell').on('click', function () {
        if (!$(this).hasClass('timetable-pause') && !$(this).hasClass('disabled-cell')) {
          const day = $(this).data('day');
          const hour = $(this).data('hour');
          const startTime = formatTime(hour);
          const endTime = formatTime(hour + 1);
          loadModalData(day, startTime, endTime);
          $('#classModal').modal('show');
        }
      });

      function formatTime(hour) {
        return `${hour}:00`;
      }

      $('#classForm').on('submit', function (e) {
        e.preventDefault();
        const classId = $('#class-name').val();
        const day = $('#day').val();
        const startTime = $('#start-time').val();
        const endTime = $('#end-time').val();
        
        $.ajax({
          url: '/save-schedule',
          method: 'POST',
          data: {
            class_id: classId,
            user_id: $('#user-id').val(),
            day: day,
            start_time: startTime,
            end_time: endTime,
            _token: '{{ csrf_token() }}' 
          },
          success: function (response) {
            $('#classModal').modal('hide');
            Toastify({
              text: "Schedule saved successfully!",
              backgroundColor: "green",
            }).showToast();
            loadTimetable();
          },
          error: function (xhr, status, error) {
            console.error('Error saving schedule:', xhr.responseText);
            Toastify({
              text: "Failed to save schedule: " + xhr.responseText,
              backgroundColor: "red",
            }).showToast();
          }
        });
      });

      // Fonction pour désactiver les cellules du samedi après-midi
      function disableSaturdayAfternoon() {
          const saturdayColumn = $('.timetable-cell[data-day="6"]');
          const disabledCell = $('<div>', {
              class: 'disabled-cell',
          });
          
          // Trouver la cellule de 13h00 le samedi
          const startCell = saturdayColumn.filter('[data-hour="13"]');
          startCell.after(disabledCell);
          
          // Cacher les cellules individuelles de 13h00 à 17h00
          saturdayColumn.filter(function() {
              const hour = $(this).data('hour');
              return hour >= 13 && hour < 18;
          }).hide();
      }

      // Appeler la fonction au chargement de la page
      disableSaturdayAfternoon();

      loadTimetable();
    });

    function getDayName(dayNumber) {
      const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
      return days[dayNumber - 1]; 
    }
  </script>
</body>

</html>