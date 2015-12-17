
function Templater() {
    this.data =  new Array();
}

Templater.prototype.chatTemplate = '{$ ChatTemplate}';
Templater.prototype.loginTemplate = '{$ LoginTemplate}';

Templater.prototype.register = function(key, value) {
    this.data.push(new Array(key, value));
};

Templater.prototype.clean = function() {
    
    this.data = new Array();
};

Templater.prototype.render = function(templateName, parent, dontOverride) {
    
    var output = this.compile(templateName);
    
    if(typeof dontOverride !== 'undefined' && dontOverride === 1)
        document.getElementById(parent).innerHTML += output;
    else
        document.getElementById(parent).innerHTML = output;
};

Templater.prototype.compile = function(templateName) {
    
    var template = this[templateName];
    
    return this.generate(template);
};

Templater.prototype.generate = function(template) {

    this.data.forEach(function(data) {
        
        var regexp = new RegExp('\\{\\$[ ]*?' + data[0] + '[ ]*?\\}', 'i');
        
        template = template.replace(regexp, data[1]);
    });
    
    return template;
};

