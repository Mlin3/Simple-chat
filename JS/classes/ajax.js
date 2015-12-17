
function Ajax(url, callback) {
    this.url = '{$ BASE_URL}';
    this.data = null;
    
    this.request = new XMLHttpRequest();
    
    if(typeof url === 'string')
        this.setUrl(url);
    
    if(typeof callback === 'function')
        this.setCallback(callback);
    
    this.request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
}

Ajax.prototype.setCallback = function(callback) {
    
    this.request.onreadystatechange = function() {
        if(this.readyState === XMLHttpRequest.DONE) {
            if(this.status === 200) {
                callback(1, JSON.parse(this.responseText));
            }
            else {
                callback(0);
            }
        }
    };
};

Ajax.prototype.setUrl = function(url) {
    this.request.open('POST', this.url + 'ajax/' + url, true);
};

Ajax.prototype.setData = function(key, value) {
    var query = key + '=' + encodeURIComponent(value);
    
    if( this.data === null )
        this.data = query;
    else
        this.data += '&' + query;
};

Ajax.prototype.send = function(key, value, callback) {
    if( typeof key === 'string' && typeof value === 'string') {
        this.setData(key, value);
    }
    
    if(typeof callback === 'function')
        this.setCallback(callback);
    
    this.request.send(this.data);
};

Ajax.prototype.abort = function() {
    this.request.onreadystatechange = function() {};
    
    this.request.abort();
};

