window.$ = window.jQuery = require("jquery");

require("bootstrap");

Storage.prototype.setObj = function(key, obj) {
    return this.setItem(key, JSON.stringify(obj))
}

Storage.prototype.getObj = function(key) {
    let strItem = this.getItem(key);

    if ( strItem === null ) return {};

    return JSON.parse(this.getItem(key))
}

$("input[name='db_type']").change(function() {
    $(".togglable").toggleClass("d-none")
});

$("[data-toggle='copy']").each(function(index, element){
    const el = $(element);
    const target = el.attr("data-target");

    el.click(function(){
        const input = $(target);
        const val = input.val();

        input.select();

        document.execCommand("copy");
    });
})

function __(key)
{
    const parts = key.split(".");
    let val = language;

    for(var k in parts){
        const v = parts[k];

        if( val[v] ){
            val = val[v];
        } else {
            val = false;
        }
    }

    if( val === language || val === false ) return "Unknown";

    return val;
}

window.__ = __;

let uri = window.location.href.substr(window.base_url.length);
let href = uri.replace("#", "");

let inCreator = href.indexOf("creator") !== -1
let blacklist = [
    "/creator", 
    "/creator/fonts"
];

if( blacklist.includes(uri) ){
    inCreator = false;
}

if( inCreator ){
    require("./creator");
}