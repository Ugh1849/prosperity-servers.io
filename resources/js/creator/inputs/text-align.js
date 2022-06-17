module.exports = {
    label: __("input.text_align"),
    name: "text-align",
    type: "select",
    value: "center",
    
    template: (self) => {
        return `
            <select name="text-align" id="text-align" class="form-control">
                <option value="left" ${self.value === "left" ? "selected" : ""}>Left</option>
                <option value="center" ${self.value === "center" ? "selected" : ""}>Center</option>
                <option value="right" ${self.value === "right" ? "selected" : ""}>Right</option>
            </select>
        `
    }
}