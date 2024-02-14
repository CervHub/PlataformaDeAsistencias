// En un archivo JavaScript separado
function activateElementById(id) {
    var element = document.querySelector('#' + id);

    if (element) {
        element.classList.add('active');
    }
}

class ApiClient {
    constructor(apiUrl) {
        this.apiUrl = apiUrl;
    }

    sendRequest(endpoint, method, data, callback) {
        $.ajax({
            url: this.apiUrl + endpoint,
            type: method,
            data: data,
            success: function (response) {
                callback(null, response);
            },
            error: function (error) {
                callback(error);
            }
        });
    }
}
