<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body onload="init()">

    <div class="container vh-90 mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-7 ">
                <div class="card m-3 p-3  vh-90">
                    <div class="card-body ">


                        <div>
                            <canvas id="can" width="400" height="400"
                                style="position:absolute;top:10%;left:10%;border:2px solid;"></canvas>

                            <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
                            <input type="button" value="done" id="btn" size="30" onclick="done()"
                                style="position:absolute;top:55%;left:10%;" class="btn btn-success">
                            <input type="button" value="clear" id="clr" size="23" onclick="erase()"
                                style="position:absolute;top:55%;left:15%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        var canvas, ctx, flag = false,
            prevX = 0,
            currX = 0,
            prevY = 0,
            currY = 0,
            dot_flag = false;

        var x = "black",
            y = 2;

        function init() {
            canvas = document.getElementById('can');
            ctx = canvas.getContext("2d");
            w = canvas.width;
            h = canvas.height;

            canvas.addEventListener("mousemove", function(e) {
                findxy('move', e)
            }, false);
            canvas.addEventListener("mousedown", function(e) {
                findxy('down', e)
            }, false);
            canvas.addEventListener("mouseup", function(e) {
                findxy('up', e)
            }, false);
            canvas.addEventListener("mouseout", function(e) {
                findxy('out', e)
            }, false);
        }

        // function color(obj) {
        //     switch (obj.id) {
        //         case "green":
        //             x = "green";
        //             break;
        //         case "blue":
        //             x = "blue";
        //             break;
        //         case "red":
        //             x = "red";
        //             break;
        //         case "yellow":
        //             x = "yellow";
        //             break;
        //         case "orange":
        //             x = "orange";
        //             break;
        //         case "black":
        //             x = "black";
        //             break;
        //         case "white":
        //             x = "white";
        //             break;
        //     }
        //     if (x == "white") y = 14;
        //     else y = 2;

        // }

        function draw() {
            ctx.beginPath();
            ctx.moveTo(prevX, prevY);
            ctx.lineTo(currX, currY);
            ctx.strokeStyle = x;
            ctx.lineWidth = y;
            ctx.stroke();
            ctx.closePath();
        }

        function erase() {
            var m = confirm("Want to clear");
            if (m) {
                ctx.clearRect(0, 0, w, h);
                document.getElementById("canvasimg").style.display = "none";
            }
        }

        function done() {
            document.getElementById("canvasimg").style.border = "2px solid";
            var dataURL = canvas.toDataURL();
            document.getElementById("canvasimg").src = dataURL;
            document.getElementById("canvasimg").style.display = "inline";
        }

        function findxy(res, e) {
            if (res == 'down') {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;

                flag = true;
                dot_flag = true;
                if (dot_flag) {
                    ctx.beginPath();
                    ctx.fillStyle = x;
                    ctx.fillRect(currX, currY, 2, 2);
                    ctx.closePath();
                    dot_flag = false;
                }
            }
            if (res == 'up' || res == "out") {
                flag = false;
            }
            if (res == 'move') {
                if (flag) {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX - canvas.offsetLeft;
                    currY = e.clientY - canvas.offsetTop;
                    draw();
                }
            }
        }
    </script>
</body>

</html>
