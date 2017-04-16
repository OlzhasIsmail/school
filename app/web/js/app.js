var favMovies = new Firebase('https://texttransfer-7c612.firebaseio.com/'+ username +'/codes');
 

function refreshCode(text) {
    //document.getElementById('code').innerHTML = text;
    //var str = text;
    document.getElementById('code').value = text;
}
 

favMovies.on("value", function(snapshot) {
    var data = snapshot.val();
    var list = [];
    var text = "";
    for (var key in data) {
        if (data.hasOwnProperty(key)) {
            text = data[key].text ? data[key].text : '';
            // name = data[key].text ? data[key].text : '';
            // if (name.trim().length > 0) {
            //     list.push({
            //         name: name
            //     })
            // }
        }
    }
    refreshCode(text);
    // refresh the UI
    
});


