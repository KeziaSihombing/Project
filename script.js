$(()=>{
    const calendarElm = $('.calendar');
    const calendarEl = $('#calendar')[0];
    const navigationElm = $('.navigation');
    
    for (i = new Date().getFullYear(); i < 2035; i++)
    {
        $('#year').append($('<option />').val(i).html(i));
    }

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: false,

        navLinks: false,
        height: 'auto',
      
        datesSet: function() {
          $('td[role="gridcell"]').off('click').on('click', function() {
            const dataDate = $(this).attr('data-date');
            const events = calendar.getEvents().filter(event => event.startStr === dataDate);
      
            if (events.length > 0) {
              $(this).attr({
                'data-toggle': 'collapse',
                'data-target': '#info-show',
                'aria-controls': 'info-show',
                'aria-expanded': 'false',
                'aria-label': 'show information'
              });
              $('.calendar').addClass('blur');
              $('button').not('.btn-close').attr('disabled', true);
              $('select').attr('disabled', true);
              
              $('.selectedDate').text(dataDate);
              const selectedDiaries = diaries.filter(diary => diary.date === dataDate);
              let diaryHTML = '';
              selectedDiaries.forEach(diary => {
                    diaryHTML += `
                        <div class="row list-diary my-3">
                            <div class="col-3">
                                <img src="./images/${diary.cat_img}" class="pet-photo">
                            </div>
                            <div class="col-5 h3">${diary.name}</div>
                        </div>
                    `;
              });              
              
              $('.list-container').html(diaryHTML);              

            } else {
              $(this).removeAttr('data-toggle data-target aria-controls aria-expanded aria-label');    
            }
          });
        },
        events : diaries.map(item => ({
          id: item.date,
          title: item.name,
          start: item.date,
          allDay: true,
        })),
      });      
    calendar.render();


    function updateCurrentMonth() {
      const currentDate = calendar.getDate();
      const formattedMonth = currentDate.toLocaleDateString('id-ID', {
        month: 'long'
      });
      const formattedYear = currentDate.toLocaleDateString('id-ID', {
        year: 'numeric'
      })      
      $('#month').text(formattedMonth);
      $('#currentYear').text(formattedYear);
      $('#currentYear').val(formattedYear);
    }
    updateCurrentMonth();

    
    $('select').on('change', function (){
        const selectedYear = parseInt($('#year').val(), 10);
        const currentDate = calendar.getDate();
        const currentMonth = currentDate.getMonth();
        const selectedDate = new Date(selectedYear, currentMonth, 1);

        calendar.gotoDate(selectedDate);
        $('#currentYear').text(selectedYear);
        $('#currentYear').val(selectedYear);

        $('#year').empty();

        const currentYear = $('<option />', {
            id : 'currentYear',
            value : selectedYear.toString()
        }).html(selectedYear);
        $('#year').append(currentYear);

        for (i = selectedYear-5; i < selectedYear+5; i++)
        {
            $('#year').append($('<option />').val(i).html(i));
        }
    });


    $('#next-button').on('click', function () {
      calendar.next();
      updateCurrentMonth();
    });

    $('#prev-button').on('click', function () {
      calendar.prev();
      updateCurrentMonth();
    });

    $('.btn-close').on('click', function () {
      $('.calendar').removeClass('blur');
      $('td[role="gridcell"]').removeAttr('data-toggle data-target aria-controls aria-expanded aria-label');
      $('button').attr('disabled', false);
      $('select').attr('disabled', false);
    });

});