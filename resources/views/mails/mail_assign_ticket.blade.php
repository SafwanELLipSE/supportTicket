<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Ticket</title>

    <style media="screen">
    /* -------------------------------------
        GLOBAL
    ------------------------------------- */
    * {
        margin: 0;
        padding: 0;
    }

    * {
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    }

    img {
        max-width: 100%;
    }

    .collapse {
        margin: 0;
        padding: 0;
    }

    body {
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: none;
        width: 100%!important;
        height: 100%;
    }


    /* -------------------------------------
        ELEMENTS
    ------------------------------------- */
    a {
        color: #c31a45;
    }

    .btn {
        text-decoration: none;
        color: #FFF;
        background-color: #666;
        padding: 10px 16px;
        font-weight: bold;
        margin-right: 10px;
        text-align: center;
        cursor: pointer;
        display: inline-block;
    }

    .callout {
    padding: 15px;
    border-color: #ccc !important;
    margin-bottom: 15px;

    border-top:1px dashed;
      border-bottom:1px dashed;
    }
    .callout h1 {color:#532d42 !important;font-weight:bold}

    .callout a {
        font-weight: bold;

    }

    table.social {
    /* 	padding:15px; */
        background-color: #F4F5F6;
      border-bottom: 1px solid #ccc;
    }

    .social .soc-btn {
        padding: 3px 7px;
        font-size: 12px;
        margin-bottom: 10px;
        text-decoration: none;
        color: #FFF;
        font-weight: bold;
        text-align: center;
    }

    a.fb {
        background-color: #3B5998!important;
    }

    a.tw {
        background-color: #1daced!important;
    }

    a.gp {
        background-color: #DB4A39!important;
    }

    a.ms {
        background-color: #000!important;
    }

    .inline-button {padding: 5px 10px;
      text-decoration:none;
      cursor:pointer;
    font-size: 12px;
    line-height: 1.5;
      border-radius: 3px;
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
      color: #fff;
    background-color: #b32243;
    border-color: #512f40;
      font-weight:normal !important
    }

    .sidebar .soc-btn {
        display: block;
        width: 100%;
    }

    /* -------------------------------------
        HEADER
    ------------------------------------- */
    table.head-wrap {
        width: 100%;
      border-bottom:1px solid #ccc;
    }

    .header.container table td.logo {
        padding: 15px;
    }

    .header.container table td.label {
        padding: 15px;
        padding-left: 0px;
    }


    /* -------------------------------------
        BODY
    ------------------------------------- */
    table.body-wrap {
        width: 100%;
    }


    /* -------------------------------------
        FOOTER
    ------------------------------------- */
    table.footer-wrap {
        width: 100%;
        clear: both!important;
    }

    .footer-wrap .container td.content  p {
        border-top: 1px solid rgb(215,215,215);
        padding-top: 15px;
    }

    .footer-wrap .container td.content p {
        font-size: 10px;
        font-weight: bold;
    }


    /* -------------------------------------
        TYPOGRAPHY
    ------------------------------------- */
    h1,h2,h3,h4,h5,h6 {
        font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        line-height: 1.1;
        margin-bottom: 15px;
        color: #777;
    }

    h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
        font-size: 60%;
        color: #6f6f6f;
        line-height: 0;
        text-transform: none;
    }

    h1 {
        font-weight: 200;
        font-size: 30px;
    }

    h2 {
        font-weight: 200;
        font-size: 26px;
    }

    h3 {
        font-weight: 500;
        font-size: 22px;
    }

    h4 {
        font-weight: 500;
        font-size: 20px;
    }

    h5 {
        font-weight: 900;
        font-size: 16px;
    }

    h6 {
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        color: #444;
    }

    .collapse {
        margin: 0!important;
    }

    p, ul {
        margin-bottom: 10px;
        font-weight: normal;
        font-size: 14px;
        line-height: 1.6;
        color:#7f8c8d
    }

    p.lead {
        font-size: 17px;
      margin-bottom:30px
    }

    p.last {
        margin-bottom: 0px;
    }

    ul li {
        margin-left: 5px;
        list-style-position: inside;
    }

    /* -------------------------------------
        SIDEBAR
    ------------------------------------- */
    ul.sidebar {
        background: #ebebeb;
        display: block;
        list-style-type: none;
    }

    ul.sidebar li {
        display: block;
        margin: 0;
    }

    ul.sidebar li a {
        text-decoration: none;
        color: #666;
        padding: 10px 16px;
    /* 	font-weight:bold; */
        margin-right: 10px;
    /* 	text-align:center; */
        cursor: pointer;
        border-bottom: 1px solid #777777;
        border-top: 1px solid #FFFFFF;
        display: block;
        margin: 0;
    }

    ul.sidebar li a.last {
        border-bottom-width: 0px;
    }

    ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p {
        margin-bottom: 0!important;
    }



    /* ---------------------------------------------------
        RESPONSIVENESS
        Nuke it from orbit. It's the only way to be sure.
    ------------------------------------------------------ */

    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
    .container {
      display:block!important;
      max-width:600px!important;
      margin:0 auto!important; /* makes it centered */
      clear:both!important;
    }

    /* This should also be a block element, so that it will fill 100% of the .container */
    .content {
      padding:15px;
      max-width:600px;
      margin:0 auto;
      display:block;
    }

    /* Let's make sure tables in the content area are 100% wide */
    .content table {
        width: 100%;
    }


    /* Odds and ends */
    .column {
        width: 300px;
        float: left;
    }

    .column tr td {
        padding: 15px;
    }

    .column-wrap {
        padding: 0!important;
        margin: 0 auto;
        max-width: 600px!important;
    }

    .column table {
        width: 100%;
    }

    .social .column {
        width: 280px;
        min-width: 279px;
        float: left;
    }

    /* Be sure to place a .clear element after each set of columns, just to be safe */
    .clear {
        display: block;
        clear: both;
    }


    /* -------------------------------------------
        PHONE
        For clients that support media queries.
        Nothing fancy.
    -------------------------------------------- */
    @media only screen and (max-width: 600px) {

        a[class="btn"] {
            display: block!important;
            margin-bottom: 10px!important;
            background-image: none!important;
            margin-right: 0!important;
        }

        div[class="column"] {
            width: auto!important;
            float: none!important;
        }

        table.social div[class="column"] {
            width: auto!important;
        }
    }
    </style>
</head>
<body>
  <!-- HEADER -->
  <table class="head-wrap" bgcolor="#F4F5F6">
    <tr>
      <td></td>
      <td class="header container">

          <div class="content">
            <table bgcolor="#F4F5F6">
            <tr>
              <td><img src="https://drive.google.com/uc?export=view&id=1jmypQc23QPk5QkuDkHkLbneRqVgcyxyC" width="100" /></td>
              <td align="right"><h6 class="collapse">{{	date("l jS \of F Y") }}</h6></td>
            </tr>
          </table>
          </div>

      </td>
      <td></td>
    </tr>
  </table><!-- /HEADER -->


      <!-- BODY -->
      <table class="body-wrap">
        <tr>
          <td></td>
          <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table>
              <tr>
                <td>

                  <h2>Ticket Assign From {{ App\Department::where('id',$ticketDepartment)->first()->name }}</h2>
                  <h3>Hi, Everyone</h3>
                  <p class="lead">
                  <b>Title: </b>{{ $ticketTitle }}. <br>
                  <b>Priority: </b>{!! App\Ticket::getTicketPriorityString($ticketPriority) !!}.
                  </p>

                  <p>Thank you</p>

                  <!-- A Real Hero (and a real human being) -->
                  <div class="text-white mt-3 ml-2 p-2 ticket-description"></div>

                  <!-- Callout Panel -->

                     <table style="margin-bottom:20px">
               <tr>
                 <td>
                   <div class="callout" style="text-align:center;margin:0 auto">


                     <!-- <a href="#" class="inline-button">Check Now</a> -->
                   </div>
                 </td>
               </tr>
         </table>

         <!-- /Callout Panel -->
            <p style="text-align:left">Best Wishes, <br/> Service Chai</p>

          <!-- social & contact -->
          <table class="social" width="100%">
            <tr>
              <td>

              <table style="padding:15px;">
                <tr>
                  <td>
                    <p style="font-size:12px !important;border-bottom:1px solid #ccc;padding-bottom:15px">
                      P.S. You have auto re-lending turned ON. To turn OFF auto re-lending, please click here.
                      About auto re-lending: When you have auto re-lending turned ON, you no longer have to wait until your credits reach the minimum loan amount on the site to re-lend.
                      We will periodically make use of your unused credits to make a loan on your behalf to borrowers in need.
                      We will send you a notification email before doing this.
                    </p>
                  </td>
                </tr>
              </table>
              </td>
            </tr>
            <tr>
              <td>

                <!--- column 1 -->
                <table align="left" class="column">
                  <tr>
                    <td>

                      <h5 class="">Connect with Us:</h5>
                      <p class="">
                        <a href="#" class="soc-btn fb">Facebook</a>
                        <a href="#" class="soc-btn tw">Twitter</a>
                        <a href="#" class="soc-btn gp">Google+</a>
                      </p>


                    </td>
                  </tr>
                </table><!-- /column 1 -->

                <!--- column 2 -->
                <table align="left" class="column">
                  <tr>
                    <td>

                      <h5 class="">Have any question?</h5>
                      <p>Call us: <strong>+8809666733788</strong>
                        <br/>
                          Mail us: <strong><a href="emailto:info@servicechai.com">info@servicechai.com</a></strong>
                        </p>

                    </td>
                  </tr>
                </table><!-- /column 2 -->

                <span class="clear"></span>

              </td>
            </tr>
          </table><!-- /social & contact -->


        </td>
      </tr>
    </table>
    </div>

  </td>
  <td></td>
</tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap">
<tr>
  <td></td>
  <td class="container">

      <!-- content -->
      <div class="content">
      <table>
      <tr>
        <td align="center">
          <p>
            <a href="#">Terms</a> |
            <a href="#">Privacy</a> |
            <a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>
          </p>
        </td>
      </tr>
    </table>
      </div><!-- /content -->

  </td>
  <td></td>
</tr>
</table><!-- /FOOTER -->



</body>
</html>
