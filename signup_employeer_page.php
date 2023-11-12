<?php

    require_once 'init.php';
    require_once 'functions.php';

    // $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    // checkIfNotLoggedInAndRedirect($redirectUrl);

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>SignUp Page</title>
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
                    height: 500px;
                    align-self: center;
                    border: 2px solid rgba(0, 0, 0, 0.363);
                    background-color: #ececec80;
                    backdrop-filter: blur(5px);
                    display: grid;
                    padding: 10px;
                    padding-bottom: 15px;
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
</head>
<body>

    
    <container class="navbar">
        <div style="display: flex; align-items: center; border-right: 1px solid rgb(2, 96, 2); padding-right: 40px;">
            <img class="logo" src="assets/images/findwork.png" alt="">
            <text style="color: rgb(2, 96, 2); font-weight: bold; font-size: 30px;">FindWORK</text>
        </div>

        <div class="center" style="width: 250px; margin-left: -200px;">
            <!-- <li><a href="">FEED</a></li> -->
            <li><a href="empposting.html"> POST JOBS</a></li>
            <li><a href="#"> CONTACT US</a></li>


        </div>

            <div class="right">
                <li>
                    <!-- <a href="manage.php">My Profile</a> -->
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
                        <h1 style="color: rgb(0, 41, 0);">EMPLOYER</h1>
                    </div>
                    <div class="down">
                        <form action="assets/php/signup_logic.php" method="POST">

                        <div>
                            <div class = form2>
                            <label for="">Employer Name</label>
                            <input type="text" placeholder="Full name" name="emp_name" required>
                            
                            <!-- <label for="">Email</label> -->
                            <input type="hidden" placeholder="Your business email" name="emp_email" value="<?php echo fetchUserDetails('id', $_SESSION['id'])['email']; ?>" required>
                            
                            <label for="">Comapny Name</label>
                            <input type="text" placeholder="Your company name" name="emp_comp_name" required>
                            
                            <label for="">Company Field</label>
                            <input type="text" placeholder="Your company's field..." name="emp_feild" required>
                        
                            <label for="">Location</label>
                            <input type="" inputmode="numeric" placeholder="Location.." name="emp_location" required>

                            <button type="submit">CONTINUE TO PROFILE &#8594;</button>
                            </div>
                        </div>
                    </form>

                </div>
           
                </div>


</body>
</html>