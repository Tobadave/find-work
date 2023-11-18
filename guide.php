

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
    <title>FindWork - Guide Manual</title>
  </head>
  <body>
    <div class="s006">

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
