
function MessagesWindow(messages) {
    this.window = document.getElementById('messages');
    
    this._purge();
    
    if(typeof messages !== 'undefined')
        this.display(messages);
}

MessagesWindow.prototype.display = function(messages) {
    var parent = this;
    
    messages.forEach(function(message) {
        parent.displayMessage(message);
    });
};

MessagesWindow.prototype.displayMessage = function(message, parent) {
    
    var formDate = new FormDate(message[2]);
    
    if(typeof parent === 'undefined') {
        this.window.appendChild(this._genereteMessage(message[0], message[1], formDate.getTime()));
        
        this.cleanUp();
        
        this.scroll();
    }
    else
        parent.appendChild(this._genereteMessage(message[0], message[1], formDate.getTime()));
};

MessagesWindow.prototype._genereteMessage = function(name, message, time) {
    var div = document.createElement('div');
    
    var span_name = document.createElement('span');
    span_name.textContent = name + ': ';
    
    var span_message = document.createElement('span');
    span_message.textContent = message;
    
    var span_time = document.createElement('span');
    span_time.textContent = '(' + time + ') ';
    
    div.appendChild(span_time);
    
    div.appendChild(span_name);
    
    div.appendChild(span_message);
    
    return div;
};

MessagesWindow.prototype.scroll = function() {
    this.window.scrollTop = 99999;
};

MessagesWindow.prototype.cleanUp = function() {
    var count = document.querySelectorAll('#messages > div').length;
    
    var excess = count - 200;
    
    if(excess > 0) {
        for(var i = 0; i < excess; ++i) {
            this.window.removeChild( this.window.firstChild );
        }
    }
};

MessagesWindow.prototype._purge = function() {
    while( this.window.firstChild ) {
        this.window.removeChild( this.window.firstChild );
    }
};


