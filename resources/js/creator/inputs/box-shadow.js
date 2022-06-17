module.exports = {
    label: __("input.box_shadow"),
    name: "box-shadow",
    type: "text",
    showHelp: true,
    
    setValue(val) {
        return val.split(") ").reverse().join(" ") + ")"
    }
}