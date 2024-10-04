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

/* Ajouter la hauteur des cellules du samedi après-midi si nécessaire */
.timetable-cell[data-day="6"][data-hour="13"],
.timetable-cell[data-day="6"][data-hour="14"],
.timetable-cell[data-day="6"][data-hour="15"],
.timetable-cell[data-day="6"][data-hour="16"],
.timetable-cell[data-day="6"][data-hour="17"] {
    display: none;
}

    /* Ajustements pour la modale et le calendrier */
    .modal-dialog.modal-lg {
        max-width: 95%;
        width: 95%;
        margin: 1.75rem auto;
    }

    .modal-content {
        height: 90vh;
        display: flex;
        flex-direction: column;
    }

    .modal-body {
        flex-grow: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    #timetable {
        width: 100%;
        overflow-x: auto;
    }

    .timetable {
        min-width: 1000px;
        grid-template-columns: auto repeat(6, minmax(150px, 1fr));
    }

    .timetable-cell, .timetable-hour, .timetable-header {
        padding: 5px;
        font-size: 0.85rem;
    }

    .timetable-hour {
        white-space: nowrap;
    }

    .timetable-event {
        font-size: 0.75rem;
    }

  </style>

<div class="row" id="class-list">
    @foreach ($classes as $class)
    <div class="col-md-4 mb-3 class-item" data-level="{{ $class->level }}">
        <div class="card shadow-sm text-center position-relative">
            <div class="dropdown position-absolute top-0 start-0 m-2">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: black;">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $class->id }}" style="background-color: white;" data-class-id="{{ $class->id }}">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-eye"></i> View</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-edit"></i> Edit</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-trash"></i> Delete</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#calendarModal{{ $class->id }}" style="cursor:pointer;"><i class="fas fa-calendar-alt"></i> Calendrier</a></li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-calendar-alt me-2 text-info"></i>{{ $class->school_year }}
                </h5>
                <p class="card-text" style="color: black">
                    <i class="fas fa-graduation-cap me-2 text-success"></i><strong>Class Name:</strong> {{ $class->grade_level }} {{ $class->class_name }}<br>
                </p>
            </div>
        </div>
    </div>

        <!-- View Modal -->
        <div class="modal fade" id="viewModal{{ $class->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $class->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-white">
                        <h5 class="modal-title" id="viewModalLabel{{ $class->id }}">
                            <i class="fas fa-eye me-2"></i>Détails de la classe
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-3">
                                    <i class="fas fa-chalkboard me-2 text-primary"></i>
                                    <strong>Nom de la classe :</strong> {{ $class->class_name }}
                                </p>
                                <p class="mb-3">
                                    <i class="fas fa-graduation-cap me-2 text-success"></i>
                                    <strong>Niveau :</strong> {{ $class->grade_level }}
                                </p>
                                <p class="mb-3">
                                    <i class="fas fa-calendar-alt me-2 text-info"></i>
                                    <strong>Année scolaire :</strong> {{ $class->school_year }}
                                </p>
                                <p class="mb-3">
                                    <i class="fas fa-door-open me-2 text-warning"></i>
                                    <strong>Salle de classe :</strong> {{ $class->classroom }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $class->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white text-white">
                <h5 class="modal-title" id="editModalLabel{{ $class->id }}">
                    <i class="fas fa-edit me-2"></i>Modifier la classe
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('classes.update', $class->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="class_name" class="form-label">
                            <i class="fas fa-chalkboard me-2 text-primary"></i>Nom de la classe
                        </label>
                        <select id="class_name" class="form-select @error('class_name') is-invalid @enderror" name="class_name" required>
                            <option value="">Sélectionner le nom de la classe</option>
                            @foreach(range('A', 'Z') as $letter)
                                <option value="{{ $letter }}" {{ $class->class_name == $letter ? 'selected' : '' }}>{{ $letter }}</option>
                            @endforeach
                        </select>
                        @error('class_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="grade_level" class="form-label">
                            <i class="fas fa-graduation-cap me-2 text-success"></i>Niveau
                        </label>
                        <select id="grade_level" class="form-select @error('grade_level') is-invalid @enderror" name="grade_level" required>
                            <option value="">Sélectionner le niveau</option>
                            @foreach(['1er année', '2éme année', '3éme année', '4éme année', '5éme année', '6éme année'] as $grade)
                                <option value="{{ $grade }}" {{ $class->grade_level == $grade ? 'selected' : '' }}>{{ $grade }}</option>
                            @endforeach
                        </select>
                        @error('grade_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="school_year" class="form-label">
                            <i class="fas fa-calendar-alt me-2 text-info"></i>Année scolaire
                        </label>
                        <select id="school_year" class="form-select @error('school_year') is-invalid @enderror" name="school_year" required>
                            <option value="">Sélectionner l'année scolaire</option>
                            @for ($year = 2024; $year <= 2050; $year++)
                                <?php $nextYear = $year + 1; ?>
                                <option value="{{ $year }}/{{ $nextYear }}" {{ $class->school_year == "$year/$nextYear" ? 'selected' : '' }}>
                                    {{ $year }}/{{ $nextYear }}
                                </option>
                            @endfor
                        </select>
                        @error('school_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="classroom" class="form-label">
                            <i class="fas fa-door-open me-2 text-warning"></i>Salle de classe
                        </label>
                        <input type="text" class="form-control @error('classroom') is-invalid @enderror" id="classroom" name="classroom" value="{{ old('classroom', $class->classroom) }}" placeholder="Salle de classe" required>
                        @error('classroom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal{{ $class->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $class->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-white text-white">
                        <h5 class="modal-title" id="deleteModalLabel{{ $class->id }}">
                            <i class="fas fa-trash-alt me-2"></i>Supprimer la classe
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Attention ! Cette action est irréversible.
                        </div>
                        <p>Êtes-vous sûr de vouloir supprimer la classe <strong>{{ $class->grade_level }} {{ $class->class_name }}</strong> ?</p>
                        <p>Année scolaire : <strong>{{ $class->school_year }}</strong></p>
                        <p>Salle de classe : <strong>{{ $class->classroom }}</strong></p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('classes.destroy', $class) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Annuler
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- Nouvelle fenêtre modale pour le calendrier -->
    <div class="modal fade" id="calendarModal{{ $class->id }}" tabindex="-1" aria-labelledby="calendarModalLabel{{ $class->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel{{ $class->id }}">
                        <i class="fas fa-calendar-alt me-2"></i>Calendrier de la classe {{ $class->grade_level }} {{ $class->class_name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div id="timetable" class="timetable">
                        <div class="timetable-corner"></div>
                        <div class="timetable-header" data-day="1">Lundi</div>
                        <div class="timetable-header" data-day="2">Mardi</div>
                        <div class="timetable-header" data-day="3">Mercredi</div>
                        <div class="timetable-header" data-day="4">Jeudi</div>
                        <div class="timetable-header" data-day="5">Vendredi</div>
                        <div class="timetable-header" data-day="6">Samedi</div>
                        @for ($hour = 8; $hour < 18; $hour++)
                            <div class="timetable-hour" data-hour="{{ $hour }}">
                                <span class="badge badge-sm text-dark font-weight-bolder">
                                    {{ sprintf('%02d:00 - %02d:00', $hour, $hour + 1) }}
                                </span>
                            </div>
                            @if ($hour == 12)
                                <div class="navbarText timetable-cell timetable-pause">Pause</div>
                            @else
                                @for ($day = 1; $day <= 6; $day++)
                                    <div class="navbarText timetable-cell" data-day="{{ $day }}" data-hour="{{ $hour }}"></div>
                                @endfor
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function () {
      const urlPath = window.location.pathname;
      const userId = urlPath.split('/')[2];

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

function loadTimetable(classId) {
    $.ajax({
        url: '/classes/' + classId + '/schedule',
        method: 'GET',
        success: function (response) {
            $('.timetable-event').remove();

            if (Array.isArray(response)) {
                response.forEach(function (event) {
                    let dayIndex = getDayIndex(event.day);
                    let startTime = parseInt(event.start.split(':')[0]);
                    let endTime = parseInt(event.end.split(':')[0]);
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
                console.error('La réponse n\'est pas un tableau');
            }
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors du chargement de l'emploi du temps:", error);
        }
    });
}

// Utilisons la délégation d'événements pour gérer les clics sur les boutons "Calendrier"
$(document).on('click', '[data-bs-target^="#calendarModal"]', function() {
    const classId = $(this).closest('.dropdown-menu').data('class-id');
    if (classId) {
        loadTimetable(classId);
    } else {
        console.error("ID de classe non trouvé");
    }
});

function disableSaturdayAfternoon() {
    const saturdayColumn = $('.timetable-cell[data-day="6"]');
    const disabledCell = $('<div>', {
        class: 'disabled-cell',
    });
    
    const startCell = saturdayColumn.filter('[data-hour="13"]');
    startCell.after(disabledCell);
    
    saturdayColumn.filter(function() {
        const hour = $(this).data('hour');
        return hour >= 13 && hour < 18;
    }).hide();
}

// Appelons disableSaturdayAfternoon lorsque le modal du calendrier est affiché
$(document).on('shown.bs.modal', '[id^="calendarModal"]', function () {
    disableSaturdayAfternoon();
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

      // Ajustez le z-index de la modale
      $('.modal').on('show.bs.modal', function (event) {
          var idx = $('.modal:visible').length;
          $(this).css('z-index', 1040 + (10 * idx));
      });
      $('.modal').on('shown.bs.modal', function (event) {
          var idx = ($('.modal:visible').length) - 1;
          $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
          $('.modal-backdrop').not('.stacked').addClass('stacked');
      });
    });

    function getDayName(dayNumber) {
      const days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
      return days[dayNumber - 1]; 
    }

    // Fonction pour afficher les détails de l'événement (à implémenter si nécessaire)
    function showEventDetails(eventData) {
        console.log('Détails de l\'événement:', eventData);
        // Implémentez ici la logique pour afficher les détails de l'événement
    }
  </script>
