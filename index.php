<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script>
            $(document).ready(function(){
            $('#userForm').submit(function(){

            // Call ajax for pass data to other place
            $.ajax({
            type: 'POST',
            url: 'NationalCodeApp.php',
            data: $(this).serialize() // getting filed value in serialize form
            })
            .done(function(data){ // if getting done then call.
            
            function randomColor() {
                let c = "#";
                for (let i = 0; i < 6; i++) {
                c += (Math.random() * 16 | 0).toString(16);
            } 
                return c;
            }

                const a = document.getElementById("response").style;
                a.background = randomColor();
            //a.css("background-color", a.color) = ;
            
            // show the response
            $('#response').html(data);

            })
            .fail(function() { // if fail then getting message

            // just in case posting your form failed
            alert( "Posting failed." );

            });

            // to prevent refreshing the whole page page
            return false;

            });
            });
        </script>
        <script>
            function randomColor() {
                let c = "#";
                for (let i = 0; i < 6; i++) {
                c += (Math.random() * 16 | 0).toString(16);
            } 
                return c;
            }

            const a = document.getElementById("response").style;
            a.color = randomColor();
            while (a.color === '000000') {
                a.color === randomColor();
            }
        </script>
        <style>
            #response {
                color: black;
                background-color: yellow;
                padding: 5px;
                border: 1px solid black;
                text-align: center;
            }
            #userInput{
                color: black;
                background-color: white;
                padding: 10px;
                border: 1px solid black;
                font-size: 20px;
                height: 50px;
                width: 400px;
                margin-top: -180px;
                margin-bottom: 20px;
            }
            #submit {
                color: black;
                background-color: white;
                padding: 10px;
                border: 1px solid black;
                font-size: 20px;
                margin-top: -120px;
            }
            .centered {
                position: fixed; /* or absolute */
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .hidden {
                display: none;
            }
            .margin-top-10 {
                margin-top: -10px;
            }
            .margin-top-300 {
                margin-top: -300px;
            }
            .margin-top-270 {
                margin-top: -270px;
            }
            .margin-top-240 {
                margin-top: -240px;
            }
            .text-center {
                text-align: center;
            }
        </style>
        <meta name="keywords" content="تولید کد ملی,چک کردن کد ملی,iranian national ID,iranian national code,ساختار کد ملی,کد ملی ایران,کد ملی,ساخت کد ملی,create iranian natonal code,کد,ملی">
    </head>
    <body>
        <h2 class="centered margin-top-300 text-center">Iranian National Code Checker</h2>
        <h1 class="centered margin-top-270 text-center">And Generator</h1>
        <h2 class="centered margin-top-240 text-center">Created By Hazhir Ahmadzadeh</h2>
        <form id="userForm"> 
            <input id="userInput" class="centered" type="text" name="userCode" placeholder="Enter your national code"/>
            <input id="submit" class="centered" type="submit" name="submit"/>
        </form>
        <div class="centered margin-top-20" id='response'></div>
    </body>
</html>