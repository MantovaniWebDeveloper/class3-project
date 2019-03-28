const $ = require('jquery');
getToken();

function getToken() {
    let url = 'http://127.0.0.1:8000/api/customer/token';
    $.ajax(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            loadDropIn(data.token)
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function loadDropIn(token) {
    braintree.dropin.create({
        authorization: token,
        container: '#dropin-container'
    }, function (createErr, instance) {
        changeSubmitButtonState(true);
        $('#submit-button').click(function () {
            instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                let url = 'http://127.0.0.1:8000/api/sponsorizza/checkout';
                $.ajax(url, {
                    beforeSend: function () {
                        changeSubmitButtonState(false);
                    },
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'paymentMethodNonce': payload.nonce,
                        'promotion_type': $('input[name=promotion_type]:checked').val()
                    },
                    success: function () {
                        teardown(instance);
                    },
                    error: function () {
                        $('#message').text("pagamento non accettato");
                        changeSubmitButtonState(true);
                    }
                });
            });
        });
    });
}

function teardown(instance) {
    instance.teardown(function (teardownErr) {
        if (teardownErr) {
            $('#dropin-container').remove();
        }
        $('#submit-button').remove();
        $('.success').removeAttr('hidden');
    });
}

function changeSubmitButtonState(enable) {
    if (enable) {
        $("#submit-button").removeAttr("disabled");
    } else {
        $("#submit-button").attr("disabled", true);
    }
}
