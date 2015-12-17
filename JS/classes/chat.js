
function Chat() {
    this.messagesWindow = null;
    this.usersList = null;
    this.editor = null;
    this.liveConnect = null;
}

Chat.prototype.appStart = function() {
    var parent = this;
    
    window.addEventListener('DOMContentLoaded', function() {
        parent.initiate();
    });
};

Chat.prototype.initiate = function() {
    
    if(document.getElementById('button')) {
        var login = new Login(this);

        login.load();
    }
    else {
        this.load();
        
        this.liveConnect.addRequest(new Array(new Array('action', 'normal')));
    }
};

Chat.prototype.display = function(messages, users) {
    var templater = new Templater();
    
    templater.render('chatTemplate', 'simpleChat');

    this.load(messages, users);
};

Chat.prototype.load = function(messages, users) {
    
    this.messagesWindow = new MessagesWindow(messages);
    this.usersList = new UsersList(users);
    
    this.editor = new Editor(this);
   
    this.liveConnect = new LiveConnect(this);
    
    this.liveConnect.exec();
    
    var logout = new Logout(this);
    
    logout.load();
};

