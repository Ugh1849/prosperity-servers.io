module.exports = {
    label: __("input.font_family"),
    name: "font-family",
    type: "select",
    
    template: (self) => {
        let html = `<select name="font-family" id="font-family" class="form-control">`;

        for(var k in fonts){
            html += `<option value="${k}" ${self.value === k ? "selected" : ""}>${k}</option>`;
        }

        html += `</select>`;

        return html;
    }
}