module.exports = {
    label: __("input.height"),
    name: "height",
    type: "number",
    value: "0",

    setValue: function(val)
    {
        const h = document.documentElement.clientHeight;

        if( val.indexOf("px") === -1 ){
            return val.replace("%", "");
        }

        let px = val.replace("px", "");

        return Math.round(px * 100 / h);
    },


    getValue: function(val)
    {
        return val + "%";
    },
}