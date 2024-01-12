function search() {
    var searchTerm = document.getElementById('keresesInput').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('keresesEredmenyek').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "search.php?kereses=" + searchTerm, true);
    xhttp.send();

    return false;
}