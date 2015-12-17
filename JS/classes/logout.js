
function Logout(oChat) {
    this.oChat = oChat;
}

Logout.prototype.exec = function() {
    this.oChat.liveConnect.forceStop();
    
    var ajax = new Ajax('logout', this.logoutAnswer.bind(this));
    
    ajax.send();
    
    var templater = new Templater();
    
    templater.render('loginTemplate', 'simpleChat');
    
    this.oChat.initiate();
};

Logout.prototype.load = function() {
    document.getElementById('buttonLogout').addEventListener('click', this.exec.bind(this));
};

Logout.prototype.logoutAnswer = function(code, answer) {
    //...
};