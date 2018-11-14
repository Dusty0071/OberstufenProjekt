(function() {
    TableFormatting();
 })();

function TableFormatting(){
    //inhaltsseite.php?protokollid=
    var tables = document.getElementsByTagName("table")
    if(tables.length>0){
        for (let i = 0; i < tables.length; i++) {
            var rows = tables[i].getElementsByTagName("tr");
            for (let r = 0; r < rows.length; r++) {
                if(rows[r].getElementsByTagName("td").length>0){
                    var id = rows[r].getElementsByTagName("td")[0].innerHTML;
                    // console.log(id);
                    rows[r].addEventListener('click', function(){
                        window.location.href = window.location.origin+"/inhaltsseite.php?protokollid="+id;
                    });
                }
            }
        }
    } 
}
