/* 
 * Custom JS functions for Todo app
 */

$('.edit').die().live('click',function(e){
  document.location.href = $(this).attr('href'); 
});

$('.confirm-done').live('click',function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('.accept-confirm-done').attr('data-id',id);
    $('#modal-from-done').modal('show');
});

$('.accept-confirm-done').live('click',function(e){
    e.preventDefault();
    var id= $(this).attr('data-id');
    var refresh_url= $(this).attr('data-refresh-url');
    
    // ajax call to set done the task
    $.ajax({
        url: 'tasks/done/'+id,
            success: function(data){
                $('#modal-from-done').modal('hide');
                var obj = jQuery.parseJSON(data);
                
                $.ajax({
                    url: refresh_url,
                    success: function(data){
                        // refresh the content after the response of the refresh url.
                        $('#table-task').html(data);
                        $('#modal-from-success .modal-header h3').html(obj.response_header);
                        $('#modal-from-success .modal-body p').html(obj.response_text);
                        $('#modal-from-success').modal('show');
                    },
                    error: function(data){
                        alert('failure Refresh URL : ' +data);
                    }
                });
            },
            error: function(data){
                alert('failure setting Done: ' +data);
            }
        });
});




   
   




