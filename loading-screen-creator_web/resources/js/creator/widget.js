class Widget{
    constructor(creator, layout)
    {
        this.creator = creator;
        this.widgets = {}
        this.layout = layout || null;

        $.ajax(window.base_url + "/api/widgets")
            .done(( data ) => {
                const json = JSON.parse(data);
                let widgets = {};
                
                for (let index = 0; index < json.length; index++) {
                    const element = json[index];

                    $("#addWidgetModalSelect").append("<option value='" + element.name + "'>" + element.name + "</option>")

                    widgets[element.name] = element;
                }

                this.widgets = widgets
            });
    }

    getName()
    {
        if( this.layout && this.layout != null ) return this.layout;

        const currentLayoutName = window.location.pathname.split("/creator/")[1];

        return currentLayoutName.replace("#");
    }

    get(name)
    {
        return this.widgets[name];
    }

    create(name)
    {
        const widget = this.widgets[name];

        const self = this

        if(!widget) {
            setTimeout(function() {
                self.create(name)
            }, 100)
            return
        }

        const css = widget.css;
        const resizable = widget.others.resizable || {};
        let div = "";

        if( this.layout && this.layout != null ){
            div = `<div class="draggable" data-widget="${name}">${widget.template}</div>`;
        } else {
            div = `<div class="draggable" tabindex="-1" data-widget="${name}">${widget.template}</div>`;
        }
        
        let el = $(div).appendTo(".c-container");

        el.attr("data-widget", name);

        let resizable_ = {}

        if( resizable.defaultWidth ){
            el.css("width", resizable.defaultWidth);
        }
        
        if( resizable.defaultHeight ){
            el.css("height", resizable.defaultHeight);
        }
        
        if( resizable.minWidth ){
            resizable_.minWidth = resizable.minWidth;
        }

        if( resizable.minHeight ){
            resizable_.minHeight = resizable.minHeight;
        }

        for( var k in css ){
            const v = css[k];

            el.css(k, v);
        }
        
        if( !this.layout || this.layout === null ){
            this.creator.updateDraggable(el, resizable_);
        }

        return el;
    }

    remove(element)
    {
        element.remove();
    }

    load()
    {
        const self = this;

        $.ajax(window.base_url + "/api/layout/" + this.getName() + "/get")
            .done(function(data){
                const json = JSON.parse(data);
                const widgets = json.widgets || {};
                
                for(var k in widgets){
                    const el = widgets[k];
                    const el_widget = self.create(el.name);
            
                    for( var kk in el.css ){
                        var value = el.css[kk];
            
                        el_widget.css(kk, value);
                    }
            
                    for( var kk in el.vars ){
                        var value = el.vars[kk];
            
                        el_widget.find("* [data-key='" + kk + "']").html(value);
                    }
                }

                if( json.body ){
                    for( var k in json.body ){
                        const v = json.body[k];

                        if( v.indexOf("rgb") != -1 ){
                            $("#collapse-global #" + k).val(RGBToHex(v));
                        } else {
                            $("#collapse-global #" + k).val(v.replace('url("', "").replace('")', ""));
                        }

                        $("body").css(k, v);
                    }
                }

                if( json.sound ){
                    if( self.layout && self.layout != null ){
                        let audio = document.getElementById("audio");
                        audio.src = json.sound.src;
                        audio.volume = json.sound.volume;

                        audio.addEventListener("canplay", function(){
                            audio.play();
                        }, false);
                    } else {
                        $("#song_url").val(json.sound.src).change();
                        $("#song_volume").val(json.sound.volume * 100).change();
                    }
                }
            });
    }
}

module.exports = Widget