
<?php
require_once 'init.php';
require_once 'functions.php';
?>

<?php 

    $isLoggedIn = checkIfLoggedIn();

    if( $isLoggedIn )
    {
        include_once 'view-jobs.php';
        exit;
    }

?>

<html>
  <head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="assets/js/fontawesome@6.4.0.min.js"></script>
    <link href="assets/css/dashboard.css" rel="stylesheet" />
    <link href="assets/css/index.css" rel="stylesheet" />

    <!-- Load the marked library -->
    <script src="assets/js/marked_3.3.0.min.js"></script>
    <title>FindWork - Welcome</title>
  </head>
  <body>
    <div class="s006">
        <div class="logo d">
            <img src="assets/images/findwork.png" alt="Logo">
        </div>
        <div class="login-signup d">
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="signup.php">Signup</a>
            /
            <a href="login.php">Login</a>
        </div>
      <form action="login.php" class="d">
        <fieldset>
          <!-- <legend>What are you looking for?</legend> -->
          <div class="inner-form">
              <legend>What are you looking for?</legend>
                <div class="input-field">
                    <button class="btn-search" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </button>
                    <input id="search" type="text" placeholder="Search for jobs, employers, companys, etc..."  />
                </div>
          </div>
          <div class="suggestion-wrap">
            <span>Python</span>
            <span>PHP</span>
            <span>HTML</span>
            <span>Google</span>
            <span>Apple</span>
            <span>Microsoft</span>
            <span>Meta</span>
            <span>Amazon</span>
          </div>
        </fieldset>
      </form>

      <div id="root"></div>

      <footer>
        <br>
        <br>
        <center>
          <b>
          Copyright &copy; FindWork. 2023
          </b>
        </center>
        <br>
        <br>
      </footer>

    </div>


    <script>

      /**
       * Get the container element to display HTML content.
       * @type {HTMLElement}
       */
      const container = document.getElementById('root');

        /**
         * Fetch and process the contents of ReadMe.md.
         */
        fetch('./INDEX.md')
            .then(resp => resp.text())
            .then(data => {


                /**
                 * Convert markdown content to HTML using the marked library.
                 * @type {string}
                 */
                const htmlContents = marked(data);
                container.innerHTML = htmlContents;

              })
            .catch(error => {
                container.innerHTML = "<center><h1>AN ERROR OCCURED. KINDLY RELOAD THE PAGE. IF THIS MESSAGE  CONTINUES KINDLY CONTACT ME.</h1></center>";
            });

    </script>


  </body>
</html>
