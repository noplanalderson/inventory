$('.add-device').on('click', function(e) {
    e.preventDefault();
    
    $('#deviceModalLabel').text('Add Device');
    $('#formDevice').attr('action', `${baseUrl}devices/add`);
    $('.error-validation').text('');

    $('#deviceId').val('');
    $('#hostname').val('');
    $('#serialNumber').val('');
    $('#processor').val('');
    $('#cores').val('');
    $('#memoryCap').val('');
    $('#storageCap').val('');
    $('#modelId').val('');
    $('#manuId').val('');
    $('#groupId').val('');
    $('#location').val('');
    $('#rackNumber').val('');
})

$('#deviceTable').on('click', '.edit-device', function(e) {
    e.preventDefault();
    $('#deviceModalLabel').text('Edit Device');
    $('#formDevice').attr('action', `${baseUrl}devices/edit`);
    $('.error-validation').text('');

    let id = $(this).data('id');

    $.ajax({
        type: "get",
        url: `${baseUrl}devices/get/${id}`,
        dataType: "json",
        error: function(xhr, status, error) {
            var data = 'Mohon refresh kembali halaman ini. ' + '(status code: ' + xhr.status + ')';
            Toast.fire({
                type : 'error',
                icon: 'error',
                title: 'Terjadi kesalahan: ',
                text: data,
            });
        },
        success: function (response) {
            let data = response.data;
            if(response.code == 200 && response.success == true)
            {
                $('#deviceId').val(data.deviceId);
                $('#hostname').val(data.hostname);
                $('#serialNumber').val(data.serialNumber);
                $('#processor').val(data.processor);
                $('#cores').val(data.cores);
                $('#memoryCap').val(data.memoryCap);
                $('#storageCap').val(data.storageCap);
                $('#modelId').val(data.model.modelId);
                $('#manuId').val(data.model.manufacture.manuId);
                $('#groupId').val(data.model.manufacture.group.groupId);
                $('#location').val(data.location);
                $('#rackNumber').val(data.rackNumber);
            } else {
                Toast.fire({
                    type : 'error',
                    icon: 'error',
                    title: 'Error: ',
                    text: response.errors,
                });
            }
        }
    });
})

$('#formDevice').on('submit', function(e) {
    e.preventDefault();
    $('#btnSubmit').prop('disabled', true);
    $('#btnSubmit').html('<i class="fas fa-spin fa-spinner"></i> Sabar mas...');

    let action = $(this).attr('action');
    let data = {
        deviceId: $('#deviceId').val(),
        hostname: $('#hostname').val(),
        serialNumber: $('#serialNumber').val(),
        groupId: $('#groupId').val(),
        manuId: $('#manuId').val(),
        modelId: $('#modelId').val(),
        processor: $('#processor').val(),
        cores: $('#cores').val(),
        memoryCap: $('#memoryCap').val(),
        storageCap: $('#storageCap').val(),
        location: $('#location').val(),
        rackNumber: $('#rackNumber').val(),
        simdc_token: $('input[name="simdc_token"]').val()
    };

    $.ajax({
        type: "post",
        url: action,
        data: data,
        dataType: "json",
        error: function(xhr, status, error) {
            var data = 'Please refresh this page. ' + '(status code: ' + xhr.status + ')';
            Toast.fire({
                type : 'error',
                icon: 'error',
                title: 'Error: ',
                text: data,
            });
            $('#btnSubmit').prop('disabled', false);
            $('#btnSubmit').html('<i class="fas fa-save"></i> Simpan');
        },
        success: function (response) {
            $('input[name="simdc_token"]').val(response.csrf_token);
            $('meta[name="X-CSRF-TOKEN"]').attr('content', response.csrf_token);
            $('#btnSubmit').prop('disabled', false);
            $('#btnSubmit').html('<i class="fas fa-save"></i> Save');
            $('.error-validation').text('');
            if (response.status == true) {
                $('#deviceModal').modal('hide');
                Swal.fire('Success!', response.message, 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                Toast.fire({
                    type : 'error',
                    icon: 'error',
                    title: 'Failed: ',
                    text: response.message,
                });

                let errors = response.errors;

                if(typeof errors === 'object' &&  !Array.isArray(errors) && errors !== null) {
                    $.each(errors, function( i, v ) {
                        $(`#${i}Hint`).text(v);
                    });
                }
            }
        }
    });

    return false;
})

$("#deviceTable").on('click', '.delete-device', function(e){
    e.preventDefault();
      
      const deviceId = $(this).data('id');
  
      Swal.fire({
          title: 'Warning!',
          text: 'Are you sure to delete this device?',
          showCancelButton: true,
          type: 'warning',
          confirmButtonText: 'Yes',
          cancelButtonText: 'Cancel',
          reverseButtons: true
      }).then((result) => {
  
          if (result.value == true) {
  
              Swal.fire({
                  title: 'Deleting device',
                  text: 'Sabar mas...',
                  showCancelButton: false,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  type: 'info',
                  showConfirmButton: false,
                  showCancelButton: false,
                  reverseButtons: true
              })
  
              $.ajax({
                  url: `${baseUrl}/devices/delete`,
                  data: {
                          deviceId: deviceId, 
                          simdc_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                  },
                  method: 'post',
                  dataType: 'json',
                  error: function(xhr) {
                      var data = 'Please refresh this page. ' + '(status code: ' + xhr.status + ')';
                      Toast.fire({type:'error', icon:'error', title: 'Error: ', text: data});
                  },
                  success: function(data) {
                      $('input[name="simdc_token"]').val(data.csrf_token);
                      $('meta[name="X-CSRF-TOKEN"]').attr('content', data.csrf_token);
  
                      if (data.status == true) {
                          Swal.fire('Success!', data.message, 'success');
                          setTimeout(() => {
                            window.location.reload();
                          }, 2500);
                      } else {
                          Swal.fire('Failed!', data.message, 'error');
                      }
                  }
              });
          }
      })
});

$('#device_group').on('change', function(e) {
    e.preventDefault();
    let groupId = $(this).val();

    window.location.href = `${baseUrl}devices/${groupId}`;
})