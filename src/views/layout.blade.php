<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>{{$subject}}</title>

  <style>
    body {
    }
    .email-wrapper {
      background-color: white;
      font-size: 15px;
      font-family: Arial, Helvetica, sans-serif;
    }

    .header {
      text-align: center;
    }

    .email-body-wrapper {
      padding: 20px;
      /* display: flex; */
    }

    .center-block {
      width: auto;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto
    }

    .container {
      color: black;
    }

    a.btn {
      color: white;
    }

    .btn {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
    }

    .btn:hover {
      color: white;
      background-color: #0069d9;
    }

    .btn-primary {
      background-color: #3397e1;
    }

    a.text-light {
      text-decoration: none;
      color: #f8f9fa;
    }

    a.text-light:hover {
      text-decoration: underline;
      color: #dae0e5;
    }

    .row {
      /* display: flex; */
      width: 100%;
      clear: both;
      overflow: auto;
    }

    .col {
      width: 50%;
      float: left;
    }

    .form-group {
      padding-bottom: 10px;
    }

    .record-list table {
      width: 100%;
      border-collapse: collapse;
    }

    .record-list td {
      padding: 3px;
    }

    .record-list thead {
      text-align: left;
      border-bottom: 1px solid black;
      background-color: #3397e1;
      color: white;
      font-weight: bold;
    }

    .record-list th {
      font-weight: normal;
      padding: 3px;
    }

    .record-list tbody tr {
      text-align: left;
      border-bottom: 1px solid lightgray;
    }

    @media (max-width: 500px) {

      .email-body-wrapper {
        padding: 0;
      }
      .center-block {
        width: auto;
        min-width: auto;
      }

      .footer-1 .logo {
        max-width: 100%;
        height: auto;
      }

      .footer-2 .col {
        float: none;
        width: auto;
      }
    }
  </style>

</head>

<body>
  <div class="email-wrapper">
    <div class="container">
      <div class="header">
        <a href="https://www.processmaker.com" class="btn btn-primary">
          SENT BY PROCESSMAKER 4
        </a>
      </div>

      <div class="email-body-wrapper">
        <div class="email-body center-block">

          {!! $body !!}

        </div>
      </div>

      <div class="footer-1" style="background-color: #3397e1; padding:20px 10px; text-align: center;">
        <a href="https://www.processmaker.com"><img class="logo" src="https://www.processmaker.com/sites/all/themes/pmthemev2/img/processmaker-logo-500x-v2.png"
            alt="ProcessMaker"></a>
        <table align="center"><tr>
          <td style="padding:20px 10px">
            <a href="http://twitter.com/processmaker">

              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="48px" height="48px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
                xml:space="preserve">
                <path fill="#FFFFFF" d="M100,17.286c-3.686,1.717-7.629,2.889-11.771,3.4c4.227-2.656,7.485-6.912,8.998-11.971
	c-3.942,2.484-8.343,4.285-13.027,5.258c-3.741-4.201-9.057-6.83-14.972-6.83c-11.314,0-20.514,9.688-20.514,21.629
	c0,1.715,0.171,3.371,0.544,4.941c-17.059-0.912-32.173-9.512-42.287-22.596c-1.771,3.168-2.8,6.912-2.8,10.854
	c0,7.516,3.629,14.145,9.144,18.029c-3.372-0.115-6.543-1.086-9.285-2.715v0.287c0,10.457,7.056,19.227,16.455,21.199
	c-1.742,0.486-3.541,0.77-5.428,0.77c-1.314,0-2.6-0.141-3.857-0.398c2.629,8.6,10.201,14.857,19.172,15.027
	c-7.029,5.801-15.857,9.258-25.486,9.258c-1.656,0-3.285-0.086-4.885-0.287c9.086,6.145,19.857,9.715,31.455,9.715
	c37.744,0,58.372-32.971,58.372-61.568c0-0.943-0.028-1.859-0.056-2.799C93.77,25.431,97.257,21.63,100,17.286z"></path>
              </svg>
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="https://www.facebook.com/processmaker">



              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="48px" height="48px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
                xml:space="preserve">
                <path fill="#FFFFFF" d="M57.227,99.999H36.229V50.001H25.714V32.774h10.515V22.429c0-14.057,5.914-22.428,22.742-22.428H73v17.227
	h-8.772c-6.543,0-7.001,2.402-7.001,6.916v8.631l17.06,0.168L74.258,49.8l-17.031,0.201V99.999z"></path>
              </svg>
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="http://www.youtube.com/processmaker#play/uploads">



              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="48px" height="48px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
                xml:space="preserve">
                <g>
                  <path fill="#FFFFFF" d="M79.516,70.457c-1.83,0-2.83,1.228-2.83,4.141v1.317h5.658v-1.317
		C82.344,71.685,81.346,70.457,79.516,70.457z"></path>
                  <path fill="#FFFFFF" d="M59.658,70.457c-1.002,0-1.914,0.569-2.916,1.314v15c1.002,0.742,1.914,1.313,2.916,1.313
		c1.369,0,2.457-0.742,2.457-4.112v-9.431C62.115,71.199,61.027,70.457,59.658,70.457z"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M87.428,80.256H76.686v3.687c0,2.915,1,4.143,2.83,4.143
		s2.828-1.228,2.828-4.143V83.37h5.084c-0.084,5.374-2.227,9.057-7.912,9.057c-5.83,0-7.914-3.884-7.914-9.428v-7.458
		c0-5.569,2.084-9.425,7.914-9.425c5.828,0,7.912,3.855,7.912,9.425V80.256z M67.227,85.343c0,4.629-1.996,7.084-5.197,7.084
		c-2.541,0-3.771-0.915-5.457-3.113h-0.088v2.628h-4.826V57.913h5.084v10.831c2.004-1.686,3.059-2.628,5.287-2.628
		c3.201,0,5.197,2.455,5.197,7.084V85.343z M46.742,91.941h-4.828v-2.542c-2.143,1.887-3.229,3.027-6.201,3.027
		c-2.686,0-4.285-2.025-4.285-5.34V66.602h5.115v19.653c0,1.259,0.713,1.83,1.799,1.83c1.115,0,2.115-0.714,3.285-1.602V66.602
		h5.115V91.941z M30.084,62.999H24.6v28.942h-5.629V62.999h-5.484v-5.086h16.598V62.999z M81.914,50.829H18.086
		c-7.629,0-13.801,6.397-13.801,14.285v20.6c0,7.885,6.172,14.285,13.801,14.285h63.828c7.629,0,13.801-6.4,13.801-14.285v-20.6
		C95.715,57.227,89.543,50.829,81.914,50.829z"></path>
                  <g>
                    <polygon fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" points="26.143,46.314 18.457,46.314 18.457,27.087 9.143,0.001
			16.971,0.001 22.342,17.656 22.486,17.656 27.629,0.001 35.428,0.001 26.143,27.087 		"></polygon>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M52.543,22.715c0-3.97-1.371-5.655-3.855-5.655
			c-2.486,0-3.828,1.686-3.828,5.655V35.43c0,3.971,1.342,5.628,3.828,5.628c2.484,0,3.855-1.657,3.855-5.628V22.715z
			 M37.914,24.002c0-7.573,2.828-12.829,10.773-12.829c7.939,0,10.801,5.256,10.801,12.829v10.142
			c0,7.569-2.861,12.826-10.801,12.826c-7.945,0-10.773-5.257-10.773-12.826V24.002z"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M86.602,11.8v34.515h-6.545v-3.457
			c-2.914,2.572-4.398,4.112-8.455,4.112c-3.629,0-5.803-2.768-5.803-7.254V11.8h6.945v26.771c0,1.714,0.971,2.486,2.457,2.486
			c1.484,0,2.857-0.943,4.486-2.174V11.8H86.602z"></path>
                  </g>
                </g>
              </svg>
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="https://www.linkedin.com/company/113435/">



              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="48px" height="48px" viewBox="0 0 100 100" enable-background="new 0 0 100 100"
                xml:space="preserve">
                <g>
                  <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M100,95.713V60.344c0-18.943-10.572-27.771-24.688-27.771
		c-11.37,0-16.456,5.999-19.313,10.201v-8.745h-21.43c0.288,5.799,0,61.684,0,61.684h21.43V61.256c0-1.828,0.146-3.684,0.715-5
		c1.546-3.684,5.059-7.484,11.001-7.484c7.743,0,10.856,5.656,10.856,13.943v32.998H100z"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" d="M11.857,25.6c7.455,0,12.255-4.743,12.255-10.655
		c-0.14-6.061-4.654-10.658-11.997-10.658C4.799,4.287,0,8.884,0,14.945C0,20.857,4.656,25.6,11.857,25.6z"></path>
                  <rect x="1.256" y="34.029" fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" width="21.459"
                    height="61.684"></rect>
                </g>
              </svg>
            </a>
          </td>
        </tr></table>
      </div>
      <div class="footer-2" style="background-color: #2481c5; color: #fff; padding:30px 10px ">
        <div class="center-block" style="max-width: 500px">
          <div align="center">
            <h4>
              Get the ProcessMaker workflow app
            </h4>
            <div class="row" style="">
              <div class="col">
                <a align="center" href="https://itunes.apple.com/us/app/processmaker/id992576284?ls=1&amp;mt=8">
                  <img src="https://www.processmaker.com/sites/all/themes/pmthemev2/img/app-store.png">
                </a>
              </div>
              <div class="col">
                <a align="center" href="https://play.google.com/store/apps/details?id=com.colosa.processmaker">
                  <img src="https://www.processmaker.com/sites/all/themes/pmthemev2/img/google-play.png">
                </a>
              </div>
            </div>

            <div align="center">
              <a href="https://www.processmaker.com/privacy-statement" class="text-light">
                Privacy Statement
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/security-statement" class="text-light">
                Security Statement
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/gdpr" class="text-light">
                GDPR
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/terms-of-service" class="text-light">
                Terms of Service
              </a>

              <br>
              © Copyright 2000 - 2019 ProcessMaker Inc.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>