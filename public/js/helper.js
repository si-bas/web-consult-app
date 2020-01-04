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
