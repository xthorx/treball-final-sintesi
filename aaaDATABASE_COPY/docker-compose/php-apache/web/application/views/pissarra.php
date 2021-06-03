<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="<?php echo base_url("assets/js/jquery-3.5.1.min.js")?>"></script>
    <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">

    <title>Activitat 3 - Canvas simple</title>
    
    <script>
        class CvClass {
            constructor(canvID,trueFalse) {
                this.idCanvas= canvID;
                this.tamanyStroke= 1;
                this.colorStroke= "#000000";
                
                this.currentDrawType= 0;
                
                this.initialX= 0;
                this.initialY= 0;
                
                this.finalX= 0;
                this.finalY= 0;
                
                
                
                
                this.canvasElement= document.getElementById(this.idCanvas);
                this.canvasElement.addEventListener("mousedown", this.canvasMouseDown.bind(this));
                this.canvasElement.addEventListener("mouseup", this.canvasMouseUp.bind(this));
                
                
                this.canvasWidth = this.canvasElement.width;
                this.canvasHeight = this.canvasElement.height;
                
                
                console.log(this.canvasWidth + ", " + this.canvasHeight);
                
                
                var divControllers = document.createElement("div");
                divControllers.setAttribute("class", "col-12");
                
                var buttonElegirTipus = document.createElement("button");
                buttonElegirTipus.appendChild(document.createTextNode("Linia"));
                buttonElegirTipus.setAttribute("id", "liniaButton");
                buttonElegirTipus.setAttribute("class", "btn btn-light");
                buttonElegirTipus.addEventListener("click", this.canviarALinea.bind(this));
                divControllers.appendChild(buttonElegirTipus);
                
                var buttonElegirTipus = document.createElement("button");
                buttonElegirTipus.appendChild(document.createTextNode("Cercle"));
                buttonElegirTipus.setAttribute("id", "cercleButton");
                buttonElegirTipus.setAttribute("class", "btn btn-light");
                buttonElegirTipus.addEventListener("click", this.canviarACercle.bind(this));
                divControllers.appendChild(buttonElegirTipus);
                
                var buttonElegirTipus = document.createElement("button");
                buttonElegirTipus.appendChild(document.createTextNode("Clear"));
                buttonElegirTipus.setAttribute("class", "btn btn-warning");
                buttonElegirTipus.addEventListener("click", this.clearCanvas.bind(this));
                divControllers.appendChild(buttonElegirTipus);


                var buttonElegirTipus = document.createElement("button");
                buttonElegirTipus.appendChild(document.createTextNode("Guardar"));
                buttonElegirTipus.setAttribute("class", "btn btn-primary");
                buttonElegirTipus.addEventListener("click", this.canvasToImage.bind(this));
                divControllers.appendChild(buttonElegirTipus);
                
                
                document.body.appendChild(divControllers);
                
                
                
                var divControllersRow = document.createElement("div");
                divControllersRow.setAttribute("class", "row");
                
                
                var divControllers = document.createElement("div");
                divControllers.setAttribute("class", "col-3 ml-auto");
                
                
                
                
                var afegirSpan = document.createElement("span");
                afegirSpan.appendChild(document.createTextNode("Gruix: 1"));
                afegirSpan.setAttribute("class", "col-12");
                afegirSpan.setAttribute("id", "gruixInfoID");
                divControllers.appendChild(afegirSpan);
                
                
                
                
                var afegirInput = document.createElement("input");
                
                afegirInput.setAttribute("type", "range");
                afegirInput.setAttribute("class", "col-12");
                afegirInput.setAttribute("min", "1");
                afegirInput.setAttribute("value", "1");
                afegirInput.addEventListener("change", this.canviGruixLinia.bind(this));
                afegirInput.addEventListener("mousemove", this.mostrarValorGruixActual.bind(this));
                
                afegirInput.setAttribute("id", "gruixLinia");
                divControllers.appendChild(afegirInput);
                
                document.body.appendChild(divControllersRow);
                divControllersRow.appendChild(divControllers);
                
                
                
                
                var divControllers = document.createElement("div");
                divControllers.setAttribute("class", "col-3 mr-auto");
                
                
                var afegirSpan = document.createElement("span");
                afegirSpan.appendChild(document.createTextNode("Color: #000000"));
                afegirSpan.setAttribute("class", "col-12");
                afegirSpan.setAttribute("id", "colorInfoID");
                divControllers.appendChild(afegirSpan);
                
                
                var afegirInput = document.createElement("input");
                
                afegirInput.setAttribute("type", "color");
                afegirInput.setAttribute("class", "col-12");
                afegirInput.addEventListener("change", this.canviColorLinia.bind(this));
                
                afegirInput.setAttribute("id", "colorLinia");
                divControllers.appendChild(afegirInput);
                
                
                divControllersRow.appendChild(divControllers);
                //-----------------
                
                
                
                
//              XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//              XXX- BINDINGS DE LES FUNCIONS -XXX
//              XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                
//                this.functionsExample = this.functionsExample.bind(this);
                this.canviGruixLinia = this.canviGruixLinia.bind(this);
                
//              XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//              XXX- BINDINGS DE LES FUNCIONS -XXX
//              XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                
                
                if(trueFalse==true){
                    this.canvasElement.addEventListener("mousemove", this.mostrarCoordenades.bind(this));
                }
                
                this.pintarBotoSeleccionat();
            }
            
            
            
            canvasMouseDown(){
                var x = event.clientX - this.canvasElement.offsetLeft;
                var y = event.clientY - this.canvasElement.offsetTop;
//                console.log(x);
//                console.log(y);
                
                this.initialX= x;
                this.initialY= y;
                
            }
            
            canvasMouseUp(){
                var x = event.clientX - this.canvasElement.offsetLeft;
                var y = event.clientY - this.canvasElement.offsetTop;
//                console.log(x);
//                console.log(y);
                
                this.finalX= x;
                this.finalY= y;
                
                this.drawCanvas();
                
            }
            
            

            drawCanvas(){
                
                var c = document.getElementById(this.idCanvas);
                var ctx = c.getContext("2d");
                
                if(this.currentDrawType==0){
                    ctx.beginPath();
                    ctx.moveTo(this.initialX, this.initialY);
                    ctx.lineTo(this.finalX, this.finalY);
                    ctx.lineWidth = this.tamanyStroke;
                    ctx.strokeStyle = this.colorStroke;
                    ctx.stroke();
                } else if(this.currentDrawType==1){
                    ctx.beginPath();
//                    ctx.moveTo(this.initialX, this.initialY);
                    
                    var radiusCalculate= Math.sqrt(((this.finalX-this.initialX)*(this.finalX-this.initialX))+((this.finalY-this.initialY)*(this.finalY-this.initialY)))
                    
//                    console.log(radiusCalculate);
                    
                    ctx.arc(this.initialX, this.initialY, radiusCalculate, 0, 2 * Math.PI);
                    ctx.lineWidth = this.tamanyStroke;
                    ctx.strokeStyle = this.colorStroke;
                    ctx.stroke();
                }
                
                

                
            }
            
//            functionsExample(){
//                
//                var c = document.getElementById(this.idCanvas);
//                var ctx = c.getContext("2d");
//                
//                
//                if(this.clearOrNot= 1){
//                //                    ctx.clearRect(0, 0, canvas.width, canvas.height);
//                ctx.clearRect(0, 0, 500, 250);
//                this.clearOrNot= 0;
//                }
//                
//                ctx.moveTo(0, 0);
//                ctx.lineTo(200, 100);
//                ctx.lineWidth = this.tamanyStroke;
//                ctx.strokeStyle = this.colorStroke;
//                ctx.stroke();
//                
//
//                
//            }
            
            
            canviGruixLinia(){
                var x= document.getElementById("gruixLinia").value;
                this.tamanyStroke= x;
                
            }
            
            canviColorLinia(){
                var x= document.getElementById("colorLinia").value;
                document.getElementById("colorInfoID").innerHTML= "Color: " + x;
                
                
                var x= document.getElementById("colorLinia").value;
                this.colorStroke= x;
                
                
                
                
            }
            
            mostrarValorGruixActual(){
                var x= document.getElementById("gruixLinia").value;
                document.getElementById("gruixInfoID").innerHTML= "Gruix: " + x;
            }
            
            
            pintarBotoSeleccionat(){
                
                if(this.currentDrawType== 0){
                    //Linia seleccionada
                    
                    document.getElementById("liniaButton").className= "btn btn-success";
                    document.getElementById("cercleButton").className= "btn btn-light";
                    
                    
                } else if(this.currentDrawType== 1){
                    //Cercle seleccionat
                    
                    document.getElementById("cercleButton").className= "btn btn-success";
                    document.getElementById("liniaButton").className= "btn btn-light";
                    
                    
                }
                
                
            }
            
            
            
            canviarALinea(){
                this.currentDrawType=0;
                this.pintarBotoSeleccionat();
            }
            
            canviarACercle(){
                this.currentDrawType=1;
                this.pintarBotoSeleccionat();
            }
            
            
            
            
            
            
            mostrarCoordenades(){
                
                var ctx = this.canvasElement.getContext("2d");
                ctx.clearRect(this.canvasWidth-50, this.canvasHeight-15, this.canvasWidth, this.canvasHeight);
                
                var x = event.clientX - this.canvasElement.offsetLeft;
                var y = event.clientY - this.canvasElement.offsetTop;
                
                ctx.font = "10px Arial";
                ctx.fillText(x + ", " + y,this.canvasWidth-43,this.canvasHeight-3);
                
                
                
            }
            
            
            clearCanvas(){
                var ctx = this.canvasElement.getContext("2d");
                ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight);
                
            }

            
            

            canvasToImage(){

                var myImage = this.canvasElement.toDataURL("image/png");

                document.body.innerHTML = "<img src='"+ myImage +"' class='border' id='imatgeCanvas'>";
            }





            

        }

    </script>
</head>

<body class="text-center">
    <canvas id="canvasDiv" width="500" height="250" style="background-color: lightgray;"></canvas>
    <script>
        var crono = new CvClass("canvasDiv",true);
    </script>
</body>

</html>