

$(document).ready(function () {

    console.log("hello");

    $("#products").on("click", ".add-to-cart", function (e) {
        e.preventDefault();

        let pid = $(this).data('pid');
        let price = $(this).data('price');
        let action = $(this).data('action');
        let pri = $(this).data('pri');

        // let txt = $(this).data('text');
        // // $("#tskid").val(txt);
        console.log("add click")
        $.ajax({
            method: "GET",
            url: "config.php",
            data: { id: pid, action: "add", price: price, pri: pri },
            //  dataType: "JSON"
        }).done(function (data) {
            console.log("after delete" + data["cart"]);
            let newdata = JSON.parse(data);
            console.log(newdata['cart']);
            let tprice = newdata['tprice'];
            let tqnty = newdata['tqnty'];
            console.log(tprice);
            disply(newdata, tprice, tqnty);

        });

    })

    $("#table").on("click", ".deletebtn", function (e) {
        e.preventDefault();
        let pid = $(this).data('pid');
        console.log("add click")
        $.ajax({
            method: "GET",
            url: "config.php",
            data: { id: pid, action: "delete" },
            //  dataType: "JSON"
        }).done(function (data) {

            //    console.log(newdata);
            let newdata = JSON.parse(data);
            console.log(newdata['cart']);
            let tprice = newdata['tprice'];
            let tqnty = newdata['tqnty'];
            console.log(tprice);
            disply(newdata, tprice, tqnty);

        });


    })

    function disply(data, x, y) {
        data = data['cart'];
        console.log(x);
        // $("#one").show();
        // console.log("indiply");
        let html = "<table><tr><th>product id</th><th>product price</th><th>Quantity</th><th>Action</th></tr>";
        for (let i = 0; i < data.length; i++) {
            console.log(i);
            html += "<tr><td>"
                + data[i].id +
                "</td><td>"
                + data[i].price +
                "</td><td>"
                + data[i].qnty +
                "</td><td>" +
                "<a href=" + " # class=deletebtn  data-pid=" + data[i].id + ">  delete</a>"
            "</td></tr>"

        }
        // console.log(html);
        // document.getElementById('table').innerHTML = html + "</table>";
        $("#table").html(html + "</table>");
        // resetInput();
        console.log(data['tprice']);
        $("#totalq").text("total price=>" + x);
        $("#totalp").text("total quantity=>" + y);

    }


})