$(document).ready(function () {
    /* TABLE COMPRAS */
    let thetable1 = document.getElementById('tableCompras').getElementsByTagName('tbody')[0];

    for (let i = 0; i < thetable1.rows.length; i++) {
        thetable1.rows[i].onclick = function () {
            TableRowClickCompras(this);
        };
    }

    function TableRowClickCompras(therow) {
        let NoFactura = document.querySelector('#NoFactura');

        NoFactura.value = therow.cells[2].innerHTML;
    };

    /* FINAL DEL DOCUMENT READY */
});

