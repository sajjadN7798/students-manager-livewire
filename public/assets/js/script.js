const loader = '<h1>Loading...</h1>';
const lw = window.livewire;
const locales = document.querySelectorAll('.language-menu li');

locales.forEach((locale) => {
    locale.addEventListener('click', (e) => {
        document.querySelector('#locale').value = locale.getAttribute('data-locale');
        document.querySelector('#locale-form').submit();
    });
});

lw.on("studentAdded", () => {
    $('#add-student-modal').modal('hide');
});

lw.on("studentUpdated", () => {
    $('#update-student-modal').modal('hide');
});

function confirmDialog(id) {
    const locale = document.body.getAttribute('data-locale');
    if (confirm(locale === 'fa' ? 'آیا مطمئن هستید؟' : 'Are your sure?')) lw.emit(`set:destroy`, id);
}

async function _httpPost(url, data, options = {}) {
    await fetch(url, {
        ...options,
        method: "POST",
        body: JSON.stringify(data),
    }).then((response) => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('خطایی رخ داده است.');
        }
    })
        .then((responseJson) => {
            return responseJson;
        })
        .catch((error) => {
            alert(error);
        });
}

async function _httpGet(url, options = {}, withLoader = {status: false, target: ""}) {
    const {status, target} = withLoader;
    status && showLoader(target);
    const sendRequest = await fetch(url, {
        ...options,
        method: "GET"
    }).then((response) => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('خطایی رخ داده است.');
        }
    })
        .then((responseJson) => {
            return responseJson;
        })
        .catch((error) => {
            alert(error);
        });
    status && hideLoader(target);
    return sendRequest;
}

// Append Element
function printElement(nodeList, targetNode) {
    const parent = document.createElement('div');
    parent.innerHTML = nodeList;
    document.querySelector(targetNode).appendChild(parent);
}

// Show And Hide Loader
function showLoader(target) {
    document.querySelector(target).innerHTML = loader;
}

function hideLoader(target) {
    document.querySelector(target).innerHTML = '';
}

// End Of Show And Hide Loader
