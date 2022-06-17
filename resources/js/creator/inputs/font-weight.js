module.exports = {
    label: __("input.font_weight"),
    name: "font-weight",
    type: "select",
    value: "0",
    
    template: (self) => {
        return `
            <select name="font-weight" id="font-weight" class="form-control">
                <option value="normal" ${self.value === "400" ? "selected" : ""}>Normal</option>
                <option value="bold" ${self.value === "700" ? "selected" : ""}>Bold</option>
                <option value="lighter" ${self.value === "100" ? "selected" : ""}>Light</option>
            </select>
        `
    }
}