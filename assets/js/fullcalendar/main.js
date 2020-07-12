$(function(){

    var currentDate;
    var currentEvent;
    //var base_url='http://localhost/kdr/';
    var base_url= window.location.origin + '/kdr/';

    // Fullcalendar
    $('#calendar').fullCalendar(
    {
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: 'month, basicWeek, basicDay'
        },

        // Get all events stored in database
        eventLimit: true,
        events: base_url+'kdr/kegiatan/kegiatanStaff',
        selectable: true,
        selectHelper: true,
        editable: true,        
        select: function(start, end) 
        {        
            $('#start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));

            modal({
                buttons: {
                    add: {
                        id: 'add-event',
                        css: 'btn-success',
                        label: 'Tambah Kegiatan'
                    }
                },
                title: 'Tambah Data Kegiatan'
            });
        }, 
           
        /*eventDrop: function(event, delta, revertFunc,start,end) 
        {     
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end)
            {
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }
            else
            {
                end = start;
            }         
                       
            $.post(base_url+'kdr/kegiatan/dragUpdateKegiatan',{                            
                id:event.id_kegiatan,
                tgl_pelaksanaan : start,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Kegiatan berhasil diupdate');
                hide_notify();
            });
        },

        eventResize: function(event,dayDelta,minuteDelta,revertFunc) 
        {             
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if(event.end)
            {
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            }
            else
            {
                end = start;
            }         
                       
            $.post(base_url+'kdr/kegiatan/dragUpdateKegiatan',{                            
                id:event.id_kegiatan,
                tgl_pelaksanaan : start,
                start : start,
                end :end
            }, function(result){
                $('.alert').addClass('alert-success').text('Kegiatan berhasil diupdate');
                hide_notify();
            });
        },*/
          
        // Event Mouseover
        eventMouseover: function(calEvent, jsEvent, view)
        {
            var tooltip = '<div class="event-tooltip">' + calEvent.title + '</div>';
            $("body").append(tooltip);

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.event-tooltip').fadeIn('500');
                $('.event-tooltip').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.event-tooltip').css('top', e.pageY + 10);
                $('.event-tooltip').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.event-tooltip').remove();
        },

        // Handle Existing Event Click
        eventClick: function(calEvent, jsEvent, view) {
            currentEvent = calEvent;
            $("#user_modified").val(calEvent.user_modified); 

            //Hanya muncul ketika inputan bukan berasal dari adminkdr
            //1 = adminkdr, 0 = staffkdr
            if (calEvent.user_modified === "0") {
                modal({
                    // Available buttons when editing
                    buttons: {
                        delete: {
                            id: 'delete-event',
                            css: 'btn-danger',
                            label: 'Delete'
                        },
                        update: {
                            id: 'update-event',
                            css: 'btn-success',
                            label: 'Update'
                        }
                    },
                    //title: 'Edit Event "' + calEvent.agenda + '"',
                    title: 'Edit Data Kegiatan',
                    event: calEvent
                });
            }
            else {
                modal({
                    title: 'Edit Data Kegiatan',
                    event: calEvent
                });
            }
        }   
    });
    
    // Prepares the modal window according to data passed
    function modal(data) {
        // Set modal title
        $('.modal-title').html(data.title);
        
        // Clear buttons except Cancel
        $('.modal-footer button:not(".btn-default")').remove();
        
        // Set input values 
        $('#no_surat').val(data.event ? data.event.no_surat : ''); 
        $('#agenda').val(data.event ? data.event.agenda : ''); 
        $('#tempat').val(data.event ? data.event.tempat : '');  
        $('#kategori').val(data.event ? data.event.kategori : ''); 
        $('#subkategori').val(data.event ? data.event.sub_kategori : ''); 
        //$('#tgl_pelaksanaan').val(data.event ? moment(data.event.start).format('DD-MM-YYYY') : ''); 
        //$('#tgl_berakhir').val(data.event ? moment(data.event.end).format('DD-MM-YYYY') : ''); 
        
        // Create Butttons
        $.each(data.buttons, function(index, button)
        {
            $('.modal-footer').prepend('<button type="button" id="' + button.id  + '" class="btn ' + button.css + '">' + button.label + '</button>')
        })
        
        //Show Modal
        $('.modal').modal('show');
    }

    // Klik tambah kegiatan
    $('.modal').on('click', '#add-event',  function(e){
        if(validator(['no_surat', 'agenda', 'tempat', 'kategori', 'subkategori'])) {
            $.post(base_url+'kdr/kegiatan/addKegiatan', {
                id_pic: $('#id_pic').val(),
                tgl_pelaksanaan: $('#start').val(),
                start: $('#start').val(),
                end: $('#end').val(),
                title: $('#agenda').val(),
                //color: $('#color').val(),
                tempat: $('#tempat').val(),
                no_surat: $('#no_surat').val(),
                agenda: $('#agenda').val(),
                pic: $('#pic').val(),
                kategori: $('#kategori').val(),
                subkategori: $('#subkategori').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('Kegiatan berhasil ditambahkan');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
            });
        }
    });

    // Klik update kegiatan
    $('.modal').on('click', '#update-event',  function(e){
        if(validator(['no_surat', 'agenda', 'tempat', 'kategori', 'subkategori'])) {
            $.post(base_url+'kdr/kegiatan/updateKegiatan', {
                id: currentEvent.id_kegiatan,
                title: $('#agenda').val(),
                /*tgl_pelaksanaan: $('#tgl_pelaksanaan').val(),
                start: $('#tgl_pelaksanaan').val(),
                end: $('#tgl_berakhir').val(),
                color: $('#color').val(),*/
                tempat: $('#tempat').val(),
                no_surat: $('#no_surat').val(),
                agenda: $('#agenda').val(),
                kategori: $('#kategori').val(),
                subkategori: $('#subkategori').val()
            }, function(result){
                $('.alert').addClass('alert-success').text('Kegiatan berhasil diupdate');
                $('.modal').modal('hide');
                $('#calendar').fullCalendar("refetchEvents");
                hide_notify();
                
            });
        }
    });

    // Klik hapus kegiatan
    $('.modal').on('click', '#delete-event',  function(e){
        $.get(base_url+'kdr/kegiatan/hapusKegiatan?id=' + currentEvent.id_kegiatan, function(result){
            $('.alert').addClass('alert-success').text('Kegiatan berhasil dihapus !');
            $('.modal').modal('hide');
            $('#calendar').fullCalendar("refetchEvents");
            hide_notify();
        });
    });

    function hide_notify()
    {
        setTimeout(function() {
            $('.alert').removeClass('alert-success').text('');
        }, 2000);
    }

    // Dead Basic Validation For Inputs
    function validator(elements) {
        var errors = 0;
        $.each(elements, function(index, element){
            if($.trim($('#' + element).val()) == '') errors++;
        });
        if(errors) {
            $('.error').html('Field tidak boleh kosong');
            return false;
        }
        return true;
    }
   
});