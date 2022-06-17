module.exports = {
    label: __("input.opacity"),
    name: "opacity",
    type: "number",
    value: "50",

    setValue: function(val)
    {
        return val * 100
    },

    getValue: function(val)
    {
        return val / 100;
    },
}