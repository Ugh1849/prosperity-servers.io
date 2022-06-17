module.exports = {
    label: __("input.border_radius"),
    name: "border-radius",
    type: "text",
    value: "0",
    showHelp: true,
    
    setValue: function(val)
    {
        return val.replace(/(px)/g, "");
    },
    
    getValue: function(val)
    {
        return val.replace(/([0-9]+)/g, "$1px ");
    },
}