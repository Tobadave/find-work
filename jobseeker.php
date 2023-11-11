<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Application_form.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <title>Document</title>
</head>
<style>
    body{
        padding: 0px;
        margin: 0px;
    
    } 
    .cont{
        outline:2px solid green;
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        height: 100vh;
    }
    .contain{
        border: 3px solid;
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: row;
        flex: 1 1 1;
        padding: 10px;
        justify-content: space-evenly;

    }
    .posting{
        background-color: rgb(220, 220, 220);
        display: grid;
        grid-template-rows: 50px 1fr 50px;
        width: 30%;
        height: 300px;
        border: 1px solid;
    }
    .div{
        padding: 2px;
        }
        .one{
            padding: 2px;
        }
        button{
            float: right;
            margin: 5px;
            /* margin-right: 5px; */
        }

        /* a{
            text-decoration: none;
        } */

        .background { 
            width: 90%;
            height: 600px;
            align-self: center;
            border: 2px solid rgba(0, 0, 0, 0.363);
            background-color: #ececec80;
            backdrop-filter: blur(5px);
            display: grid;
            padding: 10px;
            padding-bottom: 20px;
            grid-template-rows: 50px 1fr;
            border-radius: 8px;

            .up,.down {
                padding:0px;
                /* border: 1px solid; */
                height: auto;
                display: flex;
                /* flex-direction: rows; */
                justify-content: center;
                
                align-items: center;

            }

        }
        input{
                outline: none;
                border-radius: 5px;
                border: none;
                height: 20px;
                padding: 5px 10px;
                margin-bottom: 15px;
            }
            input:last-child{
                border-radius: none;
                border: none;

            }
            label{
                font-size: 13px;
                font-weight: 600;
                margin-left: 10px;
                margin-bottom:5px;
            }
            .form2{
                border: 2px solid green; padding:10px; display:flex; flex-direction: column;
                width: 500px; border-radius: 10px; justify-content: none;
                background-color: rgba(0, 128, 0, 0.044);
            }
            button{
                background-color: rgb(0, 98, 0);
                color: white;
                font-weight: bold;
                padding: 0px 20px;
                border: none;
                border-radius:7px;
                padding: 10px;
            }
            button:hover{
                cursor: pointer;
            }
</style>
<body>

    
    <container class="navbar">
        <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
            <img class="logo" src="assets/images/findwork.png" alt="">
            <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        </div>

        <div class="center">
            <li><a href="">FEED</a></li>
            <li><a href=""> HOME</a></li>
            <li><a href=""> CONTACT US</a></li>


        </div>

            <div class="right">
                <li>
                    <a href="manage.php">My Profile</a>
                </li>
                <li style="margin-left: 20px;">
                    <a href="logout.php">Log out</a>
                </li>
            </div>
        </container>

            <div class="cont">
                <!-- <div class="contain">
                    
                    <div class="posting">
                        <div>
                            okay
                        </div>
                        <div>
                            okay
                        </div>
                        <div>
                            <button>POST JOB</button>
                        </div>

                    </div>
                    <div class="posting">

                    </div>
                    <div class="posting">

                    </div>
                </div> -->
                
                <div class="background">
                    <div class="up">
                        <h1 style="color: rgb(0, 41, 0);"> JOB SEEKER </h1>
                    </div>
                    <div class="down">
                        <form method="POST">

                        <div>
                            <div class = form2>
                            <label for="">Email</label>
                            <input type="email" placeholder="">
                            
                            <label for="">First Name</label>
                            <input type="text" placeholder="">
                            
                            <label for="">Last Name</label>
                            <input type="text" placeholder="">
                            
                            <label for="">Phone number</label>
                            <input type="number" placeholder="">
                                                   
                            <label for="">Skills</label>
                            <input type="text"  placeholder="">
                            
                            <label for="">Educatiion History</label>
                            <input type="text" placeholder="">

                            <!-- <label for="">Experience and participations </label>
                            <input type="text" placeholder="Experiences" > -->

                            <label for="">Resume link</label>
                            <input type="text" placeholder="A link to your resume" >
                            <button>CONTINUE TO PROFILE &#8594; </button>
                            </div>
                        </div>
                    </form>

                </div>
           
                </div>


</body>
</html>