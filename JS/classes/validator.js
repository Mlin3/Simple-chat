
function Validator() {
    
}


Validator.prototype.checkLogin = function(login) {
    
    if( login.match(/^[a-z0-9_\-\(\)]{2,25}$/i) )
        return true;
    else
        return false;
};
