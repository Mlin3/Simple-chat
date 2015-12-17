
function LiveConnect(oChat) {
    this.oChat = oChat;
    this.timerHandler = null;
    this.waitingForResponse = false;
    this.request = null;
    this.ajaxHandler = null;
}

LiveConnect.prototype.interval = 5000;

LiveConnect.prototype.exec = function() {
    this.timerHandler = setTimeout(this.send.bind(this), this.interval);
};

LiveConnect.prototype.send = function() {
    this.waitingForResponse = true;
    
    this.ajaxHandler = new Ajax('liveConnect', this.answer.bind(this));
    
    this.ajaxHandler.setData('action', 'normal');
    
    this.ajaxHandler.send();
};

LiveConnect.prototype.answer = function(state, answer) {
    if(state === 1 && answer.code > 199 && answer.code < 300) {
        
        this.oChat.messagesWindow.display( answer.messages );
        
        this.oChat.usersList.display( answer.users );
    }
    else {
        this.oChat.messagesWindow.displayMessage(new Array('Server', 'Connection error'));
    }
    
    this.waitingForResponse = false;
    
    if( !this.execNewRequest() )
        this.exec();
};

LiveConnect.prototype.addRequest = function(parameters) {
    this.request = parameters;
    
    this.execNewRequest();
};

LiveConnect.prototype.execNewRequest = function() {
    if( this.request !== null && !this.waitingForResponse ) {
        clearTimeout( this.timerHandler );
        
        this.waitingForResponse = true;
        
        var ajax = new Ajax('liveConnect', this.answer.bind(this));
        
        this.request.forEach( function( parameter ) {
            ajax.setData(parameter[0], parameter[1]);
        });
        
        this.request = null;
        
        ajax.send();
        
        return true;
    }
    
    return false;
};

LiveConnect.prototype.forceStop = function() {
    if ( this.waitingForResponse ) {
        this.ajaxHandler.abort();
    }
    else {
        clearTimeout( this.timerHandler );
    }
};
