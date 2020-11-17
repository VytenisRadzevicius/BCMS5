let loginForm = document.querySelector('#login-form');
let registerForm = document.querySelector('#register-form');

if(loginForm) {
    loginForm.addEventListener('submit', function(e){
        e.preventDefault();
        let username = document.querySelector('#username').value;
        let password = document.querySelector('#password').value;
        ajax({action: 'loginUser', username: username, password: password});
    });
}
if(registerForm) {
    registerForm.addEventListener('submit', function(e){
        e.preventDefault();
        let username = document.querySelector('#register-username').value;
        let email = document.querySelector('#register-email').value;
        let password1 = document.querySelector('#register-password1').value;
        let password2 = document.querySelector('#register-password2').value;
        ajax({action: 'registerUser', username: username, email: email, password1: password1, password2: password2});
    });
}

function ajax(data) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'engine/ajax.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.readyState === 4 && xhr.status === 200 && xhr.responseText != '') {
            let response = JSON.parse(xhr.responseText);
            if(response.action) execute(response);
        } else {
            console.log('bad response');
        }
    };
    xhr.send(JSON.stringify(data));
}

function execute(instructions) {
    switch(instructions.action) {
        case 'redirect':
            redirect(instructions.location);
            break;
        case 'error':
            showAlert(instructions);
            break;
        case 'modal':
            showModal(instructions.alert);
            break;
        case 'populate-add-select':
            populate(instructions.data, 'add-assignment-privilege');
            break;
        case 'populate-remove-select':
            populate(instructions.data, 'remove-assignment-privilege');
            break;
      }
}

function redirect(loc = 'index.php') {
    window.location.href = loc;
}

// !!!REWORK!!!
function showAlert(error) {
    delete error.action;
    let elements = document.getElementsByClassName('is-invalid');
    let alerts = document.getElementsByClassName('alert show');

    while(alerts.length > 0){
        alerts[0].classList.remove('show');
    }

    while(elements.length > 0){
        elements[0].classList.add('is-valid');
        elements[0].classList.remove('is-invalid');
    }

    Object.entries(error).forEach(entry => {
        let [field, message] = entry;
        document.getElementById(field).classList.remove('is-valid');
        document.getElementById(field).classList.add('is-invalid');
        document.getElementById(field).nextElementSibling.innerHTML = message;
    });
}

function cleareditor() {
    if(typeof editor !== 'undefined') editor.setContents('');
}

// !!!REWORK!!!
function showModal(alert) {
    let myCollapse = document.getElementById(alert)
    let bsCollapse = new bootstrap.Collapse(myCollapse, {
        toggle: false
    });
    bsCollapse.show();
    let elements = document.getElementsByClassName('is-invalid');
    let elements2 = document.getElementsByClassName('is-valid');

    while(elements.length > 0){
        elements[0].classList.remove('is-invalid');
    }
    while(elements2.length > 0){
        elements2[0].classList.remove('is-valid');
    }
    myCollapse.nextElementSibling.reset();
    cleareditor();
}
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});