const color = require("./inputs/color");

class Input{
    constructor(el, key, value, type, parent)
    {
        this.element = el;
        this.key = key;
        this.value = value;

        this.type = type || "css";

        this.parent = parent || "#collapse-widget";
    }

    getCSS(key)
    {
        return this.element.css(this.key);
    }

    createHtml()
    {
        let self = this;
        let html = ``;
        var input = false;
        
        try{
            var input = require("./inputs/" + this.key);

            html = `
                <div class="form-group">
                <label for="${input.name}">${input.label} `;

            if( input.showHelp ) {
                html += `<a href='https://developer.mozilla.org/fr/docs/Web/CSS/${input.name}' class='text-primary' target='_blank'>?</a>`
            }
            
            html += "</label>"

            input.value = input.setValue ? input.setValue(this.getCSS()) : this.getCSS();
            
            if ( input.template ){
                html = html + input.template(input);
            } else {
                html = html + `<input type="${input.type}" class="form-control" id="${input.name}" name="${input.name}" value="${input.value}">`;
            }
            
            html = html + "</div>";
        } catch {
            if( this.type === "var" ){
                this.value = this.element.find("[data-key='" + this.key + "']").html();
            }

            html = `
                <div class="form-group">
                    <label for="${this.key}">${this.key}</label>
                    <input type="text" class="form-control" id="${this.key}" name="${this.key}" value="${this.value}" placeholder="${this.value}">
                </div>        
            `        
        }

        $(html).appendTo(this.parent);

        const selector = this.parent + ` *[name='${this.key}']`;
        let e_input = $(selector);

        e_input.on("change paste input", function(){
            let el = self.element;

            if( self.type === "var" ){
                let html = $(this).val()
                el.find("[data-key='" + self.key + "']").html(html)
                return;
            }

            if ( !input || !input.getValue ){
                el.css(self.key, $(this).val());
                return;
            }
            
            let val = input.getValue($(this).val());
            el.css(self.key, val);
        });

        e_input.on("enter", function(){
            $(this).change();
        });

        if( this.key.indexOf("color") != -1 ){
            let colorPicker = new ColorPicker.MultiSpectral(selector, {
                color: e_input.val(),
                format: 'rgba',
            })
            
            colorPicker.on('change', function(color) {
                e_input.change();
            });

            $(".c-container").on("click", function(){
                colorPicker.hide();
            });
        }
    }
}

module.exports = Input;