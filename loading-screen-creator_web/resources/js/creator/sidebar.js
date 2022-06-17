const C_Input = require("./input")

export default (Creator) => {
    const e_switcher = $(".panel-config__switcher.switcher");
    const e_Move = $(".panel-config__move");
    
    let ls_isOpen = localStorage.getItem("sidebar_open");
    let ls_Position = localStorage.getItem("sidebar_position");

    if( !ls_isOpen ){
        ls_isOpen = "true";
    }

    if( !ls_Position ){
        ls_Position = "right";
    }

    e_switcher.on("click", function(){
        let direction = $(this).attr("data-direction");
        let parent = $(this).parent();

        Creator.toggleSidebar(parent, false, direction)
    });

    e_Move.click(function(){
        let parent = $(this).parent();
        let direction = $(this).attr("data-direction");


        Creator.moveSidebar(parent, false, direction);
    });

    if ( ls_isOpen === "true" ){
        Creator.toggleSidebar($(".panel-config"), true, ls_Position);
    }

    if( ls_Position ){
        Creator.moveSidebar($(".panel-config"), true, ls_Position)
    }
}