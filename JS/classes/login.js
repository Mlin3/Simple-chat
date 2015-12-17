
function Login(oChat) {
    
    this.oChat = oChat;
}

Login.prototype.load = function() {
    
    document.getElementById('button').addEventListener('click', this.send.bind(this));
    
    document.getElementById('loginForm').addEventListener('submit', this.send.bind(this));
    
    document.getElementById('login').focus();
};

Login.prototype.send = function(event) {

    var login = document.getElementById('login').value;
    
    var validator = new Validator();
    
    if( validator.checkLogin(login) ) {
    
        this.displayError('');
        
        var ajax = new Ajax('login');

        ajax.send('login', login, this.answer.bind(this));
    }
    else {
        this.displayError('Incorrect name.');
    }
    
    event.preventDefault();
};

Login.prototype.answer = function(status, answer) {
    if(status === 1) {
        if ( answer.code === 201) {
            
            this.oChat.display(answer.messages, answer.users);
        }
        else {
            this.displayError(answer.content);
        }
    }
    else {
        this.displayError('Error: connection problem.');
    }
};

Login.prototype.displayError = function(errorMessage) {
    var errorContainer = document.getElementById('errorMessage');
    
    errorContainer.textContent = errorMessage;
    errorContainer.style.display = 'block';
};
