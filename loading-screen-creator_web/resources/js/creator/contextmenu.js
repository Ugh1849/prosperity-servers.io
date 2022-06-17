$(function(){
    const menu = $(".menu");
    let menuVisible = false;

    const toggleMenu = command => {
        menu.css("display", command === "show" ? "block" : "none");

        if( command = "show") 
            menuVisible = true;
        else 
            menuVisible = false;
    }

    const setPosition = ({top, left}) => {
        menu.css("left", `${left}px`);
        menu.css("top", `${top}px`);
    
        toggleMenu("show");
    };

    $(window).on("click", e => {
        if(menuVisible) toggleMenu("hide");
    });

    $(window).on("contextmenu", e => {
        e.preventDefault();

        const origin = {
            left: e.pageX,
            top: e.pageY
        };

        setPosition(origin);

        if( $(".selected").length !== 0 ) {
            $("#deleteWidgetOption").removeClass("d-none");
        } else {
            $("#deleteWidgetOption").addClass("d-none");
        }

        return false;
    });

    $("#addWidgetBtn").on("click", function() {
        $("#addWidgetModal").modal("hide");

        const widgetName = $("#addWidgetModalSelect").val();

        window.widgets.create(widgetName);
    })

    $("#deleteWidgetOption").on("click", function() {
        const element = $(".selected")[0];
        
        window.widgets.remove(element);
    })

    $("#backToTheCreatorBtn").on("click", function() {
        window.location.href = window.location.href.split("/").slice(0, -1).join("/");
    })

    $("#renameLayoutBtn").on("click", function() {
        const element = $("#layout_new_name")

        if( element.val().length > 32 ) {
            alert("The new layout name is too long");
            return;
        }
        
        if( element.val().length < 1 ) {
            alert("The new layout name is too short");
            return;
        }

        $("#renameLayout").modal("hide");

        const currentLayoutName = window.location.pathname.split("/creator/")[1]

        $.ajax({
            url: window.base_url + "/api/widgets/" + currentLayoutName,
            type: "PATCH",
            data: {
                newName: element.val()
            },
            statusCode: {
                404: function() {
                    alert("Unknown layout, you will be redirected");
                    window.location.href = window.base_url + "/creator";
                }
            }
        })
            .done(function() {
                alert("Layout renamed");
                element.val("")
            });
    })

    $("#save-layout-btn").on("click", function(){
        creator.save();
    });
});