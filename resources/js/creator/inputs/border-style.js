module.exports = {
    label: __("input.border_style"),
    name: "border-style",
    type: "select",
    value: "0",
    
    template: (self) => {
        return `
            <select name="border-style" id="border-style" class="form-control">
                <option value="none" ${self.value === "none" ? "selected" : ""}>None</option>
                <option value="solid" ${self.value === "solid" ? "selected" : ""}>Solid</option>
                <option value="dotted" ${self.value === "dotted" ? "selected" : ""}>Dotted</option>
                <option value="dashed" ${self.value === "dashed" ? "selected" : ""}>Dashed</option>
                <option value="double" ${self.value === "double" ? "selected" : ""}>Double</option>
                <option value="groove" ${self.value === "groove" ? "selected" : ""}>Groove</option>
                <option value="ridge" ${self.value === "ridge" ? "selected" : ""}>Ridge</option>
                <option value="inset" ${self.value === "inset" ? "selected" : ""}>Inset</option>
                <option value="outset" ${self.value === "outset" ? "selected" : ""}>Outset</option>
            </select>
        `
    }
}