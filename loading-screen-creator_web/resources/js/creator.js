const C_Input = require("./creator/input")
const C_Widget = require("./creator/widget");

class C_Creator {
    constructor()
    {
        this.open = false;
    }

    toggleSidebar(el, boolDontSave, direction)
    {
        if( direction === "left" ){
            if ( this.open ) 
                el.animate({left: -300});
            else
                el.animate({left: 0});
        } else if( direction === "right" ){
            if ( this.open ) 
                el.animate({right: -300});
            else
                el.animate({right: 0});
        }

        this.open = !this.open;

        if( !boolDontSave ){
            localStorage.setItem("sidebar_open", this.open);
        }
    }

    moveSidebar(el, boolDontSave, direction)
    {
        let moveTo = this.open === true ? "0" : "-300px";

        if( direction === "left" ){
            el.css("left", moveTo);
            el.css("right", "auto");
        } else if( direction === "right" ){
            el.css("left", "auto");
            el.css("right", moveTo);
        }

        if( !boolDontSave ){
            localStorage.setItem("sidebar_position", direction);
        }        
    }

    updateSettings(el)
    {
        $("#collapse-widget").html("");
     
        if( el === undefined ) return;

        const widgetName = el.attr("data-widget");
        const widget = widgets.widgets[widgetName];
        const css = widget.css;
        const vars = widget.vars || {};

        addPositionsButtons();

        new C_Input(el, "width", "10").createHtml();
        new C_Input(el, "height", "10").createHtml();

        for(var k in css){
            let v = css[k];

            let input = new C_Input(el, k, v);
            input.createHtml();
        }

        for(var k in vars){
            let v = vars[k];

            let input = new C_Input(el, k, v, "var");
            input.createHtml();
        }

    }

    updateDraggable(el, resizable)
    {
        const w = document.documentElement.clientWidth;
        const h = document.documentElement.clientHeight;
        const self = this;

        el.draggable({
            grid: [ w / 200, h / 100 ],
            stop: (event, ui) => {
                const w = document.documentElement.clientWidth;
                const h = document.documentElement.clientHeight;

                const target = $(event.target)

                const position = ui.position

                target.css({
                    "top": position.top * 100 / h + "%",
                    "left": position.left * 100 / w + "%"
                })
            }
        });      
        
        el.resizable({
            handles: "n, e, s, w, ne, se, sw, nw",
            grid: [ w / 200, h / 100 ],
            stop: (event, ui) => {
                const w = document.documentElement.clientWidth;
                const h = document.documentElement.clientHeight;

                const target = $(event.target)
                const position = ui.position

                target.css({
                    "width": target.width() * 100 / w + "%",
                    "height": target.height() * 100 / h + "%",
                    "top": position.top * 100 / h + "%",
                    "left": position.left * 100 / w + "%"
                })
            },

            ...resizable
        });

        el.mousedown(function(e){
            $(".draggable").removeClass("selected");
            $(this).addClass("selected");

            self.updateSettings($(this));
            
            e.stopPropagation()
        });

        el.trigger("mousedown");

        $(".c-container").mousedown(function(){        
            $(".draggable").removeClass("selected");
            self.updateSettings();
        })          
    }

    displayGrid(bool)
    {
        if ( !bool || bool === "false" ) {
            $(".c-container").css("background-image", "none")
        } else {
            $(".c-container").css("background-image", `
                linear-gradient(to right,  grey 1px, transparent 1px),
                linear-gradient(to bottom,grey 1px, transparent 1px)           
            `)
        }
    }   

    cssToJSON(css)
    {
        if(!css) return {};

        let cssJSON = {};
        let parts = css.split(";");

        for (let index = 0; index < parts.length; index++) {
            const element = parts[index];
            
            if ( !element ) continue; 

            const partCSS = element.split(":");
            let key = partCSS.shift();
            let value = partCSS.join(":");

            key = key.replace(/\s/g, '');
            value = value.substr(1);
            
            cssJSON[key] = value;
        }

        return cssJSON;
    }
    
    save()
    {
        let self = this;
        let json = {};
        json["widgets"] = {};
        
        let widgets = $(".draggable");

        widgets.each(function(index, element){
            const el = $(element);
            const position = pxPosToPercentage(el, "%");
            const len = Object.keys(json.widgets).length || 0;

            const widgetData = window.widgets.get(el.attr("data-widget"));
            let vars = {};

            el.find("*[data-key]").each(function(index, element){
                const el = $(element);
                
                vars[el.attr("data-key")] = el.html();
            });

            json.widgets[len] = {
                name: el.attr("data-widget"),
                css: self.cssToJSON(el.attr("style")),
                position,
                vars
            }
        });

        json["body"] = self.cssToJSON($("body").attr("style"));

        json["sound"] = {
            src: $("#sound").attr("src"),
            volume: $("#song_volume").val() / 100
        }

        const currentLayoutName = window.location.pathname.split("/creator/")[1];

        $.ajax(window.base_url + "/api/layout/" + currentLayoutName + "/save", {
            type: "POST",
            data: json,
            statusCode: {
                404: function() {
                    alert("Unknown layout, you will be redirected");
                    window.location.href = window.base_url + "/creator";
                }
            }
        }).done(function(data){
            alert("Layout saved!")
        });
    }
}

function pxPosToPercentage(el, prefix) {
    const w = document.documentElement.clientWidth
    const h = document.documentElement.clientHeight
    const position = el.position();

    let x = position.left * 100 / w;
    let y = position.top * 100 / h

    prefix = prefix || "";

    return {
        x: x.toString() + prefix,
        y: y.toString() + prefix
    }
}

const Creator = new C_Creator();

let widgets = new C_Widget(Creator);
window.widgets = widgets;
window.creator = Creator;

window.RGBToHex = function(rgb) {
    // Choose correct separator
    let sep = rgb.indexOf(",") > -1 ? "," : " ";
    // Turn "rgb(r,g,b)" into [r,g,b]
    rgb = rgb.substr(4).split(")")[0].split(sep);

    let r = (+rgb[0]).toString(16),
        g = (+rgb[1]).toString(16),
        b = (+rgb[2]).toString(16);

    if (r.length === 1)
        r = "0" + r;
    if (g.length === 1)
        g = "0" + g;
    if (b.length === 1)
        b = "0" + b;

    return "#" + r + g + b;
}

require("jquery-ui/ui/widgets/draggable");
require("jquery-ui/ui/widgets/resizable");
require("jquery-ui/ui/widgets/mouse");

require("./creator/sidebar").default(Creator);
require("./creator/contextmenu");

let loaded = setInterval(() => {
    if( Object.keys(widgets.widgets).length > 0 ){
        widgets.load();

        clearInterval(loaded);
    }
}, 500);

let backgroundColor = new C_Input($("body"), "background-color", "", "css", "#collapse-global").createHtml();
let backgroundimage = new C_Input($("body"), "background-image", "", "css", "#collapse-global").createHtml();

let displayed = false;

$("#display_grid").click(function(){
    Creator.displayGrid(displayed);
    displayed = !displayed;
});

// Move with arrows
$(window).keydown(function(e) { 
    let widget = $(".draggable.selected");
    
    if( !widget || widget.length < 1 ) return;

    if( $(".panel-config input").is(":focus") ) return;

    const key = event.key;

    if (key === "Delete") {
        widgets.remove(widget)
    }

    const w = document.documentElement.clientWidth;
    const h = document.documentElement.clientHeight;

    switch(e.keyCode){
        case 38: // UP
            var percent = widget.position().top * 100 / h;
            percent -= 0.5;

            widget.css("top", percent + "%");
            break;
        case 40: // Down
            var percent = widget.position().top * 100 / h;
            percent += 0.5;

            widget.css("top", percent + "%");
            break;
        case 37: // Left
            var percent = widget.position().left * 100 / w;
            percent -= 0.5;

            widget.css("left", percent + "%");

            break;
        case 39: // Right
            var percent = widget.position().left * 100 / w;
            percent += 0.5;

            widget.css("left", percent + "%");

            break;
    }
});

// Song
$(function(){
    let audio = document.getElementById("audio");

    audio.addEventListener("canplay", function(){
        audio.play();
    }, false);

    $("#song_url").on("change paste", function(){
        let sound = document.getElementById("sound");
        sound.src = $(this).val();

        audio.load();
    });

    $("#song_volume").on("change input", function(){
        audio.volume = $(this).val() / 100;
    });

    $("#song_volume").change();
})

// Copy / paste

$(function() {
    let copiedElement = null

    document.addEventListener('copy', function(e){
        let widget = document.querySelector(".selected")

        if( !widget || $("input").is(":focus") ) return;
        
        copiedElement = widget.cloneNode(true)
    });

    document.addEventListener("paste", function() {
        if( !copiedElement || $("input").is(":focus") ) return

        document.querySelector(".c-container").appendChild(copiedElement)

        $(copiedElement).find('.ui-resizable-handle').remove();

        Creator.updateDraggable($(copiedElement), {});
    })
});

function addPositionsButtons(){
    const parent = $("#collapse-widget")

    const horizontal = `
        <label class="custom">${__('input.horizontal_alignment')}</label>
        <div class="btn-group mb-3 btn-block" role="group" aria-label="Vertical alignement">
            <button type="button" class="btn btn-custom alignBtn" data-pos="left">Left</button>
            <button type="button" class="btn btn-custom alignBtn" data-pos="hMiddle">Center</button>
            <button type="button" class="btn btn-custom alignBtn" data-pos="right">Right</button>
        </div>`;

    const vertical = `
        <label class="custom">${__('input.vertical_alignment')}</label>
        <div class="btn-group mb-3 btn-block" role="group" aria-label="Vertical alignement">
            <button type="button" class="btn btn-custom alignBtn" data-pos="top">Top</button>
            <button type="button" class="btn btn-custom alignBtn" data-pos="vMiddle">Center</button>
            <button type="button" class="btn btn-custom alignBtn" data-pos="bottom">Bottom</button>
        </div>`;

    $(parent).append(horizontal)
    $(parent).append(vertical)
    
    $(".alignBtn").on("click", function() {
        const pos = $(this).attr("data-pos")
        const element = $(".draggable.selected");

        const w = document.documentElement.clientWidth
        const h = document.documentElement.clientHeight

        const eW = element.width()
        const eH = element.height()

        switch (pos) {
            case "left":
                element.css({
                    "left": "0px",
                    "right": "auto",
                })
            
                break;
                
            case "hMiddle":
                element.css({
                    "left": ((Math.floor((w / 2 - eW / 2) / (w / 100))) * (w / 100) / (w) * 100) + "%",
                    "right": "0"
                })

                break;
 
            case "right":
                element.css({
                    "left": "auto",
                    "right": "0px",
                })

                break;
                
            case "top":
                element.css({
                    "top": "0px",
                    "bottom": "auto",
                })
            
                break;
                
            case "vMiddle":
                element.css({
                    "top": ((Math.floor((h / 2 - eH / 2) / (h / 100))) * (h / 100) / (h) * 100) + "%",
                    "bottom": "0"
                })

                break;

            case "bottom":
                element.css({
                    "top": "auto",
                    "bottom": "0px",
                })

                break;

            default:
                break;
        }
    })
};