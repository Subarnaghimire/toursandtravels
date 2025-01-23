function search() {
    let input, filter, table, tr, td, txtValue;
    input = document.getElementById("find");
    filter = input.value.toUpperCase();
    table = document.getElementById("packageTable");
    tr = table.getElementsByTagName("tr");

    for (let i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function toLogout() {
    swal({
      title: "Are you Sure?",
      text : "You want to logout",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willLogout) => {
      if (willLogout) {
        window.location.href = "../Backend/logout.php";
      }
    });
}

function forAction(message, location){
    swal({
        title: "Are you Sure?",
        text : message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willdo) => {
        if (willdo) {
          window.location.href = location;
        }
      });
}