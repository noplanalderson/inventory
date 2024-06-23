$('#loginForm').on('submit', function(e) {
    e.preventDefault();
    let data = {
        username: $('#username').val(),
        password: $('#password').val(),
        simdc_token: $('input[name="simdc_token"]').val()
    }
    let action = $(this).attr('action');
    $('#login').prop('disabled', true);
    $('#login').html('<i class="fas fa-spin fa-spinner"></i> Sabar mas...');

    $.ajax({
        type: "post",
        url: action,
        data: data,
        dataType: "json",
        error: function(xhr, status, error) {
            var data = 'Mohon refresh kembali halaman ini. ' + '(status code: ' + xhr.status + ')';
            Toast.fire({
                type : 'error',
                icon: 'error',
                title: 'Terjadi kesalahan: ',
                text: data,
            });
            $('#login').prop('disabled', false);
            $('#login').html('<i class="fas fa-door-open"></i> Login');

        },
        success: function (data) {
            $('input[name="simdc_token"]').val(data.csrf_token);
            $('meta[name="X-CSRF-TOKEN"]').attr('content', data.csrf_token);
            let color = (data.status == true) ? 'alert-success' : 'alert-danger';
              let alert = `<div class="alert ${color} font-weight-bold animate__animated animate__slideOutUp animate__delay-3s" role="alert">${data.message}</div>`;

              $("#response").slideDown('fast');
              $('#response').html(alert);

              if(data.status == false) {
                $('#login').prop('disabled', false);
                $('#login').html('<i class="fas fa-door-open"></i> Login');
              } else {
                const urlParams = new URLSearchParams(window.location.search);
                const next = urlParams.get('next');
                var url = (next == null) ? 'user' : next;
                setTimeout(function () { window.location.href = baseUrl + url; }, 2000);
              }

              if(data.rule_msg["username"] !== '' && data.rule_msg["password"] !== '') {
                $('#user_error').fadeIn('fast');
                $('#pass_error').fadeIn('fast');
                $('#user_error').text(data.rule_msg["username"] !== undefined ? data.rule_msg.username : null);
                $('#pass_error').text(data.rule_msg["password"] !== undefined ? data.rule_msg.password : null);
              }

              $("#response").alert().delay(5000).slideUp('fast');
              $("#user_error").alert().delay(5000).fadeOut();
              $("#pass_error").alert().delay(5000).fadeOut();
        }
    });
})