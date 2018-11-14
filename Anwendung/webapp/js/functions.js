(function() {
    TableFormatting();
})();

function TableFormatting() {
    //inhaltsseite.php?protokollid=
    var table = document.getElementById("linkTable");
    var rows = table.getElementsByTagName("tr");
    for (let r = 0; r < rows.length; r++) {
        if (rows[r].getElementsByTagName("td").length > 0) {
            rows[r].addEventListener('click', function() {
                var id = this.getElementsByTagName("td")[0].innerHTML;
                window.location.href = window.location.origin + "/inhaltsseite.php?protokollid=" + id;
            });
        }
    }
}