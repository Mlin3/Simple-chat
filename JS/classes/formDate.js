
function FormDate(date) {
    this.date = new Date(parseInt(date) * 1000);
}

FormDate.prototype.getTime = function() {
    var hours = this.date.getHours();
    
    var minutes = this.date.getMinutes();
    
    if(minutes < 10)
        minutes = '0' + minutes;
    
    var seconds = this.date.getSeconds();
    
    if(seconds < 10)
        seconds = '0' + seconds;
    
    return (hours + ':' + minutes + ':' + seconds);
};


