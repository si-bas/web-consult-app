const startTime = () => {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
const checkTime = (i) => {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

const showAlert = (type, icon, message, tag = null) => {
    let element = `<div class="alert alert-${type} alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="d-flex align-items-center">
                    <i class="bx ${icon}"></i>
                    <span>
                        ${message}
                    </span>
                </div>
            </div>`;

    if (tag) {
        tag.prepend(element);
    } else {
        return element;
    }
}

const removeAlert = (tag) => {
    tag.find('.alert').remove();
}

const bindInputValue = (tag, value) => {
    tag.val(value);
}

const bindSelect2Value = (tag, value, label) => {
    tag.append(`<option value="${value}">${label}</option>`);
    tag.val(value).trigger('change');
}