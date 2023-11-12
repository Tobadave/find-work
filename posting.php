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
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }
    .contain{
        /* border: 3px solid; */
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
        grid-template-rows: 70px 1fr 50px;
        width: 30%;
        height: 600px;
        border: 1px solid;
    }
    .div{
        padding: 20px;
        /* border: 1px solid; */
        display: flex;
        flex-direction: column;
        }
        .one{
            padding: 0px 15px;
        }
        button{
            color: white;
            padding: 7px 0px;
            border-radius: 5px;
            font-weight: bold;
            float: right;
            margin: 5px;
            background-color: rgb(0, 175, 0);
            border: none;
            transition-duration: 0.2s;

            /* margin-right: 5px; */
        }

        button:hover{
                cursor: pointer;
                background-color: rgb(1, 128, 1);
            }

        /* a{
            text-decoration: none;
        } */

        input:last-child{
            font-size: 12px;
            background-color: white;
        }
        input:first-child{
            height: 60px;
            font-size: 25px;
            font-weight: bold;
            text-transform: uppercase;
        }
        input{
            color: rgb(0, 97, 0);
            font-size:18px ;
            background-color: rgba(255, 255, 255, 0.143);
            height: 30px;
            margin-bottom: 6px;
            outline: none;
            border-radius: 5px;
            border: 0.5px;
            padding: 5px 10px;

        }
</style>
<body>

    
    <container class="navbar">
        <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
            <img class="logo" src="assets/images/findwork.png" alt="">
            <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        </div>

        <div class="center">
            <li><a href="posting.html">FEED</a></li>
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
                <div class="contain">
                    <div class="posting">
                        <div class="one">
                            <h2 style="color: rgb(1, 87, 1); border-bottom: 1px solid;">Available Jobs</h2>
                        </div>
                        <div class="div">
                            <input type="text" placeholder="Title" disabled>
                            <input type="text" placeholder="description" disabled>
                            <input type="text" placeholder="skill needed" disabled>
                            <input type="text" placeholder="location" disabled>
                            <input type="number" placeholder="salary" disabled>
                            <input type="date" placeholder="Deadline" disabled>
                            <input type="text" placeholder="Enter your resume link">
                        </div>
                        <div class="div" style="justify-content: center;">
                            <button>Send Application</button>
                        </div>

                    </div>
                    <div class="posting">

                    </div>
                    <div class="posting">

                    </div>
                </div>
            </div>


</body>
</html>