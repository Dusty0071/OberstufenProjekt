(function() {
    TableFormatting();
})();

function TableFormatting() {
    var table = document.getElementById("linkTable");
    if (table) {
        var rows = table.getElementsByTagName("tr");
        for (let r = 0; r < rows.length; r++) {
            if (rows[r].getElementsByTagName("td").length > 0) {
                rows[r].addEventListener('click', function() {
                    var id = this.getElementsByTagName("td")[0].innerHTML;
                    window.location.href = window.location.origin + "/inhaltsseite.php?protokollId=" + id;
                });
            }
        }
    }
}

function DeleteLehrer(id){
    postAjax('http://fia63kaden.bplaced.net/pgotest/api.php','action=deleteLehrer&lehrerId='+id,function(data){
        var restult = JSON.parse(data);
        console.log(restult);
        if(restult.ok){
            alert(restult.message);
        }
        else {
            alert(restult.message);
            console.error(restult);
        }
    });
}



function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
    ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}