module.exports = {
    label: __("input.width"),
    name: "width",
    type: "number",
    value: "0",

    setValue: function(val)
    {
        const w = document.documentElement.clientWidth;

        if( val.indexOf("px") === -1 ){
            return val.replace("%", "");
        }

        let px = val.replace("px", "");

        return Math.round(px * 100 / w);
    },

    getValue: function(val)
    {
        return val + "%";
    },
}