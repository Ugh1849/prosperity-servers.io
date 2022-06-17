module.exports = {
    label: __("input.font_size"),
    name: "font-size",
    type: "number",
    value: "24",
    
    setValue: function(val)
    {
        return Math.floor((val.replace("vw", "").replace("%", "").replace("px", "")) / 0.768);
    },

    getValue: function(val)
    {
        return (val/25) + "vw";
    },
}