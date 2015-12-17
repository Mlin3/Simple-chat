
function UsersList(users) {
    this.window = document.getElementById('usersList');
    
    if (typeof users !== 'undefined')
        this.display(users);
}

UsersList.prototype.display = function(users) {
    var oFragment = document.createDocumentFragment();
    var parent = this;
    
    users.forEach(function(user) {
        oFragment.appendChild( parent._generate(user) );
    });
    
    this._purge();
    
    this.window.appendChild( oFragment );
};

UsersList.prototype._generate = function(user) {
    var div = document.createElement('div');
    
    div.textContent = user;
    
    return div;
};

UsersList.prototype._purge = function() {
    while( this.window.firstChild ) {
        this.window.removeChild( this.window.firstChild );
    }
};

