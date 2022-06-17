HTMLElement.prototype.css = function(key, value){
    this.style[key] = value;
};

String.prototype.replaceAll = function(key, value){
    return this.replace(new RegExp(key, 'g'), value)
};

const body = document.querySelector("body");
const container = document.getElementsByClassName("c-container")[0]
var gameInfo = {};
var widgets = {};

for( var k in layout.body ){
    var v = layout.body[k];
    body.css(k, v);
}


if( layout.sound && layout.sound.src && layout.sound.src.length > 0 ){
    var audio = document.querySelector("#audio")

    if( audio ) {
        audio.src = layout.sound.src;
        audio.volume = layout.sound.volume;

        audio.addEventListener("canplay", function(){
            audio.play();
        }, false);
    }
}

function getWidth() {
    return Math.max(
        document.body.scrollWidth,
        document.documentElement.scrollWidth,
        document.body.offsetWidth,
        document.documentElement.offsetWidth,
        document.documentElement.clientWidth
    );
}

function getParams()
{
    var url = window.location.href;
	var params = {};
	var parser = document.createElement('a');
	parser.href = url;
	var query = parser.search.substring(1);
	var vars = query.split('&');
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split('=');
		params[pair[0]] = decodeURIComponent(pair[1]);
	}
	return params;
}

function isPreview(){
    return !(navigator.userAgent.indexOf("GMod") !== -1)
}

var params = getParams();

function fetch(url, callback)
{
    var xhrObject = new XMLHttpRequest();

    xhrObject.open("GET", url, true);

    xhrObject.onreadystatechange = function () {
        if (xhrObject.readyState === 4) {
            callback(xhrObject.response)
        }
    }

    xhrObject.send(null);
}

function createWidget(name)
{
    const widget = widgets[name];

    var innerDiv = document.createElement('div');
    innerDiv.className = 'draggable';
    innerDiv.innerHTML = widget.template || "";

    for( var k in widget.css ){
        var v = widget.css[k];
        innerDiv.css(k, v);
    }

    container.appendChild(innerDiv);

    return innerDiv;
}

function loadWidgets()
{
    for( var k in layout.widgets ){
        var v = layout.widgets[k];
        var el_widget = createWidget(v.name);

        for( var kk in v.css ){
            var value = v.css[kk];

			if(kk === "inset") {
				var values = v.css[kk].split(" ")

				switch(values.length) {
					case 0:
						el_widget.css("top", values[0])
						el_widget.css("left", values[0])
						// el_widget.css("right", values[0])
						// el_widget.css("bottom", values[0])
						break

					case 2:
						el_widget.css("top", values[0])
						el_widget.css("left", values[1])
						// el_widget.css("right", values[1])
						// el_widget.css("bottom", values[0])
						break;

					case 3:
						el_widget.css("top", values[0])
						el_widget.css("left", values[1])
						// el_widget.css("right", values[1])
						// el_widget.css("bottom", values[2])
						break;

					case 4:
						el_widget.css("top", values[0])
						el_widget.css("left", values[3])
						// el_widget.css("right", values[1])
						// el_widget.css("bottom", values[2])
						break;

					default:
						el_widget.css("inset", v.css[kk])
				}

				continue
			}

            if( kk === "font-size" ) {
                value = value.substr(0, value.length - 2)
                value = (value / 100 * getWidth()) + "px"
            }

            el_widget.css(kk, value);
        }

        for( var kk in v.vars ){
            var value = v.vars[kk];

            el_widget.querySelector("*[data-key='" + kk + "']").innerHTML = value;
        }
    }
}

function loadVariables()
{
    var html = container.innerHTML;

    for( var k in gameInfo ){
        var v = gameInfo[k];

        html = html.replaceAll("{{ " + k + " }}", v);
    }

    for( var k in user ){
        var v = user[k]

        html = html.replaceAll("{{ " + k + " }}", v);
    }

    container.innerHTML = html;

    var dataDownload = container.querySelector("*[data-download]")

    container.querySelectorAll(".user_avatar").forEach(function(avatar) {
        avatar.parentElement.style.backgroundImage = "url(" + user.user_avatar + ")";
    })


    if( dataDownload ) {
        dataDownload.innerHTML = "Connecting to the server...";
    }
}

fetch(window.base_url + "/api/widgets?steamid=" + params["steamid"], function(res){
    var json = JSON.parse(res);

    for (var index = 0; index < json.length; index++) {
        var element = json[index];

        widgets[element.name] = element;
    }
});

var loaded = setInterval(function() {
    if( ( !window.gameInfo || !window.gameInfo.name ) && !isPreview() ){ return; }
    if( Object.keys(widgets).length < 1 ) return;

    loadWidgets();
    loadVariables();

    var progress_bars = container.getElementsByClassName("progress_bar");

    for (var index = 0; index < progress_bars.length; index++) {
        const element = progress_bars[index];

        element.parentNode.initialWidth = element.parentNode.style.width.replace("%", "")
        element.parentNode.style.width = "0%"
    }

    if( isPreview() ){
        preview()
    }

    clearInterval(loaded);
}, 500);

// Gmod called functions

var filesDownloaded = 0
var filesNeeded = 1
var filesTotal = 1

function SetFilesTotal(numFiles) {
    filesTotal = Math.max(0, numFiles);

    // var progress_totals = document.querySelectorAll(".files_count_total")
    // for (var index = 0; index < progress_totals.length; index++) {
    //     progress_totals[index].innerHTML = filesTotal;
    // }
}

function DownloadingFile(fileName) {
    filesDownloaded++
    filesNeeded = Math.max(0, filesNeeded - 1);

    var dtDownload = container.querySelector("*[data-download]");

    if( dtDownload ) dtDownload.innerHTML = 'Downloading "' + fileName +'"';

    progressBarRefresh()
}

function SetStatusChanged(status){
    if( status.indexOf("Loading") !== -1 || status.indexOf("Download") !== -1 ) {
        filesDownloaded++
    }

    var dtDownload = container.querySelector("*[data-download]");

    if( dtDownload ) dtDownload.innerHTML = status;

    progressBarRefresh()
}

function SetFilesNeeded( needed ) {
    filesNeeded = Math.max(needed, filesNeeded)

    var progress_totals = document.querySelectorAll(".files_count_total")
    for (var index = 0; index < progress_totals.length; index++) {
        progress_totals[index].innerHTML = filesNeeded;
    }

    progressBarRefresh()
}

function progressBarRefresh() {
    var filesRemaining = Math.max(0, filesTotal - filesNeeded)
    var percentage = Math.max(1, filesNeeded !== 0 ? filesRemaining / filesTotal : 1)


    var progress_actuals = document.querySelectorAll(".files_count_actual")
    for (var index = 0; index < progress_actuals.length; index++) {
        progress_actuals[index].innerHTML = Math.min(filesDownloaded, filesNeeded);
    }

    var progress_bars = container.getElementsByClassName("progress_bar");

    for (var index = 0; index < progress_bars.length; index++) {
        var element = progress_bars[index];

        element.parentNode.style.width = (element.parentNode.initialWidth * percentage) + "%"
    }
}

/*
    Preview
*/

function preview() {
    SetFilesNeeded(300)

    var downloadingInterval = setInterval(function() {
        DownloadingFile("example" + filesDownloaded + ".png")
        if ( filesDownloaded > filesNeeded ) {
            clearInterval(downloadingInterval)
        }
    }, 100)
}