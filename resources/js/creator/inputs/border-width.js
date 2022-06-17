module.exports = {
    label: __("input.border_width"),
    name: "border-width",
    type: "text",
    value: "24",
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