
function Editor(oChat) {
    this.oChat = oChat;
    
    var parent = this;
    
    document.getElementById('buttonSend').addEventListener('click', this.sendMessage.bind(this));
    
    var oTextarea = document.getElementById('message');
    
    oTextarea.addEventListener('keypress', function(event) {
        if(event.keyCode === 13)
            parent.sendMessage(event);
    });
    
    oTextarea.focus();
}

Editor.prototype.sendMessage = function(event) {
    var oTextarea = document.getElementById('message');
    var message = oTextarea.value;
    
    if( message !== '') {
        var requestParameters = new Array(
                    new Array('action', 'addMessage'),
                    new Array('message', message)
                );
        
        try {
            this.oChat.liveConnect.addRequest(requestParameters);
            
            oTextarea.value = '';
        }
        catch (exception) {
            this.oChat.messagesWindow.displayMessage(new Array('Server', 'Previous message is being send, please wait...'));
        }
    }
    
    oTextarea.focus();
    
    event.preventDefault();
};