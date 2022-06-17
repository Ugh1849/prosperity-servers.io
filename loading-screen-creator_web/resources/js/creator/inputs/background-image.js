module.exports = {
    label: __("input.background_image"),
    name: "background-image",
    type: "text",

    setValue: function(val)
    {
        return val.replace('url("', "").replace('")', "");
    },

    getValue: function(val)
    {
        return `url(${val})`;
    },
}